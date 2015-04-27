<?php
	define('maxSortBy', 4);
	define('empty_lookup_value', '{empty_value}');

	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	if(function_exists('set_magic_quotes_runtime')) @set_magic_quotes_runtime(0);
	ob_start();

	$currDir=dirname(__FILE__);
	$setupStyle="border: solid 1px red; background-color: #FFFFE0; color: red; font-size: 16px; font-family: arial; font-weight: bold; padding: 10px; width:400px; text-align: left;";

	include("$currDir/admin/incFunctions.php");
	// include global hook functions
	@include("$currDir/hooks/__global.php");

	// check sessions config
	$noPathCheck=True;
	$arrPath=explode(';', ini_get('session.save_path'));
	$save_path=$arrPath[count($arrPath)-1];
	if(!$noPathCheck && !is_dir($save_path)){
		?>
		<center>
		<div style="<?php echo $setupStyle ?>">
			Your site is not configured to support sessions correctly. Please edit your php.ini file and change the value of <i>session.save_path</i> to a valid path.
			</div>
			</center>
		<?php
		exit;
	}
	if(session_id()){ session_write_close(); }
	$configured_save_handler = @ini_get('session.save_handler');
	if($configured_save_handler != 'memcache' && $configured_save_handler != 'memcached')
		@ini_set('session.save_handler', 'files');
	@ini_set('session.serialize_handler', 'php');
	@ini_set('session.use_cookies', '1');
	@ini_set('session.use_only_cookies', '1');
	@header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
	@header('Pragma: no-cache'); // HTTP 1.0.
	@header('Expires: 0'); // Proxies.
	@session_name('spindle');
	session_start();

	// check if membership system exists
	setupMembership();

	// silently apply db changes, if any
	@include_once("$currDir/updateDB.php");

	// do we have a login request?
	logInMember();

	// convert expanded sorting variables, if provided, to SortField and SortDirection
	$postedOrderBy = array();
	for($i = 0; $i < maxSortBy; $i++){
		if(isset($_POST["OrderByField$i"])){
			$sd = ($_POST["OrderDir$i"] == 'desc' ? 'desc' : 'asc');
			if($sfi = intval($_POST["OrderByField$i"])){
				$postedOrderBy[] = array($sfi => $sd);
			}
		}
	}
	if(count($postedOrderBy)){
		$_POST['SortField'] = '';
		$_POST['SortDirection'] = '';
		foreach($postedOrderBy as $obi){
			$sfi = ''; $sd = '';
			foreach($obi as $sfi => $sd);
			$_POST['SortField'] .= "$sfi $sd,";
		}
		$_POST['SortField'] = substr($_POST['SortField'], 0, -2 - strlen($sd));
		$_POST['SortDirection'] = $sd;
	}elseif($_POST['apply_sorting']){
		/* no sorting and came from filters page .. so clear sorting */
		$_POST['SortField'] = $_POST['SortDirection'] = '';
	}

	#########################################################
	/*
	~~~~~~ LIST OF FUNCTIONS ~~~~~~
		getTableList() -- returns an associative array (tableName=>tableData, tableData is array(tableCaption, tableDescription, tableIcon)) of tables accessible by current user
		getLoggedMemberID() -- returns memberID of logged member. If no login, returns anonymous memberID
		getLoggedGroupID() -- returns groupID of logged member, or anonymous groupID
		logOutMember() -- destroys session and logs member out.
		logInMember() -- checks POST login. If not valid, redirects to index.php, else returns TRUE
		getTablePermissions($tn) -- returns an array of permissions allowed for logged member to given table (allowAccess, allowInsert, allowView, allowEdit, allowDelete) -- allowAccess is set to true if any access level is allowed
		get_sql_fields($tn) -- returns the SELECT part of the table view query
		get_sql_from($tn[, true]) -- returns the FROM part of the table view query, with full joins, optionally skipping permissions if true passed as 2nd param.
		htmlUserBar() -- returns html code for displaying user login status to be used on top of pages.
		showNotifications($msg, $class) -- returns html code for displaying a notification. If no parameters provided, processes the GET request for possible notifications.
		parseMySQLDate(a, b) -- returns a if valid mysql date, or b if valid mysql date, or today if b is true, or empty if b is false.
		parseCode(code) -- calculates and returns special values to be inserted in automatic fields.
		addFilter(i, filterAnd, filterField, filterOperator, filterValue) -- enforce a filter over data
		clearFilters() -- clear all filters
		getMemberInfo() -- returns an array containing the currently signed-in member's info
		loadView($view, $data) -- passes $data to templates/{$view}.php and returns the output
		loadTable($table, $data) -- loads table template, passing $data to it
		filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo) -- applies cascading drop-downs for a lookup field, returns js code to be inserted into the page
		br2nl($text) -- replaces all variations of HTML <br> tags with a new line character
		htmlspecialchars_decode($text) -- inverse of htmlspecialchars()
		entitiesToUTF8($text) -- convert unicode entities (e.g. &#1234;) to actual UTF8 characters, requires multibyte string PHP extension
		func_get_args_byref() -- returns an array of arguments passed to a function, by reference
		html_attr($str) -- prepare $str to be placed inside an HTML attribute
		permissions_sql($table, $level) -- returns an array containing the FROM and WHERE additions for applying permissions to an SQL query
		error_message($msg[, $back_url]) -- returns html code for a styled error message .. pass explicit false in second param to suppress back button
	~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	*/
	#########################################################
	function getTableList($skip_authentication = false){
		$arrAccessTables = array();
		$arrTables = array(   
			'biblio_author' => array('Agents', 'Data selection 1: Potential characters for a historiographic narrative.', 'table.gif'),
			'biblio_doc' => array('Bibliography', 'Data selection 2: Bibliography providing authentic texts and background information related to "agents".', 'table.gif'),
			'biblio_trascript' => array('Trascripts', 'Data preparation 1: Machine-readable transcript versions.', 'table.gif'),
			'biblio_token' => array('Token', 'Data preparation 2: Tokenized text.', 'table.gif'),
			'code_invivo' => array('Invivo', 'Coding step 1: Invivo coding.', 'table.gif'),
			'code_herme' => array('Hermeneutic', 'Coding step 2: Hermeneutical coding.', 'table.gif'),
			'code_chrev_scenes' => array('Character scenes', 'Coding step 3: Dramatic encoding.', 'table.gif'),
			'code_character_development' => array('Character dev.', 'Coding step 4: Character development.', 'table.gif'),
			'code_encounters' => array('Encounters', 'Coding step 5: Dramatica\'s Character Events Scenes.', 'table.gif'),
			'code_encounter_scenes' => array('Encounter scenes', '', 'table.gif'),
			'story' => array('Story', 'Production step 1: Topic selection.', 'table.gif'),
			'story_characters' => array('Characters', 'Production step 2: Character choices.', 'table.gif'),
			'storypoints_static' => array('Storypoints', 'Production step 3: Static storypoints.', 'table.gif'),
			'storydynamic' => array('Story dynamics', 'Production step 4: Overall structure.', 'table.gif'),
			'storyweaving_scenes' => array('Storyweaving', 'Production step 5: Thematic encoding.', 'table.gif'),
			'storylines' => array('Storylines', 'Production step 6: Story writing.', 'table.gif'),
			'dictionary' => array('Dictionary', '', 'table.gif'),
			'class_agent_type1' => array('Class agenttype1', '', 'table.gif'),
			'class_agent_type2' => array('Class agenttype2', '', 'table.gif'),
			'class_authority_agent' => array('Person\'s authority register', '', 'table.gif'),
			'class_authority_library' => array('class_authority_library', '', 'table.gif'),
			'class_bibliography_genre' => array('Genre', '', 'table.gif'),
			'class_bibliography_type' => array('Type', '', 'table.gif'),
			'class_dramatica_archetype' => array('Archetype', '', 'table.gif'),
			'class_dramatica_domain' => array('Domain', '', 'table.gif'),
			'class_dramatica_concern' => array('Concern', '', 'table.gif'),
			'class_dramatica_issue' => array('Issue', '', 'table.gif'),
			'class_dramatica_themes' => array('Themes', '', 'table.gif'),
			'class_dramatica_throughline' => array('Throughline', '', 'table.gif'),
			'class_im' => array('Impression', '', 'table.gif'),
			'class_language' => array('Language', '', 'table.gif'),
			'class_nt' => array('Noetic tension', '', 'table.gif'),
			'class_character_element' => array('Character elements', '', 'table.gif'),
			'class_rights' => array('Class rights', '', 'table.gif')
		);
		if($skip_authentication || getLoggedAdmin()) return $arrTables;

		if(is_array($arrTables)){
			foreach($arrTables as $tn => $tc){
				$arrPerm = getTablePermissions($tn);
				if($arrPerm[0]){
					$arrAccessTables[$tn] = $tc;
				}
			}
		}

		return $arrAccessTables;
	}
	#########################################################
	function getTablePermissions($tn){
		static $table_permissions = array();
		if(isset($table_permissions[$tn])) return $table_permissions[$tn];

		$groupID = getLoggedGroupID();
		$memberID = makeSafe(getLoggedMemberID());
		$res_group = sql("select tableName, allowInsert, allowView, allowEdit, allowDelete from membership_grouppermissions where groupID='{$groupID}'", $eo);
		$res_user = sql("select tableName, allowInsert, allowView, allowEdit, allowDelete from membership_userpermissions where lcase(memberID)='{$memberID}'", $eo);

		while($row = db_fetch_assoc($res_group)){
			$table_permissions[$row['tableName']] = array(
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			);
		}

		// user-specific permissions, if specified, overwrite his group permissions
		while($row = db_fetch_assoc($res_user)){
			$table_permissions[$row['tableName']] = array(
				1 => intval($row['allowInsert']),
				2 => intval($row['allowView']),
				3 => intval($row['allowEdit']),
				4 => intval($row['allowDelete']),
				'insert' => intval($row['allowInsert']),
				'view' => intval($row['allowView']),
				'edit' => intval($row['allowEdit']),
				'delete' => intval($row['allowDelete'])
			);
		}

		// if user has any type of access, set 'access' flag
		foreach($table_permissions as $t => $p){
			$table_permissions[$t]['access'] = $table_permissions[$t][0] = false;

			if($p['insert'] || $p['view'] || $p['edit'] || $p['delete']){
				$table_permissions[$t]['access'] = $table_permissions[$t][0] = true;
			}
		}

		return $table_permissions[$tn];
	}

	#########################################################
	function get_sql_fields($table_name){
		$sql_fields = array(   
			'biblio_author' => "`biblio_author`.`id` as 'id', `biblio_author`.`memberID` as 'memberID', `biblio_author`.`img` as 'img', `biblio_author`.`groupID` as 'groupID', `biblio_author`.`selection_class` as 'selection_class', IF(    CHAR_LENGTH(`class_agent_type11`.`type`), CONCAT_WS('',   `class_agent_type11`.`type`), '') as 'agenttype1', IF(    CHAR_LENGTH(`class_agent_type21`.`type`), CONCAT_WS('',   `class_agent_type21`.`type`), '') as 'agenttype2', `biblio_author`.`gender` as 'gender', `biblio_author`.`last_name` as 'last_name', `biblio_author`.`first_name` as 'first_name', `biblio_author`.`other_name` as 'other_name', `biblio_author`.`birthday` as 'birthday', `biblio_author`.`birth_location` as 'birth_location', `biblio_author`.`deathday` as 'deathday', `biblio_author`.`death_location` as 'death_location', `biblio_author`.`workplace` as 'workplace', `biblio_author`.`knows` as 'knows', `biblio_author`.`shortbio` as 'shortbio', `biblio_author`.`data_evaluation` as 'data_evaluation', `biblio_author`.`authority_record` as 'authority_record', IF(    CHAR_LENGTH(`class_authority_agent1`.`abbreviation`), CONCAT_WS('',   `class_authority_agent1`.`abbreviation`), '') as 'authority_organization'",
			'biblio_doc' => "`biblio_doc`.`id` as 'id', `biblio_doc`.`img` as 'img', IF(    CHAR_LENGTH(`biblio_author1`.`last_name`) || CHAR_LENGTH(`biblio_author1`.`first_name`), CONCAT_WS('',   `biblio_author1`.`last_name`, ', ', `biblio_author1`.`first_name`), '') as 'author_name', IF(    CHAR_LENGTH(`biblio_author1`.`id`), CONCAT_WS('',   `biblio_author1`.`id`), '') as 'author_id', IF(    CHAR_LENGTH(`class_bibliography_type1`.`type`), CONCAT_WS('',   `class_bibliography_type1`.`type`), '') as 'type', IF(    CHAR_LENGTH(`class_bibliography_genre1`.`genre`), CONCAT_WS('',   `class_bibliography_genre1`.`genre`), '') as 'genre', `biblio_doc`.`created` as 'created', `biblio_doc`.`published` as 'published', `biblio_doc`.`title` as 'title', `biblio_doc`.`subtitle` as 'subtitle', `biblio_doc`.`publisher` as 'publisher', `biblio_doc`.`location` as 'location', `biblio_doc`.`citation` as 'citation', `biblio_doc`.`description` as 'description', `biblio_doc`.`source` as 'source', `biblio_doc`.`medium` as 'medium', IF(    CHAR_LENGTH(`class_language1`.`language`), CONCAT_WS('',   `class_language1`.`language`), '') as 'language', `biblio_doc`.`format` as 'format', `biblio_doc`.`subject` as 'subject', IF(    CHAR_LENGTH(`class_rights1`.`right`), CONCAT_WS('',   `class_rights1`.`right`), '') as 'rights', `biblio_doc`.`rights_holder` as 'rights_holder', `biblio_doc`.`data_evaluation` as 'data_evaluation', `biblio_doc`.`authority_record` as 'authority_record', IF(    CHAR_LENGTH(`class_authority_library1`.`authority_name`), CONCAT_WS('',   `class_authority_library1`.`authority_name`), '') as 'authority_organization', `biblio_doc`.`pdf_book` as 'pdf_book', `biblio_doc`.`ext_source` as 'ext_source'",
			'biblio_trascript' => "`biblio_trascript`.`id` as 'id', IF(    CHAR_LENGTH(`biblio_author1`.`last_name`) || CHAR_LENGTH(`biblio_author1`.`first_name`), CONCAT_WS('',   `biblio_author1`.`last_name`, ',', `biblio_author1`.`first_name`), '') as 'author', IF(    CHAR_LENGTH(`biblio_author1`.`memberID`), CONCAT_WS('',   `biblio_author1`.`memberID`), '') as 'author_memberID', IF(    CHAR_LENGTH(`biblio_doc1`.`id`), CONCAT_WS('',   `biblio_doc1`.`id`), '') as 'bibliography_id', IF(    CHAR_LENGTH(`biblio_doc1`.`title`), CONCAT_WS('',   `biblio_doc1`.`title`), '') as 'bibliography_title', `biblio_trascript`.`trascriber_memberID` as 'trascriber_memberID', `biblio_trascript`.`transcript_title` as 'transcript_title', `biblio_trascript`.`transcript` as 'transcript', `biblio_trascript`.`credits` as 'credits'",
			'biblio_token' => "`biblio_token`.`id` as 'id', IF(    CHAR_LENGTH(`biblio_author1`.`memberID`) || CHAR_LENGTH(`biblio_author1`.`last_name`), CONCAT_WS('',   `biblio_author1`.`memberID`, '  ', `biblio_author1`.`last_name`), '') as 'author', IF(    CHAR_LENGTH(`biblio_doc1`.`id`) || CHAR_LENGTH(`biblio_doc1`.`title`), CONCAT_WS('',   `biblio_doc1`.`id`, '  ', `biblio_doc1`.`title`), '') as 'bibliography', IF(    CHAR_LENGTH(`biblio_trascript1`.`trascriber_memberID`) || CHAR_LENGTH(`biblio_trascript1`.`transcript_title`), CONCAT_WS('',   `biblio_trascript1`.`trascriber_memberID`, '- ', `biblio_trascript1`.`transcript_title`), '') as 'transcript', `biblio_token`.`token_sequence` as 'token_sequence', `biblio_token`.`token` as 'token'",
			'code_invivo' => "`code_invivo`.`id` as 'id', IF(    CHAR_LENGTH(`biblio_author1`.`memberID`) || CHAR_LENGTH(`biblio_author1`.`last_name`), CONCAT_WS('',   `biblio_author1`.`memberID`, '  ', `biblio_author1`.`last_name`), '') as 'author', IF(    CHAR_LENGTH(`biblio_doc1`.`id`) || CHAR_LENGTH(`biblio_doc1`.`title`), CONCAT_WS('',   `biblio_doc1`.`id`, '  ', `biblio_doc1`.`title`), '') as 'bibliography', IF(    CHAR_LENGTH(`biblio_trascript1`.`trascriber_memberID`) || CHAR_LENGTH(`biblio_trascript1`.`transcript_title`), CONCAT_WS('',   `biblio_trascript1`.`trascriber_memberID`, '- ', `biblio_trascript1`.`transcript_title`), '') as 'transcript', IF(    CHAR_LENGTH(`biblio_token1`.`token_sequence`), CONCAT_WS('',   `biblio_token1`.`token_sequence`), '') as 'token_sequence', IF(    CHAR_LENGTH(`biblio_token1`.`token`), CONCAT_WS('',   `biblio_token1`.`token`), '') as 'token', `code_invivo`.`invivo` as 'invivo', `code_invivo`.`start_date` as 'start_date', `code_invivo`.`end_date` as 'end_date', `code_invivo`.`person` as 'person', `code_invivo`.`place` as 'place', `code_invivo`.`freecode` as 'freecode'",
			'code_herme' => "`code_herme`.`id` as 'id', IF(    CHAR_LENGTH(`biblio_author1`.`memberID`) || CHAR_LENGTH(`biblio_author1`.`last_name`), CONCAT_WS('',   `biblio_author1`.`memberID`, '  ', `biblio_author1`.`last_name`), '') as 'author', IF(    CHAR_LENGTH(`biblio_doc1`.`id`) || CHAR_LENGTH(`biblio_doc1`.`title`), CONCAT_WS('',   `biblio_doc1`.`id`, '  ', `biblio_doc1`.`title`), '') as 'bibliography', IF(    CHAR_LENGTH(`biblio_trascript1`.`trascriber_memberID`) || CHAR_LENGTH(`biblio_trascript1`.`transcript_title`), CONCAT_WS('',   `biblio_trascript1`.`trascriber_memberID`, ' - ', `biblio_trascript1`.`transcript_title`), '') as 'transcript', IF(    CHAR_LENGTH(`biblio_token1`.`token_sequence`), CONCAT_WS('',   `biblio_token1`.`token_sequence`), '') as 'token_sequence', IF(    CHAR_LENGTH(`biblio_token1`.`id`) || CHAR_LENGTH(`biblio_token1`.`token`), CONCAT_WS('',   `biblio_token1`.`id`, '  ', `biblio_token1`.`token`), '') as 'token', IF(    CHAR_LENGTH(`class_im1`.`impression`), CONCAT_WS('',   `class_im1`.`impression`), '') as 'impression', IF(    CHAR_LENGTH(`class_nt1`.`noetictension`), CONCAT_WS('',   `class_nt1`.`noetictension`), '') as 'noetictension', `code_herme`.`freecode` as 'freecode'",
			'code_chrev_scenes' => "`code_chrev_scenes`.`id` as 'id', IF(    CHAR_LENGTH(`biblio_author1`.`memberID`), CONCAT_WS('',   `biblio_author1`.`memberID`), '') as 'author', IF(    CHAR_LENGTH(`biblio_doc1`.`id`) || CHAR_LENGTH(`biblio_doc1`.`title`), CONCAT_WS('',   `biblio_doc1`.`id`, '  ', `biblio_doc1`.`title`), '') as 'bibliography', IF(    CHAR_LENGTH(`biblio_trascript1`.`trascriber_memberID`) || CHAR_LENGTH(`biblio_trascript1`.`transcript_title`), CONCAT_WS('',   `biblio_trascript1`.`trascriber_memberID`, ' - ', `biblio_trascript1`.`transcript_title`), '') as 'transcript', IF(    CHAR_LENGTH(`biblio_token1`.`token_sequence`), CONCAT_WS('',   `biblio_token1`.`token_sequence`), '') as 'token_sequence', IF(    CHAR_LENGTH(`biblio_token1`.`token_sequence`) || CHAR_LENGTH(`biblio_token1`.`token`), CONCAT_WS('',   `biblio_token1`.`token_sequence`, '  ', `biblio_token1`.`token`), '') as 'token', IF(    CHAR_LENGTH(`biblio_author2`.`memberID`), CONCAT_WS('',   `biblio_author2`.`memberID`), '') as 'agent', IF(    CHAR_LENGTH(`code_invivo1`.`id`) || CHAR_LENGTH(`biblio_token2`.`token_sequence`), CONCAT_WS('',   `code_invivo1`.`id`, ' / ', `biblio_token2`.`token_sequence`), '') as 'invivo_code', IF(    CHAR_LENGTH(`code_invivo1`.`start_date`), CONCAT_WS('',   `code_invivo1`.`start_date`), '') as 'startdate', IF(    CHAR_LENGTH(`code_invivo1`.`end_date`), CONCAT_WS('',   `code_invivo1`.`end_date`), '') as 'end_date', IF(    CHAR_LENGTH(`code_invivo1`.`person`), CONCAT_WS('',   `code_invivo1`.`person`), '') as 'person', IF(    CHAR_LENGTH(`code_invivo1`.`place`), CONCAT_WS('',   `code_invivo1`.`place`), '') as 'place', IF(    CHAR_LENGTH(`code_invivo1`.`freecode`), CONCAT_WS('',   `code_invivo1`.`freecode`), '') as 'freecode', IF(    CHAR_LENGTH(`code_herme1`.`id`), CONCAT_WS('',   `code_herme1`.`id`), '') as 'herme_code', IF(    CHAR_LENGTH(`class_im1`.`impression`), CONCAT_WS('',   `class_im1`.`impression`), '') as 'impression', IF(    CHAR_LENGTH(`class_nt1`.`noetictension`), CONCAT_WS('',   `class_nt1`.`noetictension`), '') as 'noetictension', IF(    CHAR_LENGTH(`code_herme1`.`freecode`), CONCAT_WS('',   `code_herme1`.`freecode`), '') as 'comment', IF(    CHAR_LENGTH(`code_encounter_scenes1`.`scene`), CONCAT_WS('',   `code_encounter_scenes1`.`scene`), '') as 'scene'",
			'code_character_development' => "`code_character_development`.`id` as 'id', IF(    CHAR_LENGTH(`story1`.`id`) || CHAR_LENGTH(`story1`.`story`), CONCAT_WS('',   `story1`.`id`, '  ', `story1`.`story`), '') as 'story', IF(    CHAR_LENGTH(`biblio_author1`.`last_name`) || CHAR_LENGTH(`biblio_author1`.`first_name`), CONCAT_WS('',   `biblio_author1`.`last_name`, ', ', `biblio_author1`.`first_name`), '') as 'agent', IF(    CHAR_LENGTH(`class_dramatica_archetype1`.`archetype`) || CHAR_LENGTH(`story_characters1`.`character`), CONCAT_WS('',   `class_dramatica_archetype1`.`archetype`, '- ', `story_characters1`.`character`), '') as 'story_character', IF(    CHAR_LENGTH(`biblio_author2`.`memberID`) || CHAR_LENGTH(`biblio_author2`.`last_name`), CONCAT_WS('',   `biblio_author2`.`memberID`, ' - ', `biblio_author2`.`last_name`), '') as 'author', IF(    CHAR_LENGTH(`biblio_doc1`.`id`) || CHAR_LENGTH(`biblio_doc1`.`title`), CONCAT_WS('',   `biblio_doc1`.`id`, '  ', `biblio_doc1`.`title`), '') as 'bibliography', IF(    CHAR_LENGTH(`biblio_trascript1`.`trascriber_memberID`) || CHAR_LENGTH(`biblio_trascript1`.`transcript_title`), CONCAT_WS('',   `biblio_trascript1`.`trascriber_memberID`, ' - ', `biblio_trascript1`.`transcript_title`), '') as 'transcript', IF(    CHAR_LENGTH(`biblio_token1`.`id`), CONCAT_WS('',   `biblio_token1`.`id`), '') as 'token_sequence', IF(    CHAR_LENGTH(`biblio_token1`.`token`), CONCAT_WS('',   `biblio_token1`.`token`), '') as 'token', IF(    CHAR_LENGTH(`code_herme1`.`freecode`), CONCAT_WS('',   `code_herme1`.`freecode`), '') as 'code', IF(    CHAR_LENGTH(`class_character_element1`.`element`), CONCAT_WS('',   `class_character_element1`.`element`), '') as 'character_element', `code_character_development`.`character_elem_value` as 'character_elem_value', `code_character_development`.`comment` as 'comment'",
			'code_encounters' => "`code_encounters`.`id` as 'id', IF(    CHAR_LENGTH(`biblio_author1`.`memberID`), CONCAT_WS('',   `biblio_author1`.`memberID`), '') as 'agentA', IF(    CHAR_LENGTH(`biblio_author2`.`memberID`), CONCAT_WS('',   `biblio_author2`.`memberID`), '') as 'authorA', IF(    CHAR_LENGTH(`biblio_doc1`.`id`) || CHAR_LENGTH(`biblio_doc1`.`title`), CONCAT_WS('',   `biblio_doc1`.`id`, '  ', `biblio_doc1`.`title`), '') as 'bibliographyA', IF(    CHAR_LENGTH(`biblio_trascript1`.`trascriber_memberID`) || CHAR_LENGTH(`biblio_trascript1`.`transcript_title`), CONCAT_WS('',   `biblio_trascript1`.`trascriber_memberID`, ' - ', `biblio_trascript1`.`transcript_title`), '') as 'transcriptA', IF(    CHAR_LENGTH(`biblio_token1`.`token_sequence`) || CHAR_LENGTH(`biblio_token1`.`token`), CONCAT_WS('',   `biblio_token1`.`token_sequence`, '  ', `biblio_token1`.`token`), '') as 'tokenA', IF(    CHAR_LENGTH(`code_encounter_scenes1`.`scene`), CONCAT_WS('',   `code_encounter_scenes1`.`scene`), '') as 'sceneA', IF(    CHAR_LENGTH(`biblio_author3`.`memberID`), CONCAT_WS('',   `biblio_author3`.`memberID`), '') as 'agentB', IF(    CHAR_LENGTH(`biblio_author4`.`memberID`), CONCAT_WS('',   `biblio_author4`.`memberID`), '') as 'authorB', IF(    CHAR_LENGTH(`biblio_doc2`.`id`) || CHAR_LENGTH(`biblio_doc2`.`title`), CONCAT_WS('',   `biblio_doc2`.`id`, '  ', `biblio_doc2`.`title`), '') as 'bibliographyB', IF(    CHAR_LENGTH(`biblio_trascript2`.`trascriber_memberID`) || CHAR_LENGTH(`biblio_trascript2`.`transcript_title`), CONCAT_WS('',   `biblio_trascript2`.`trascriber_memberID`, ' - ', `biblio_trascript2`.`transcript_title`), '') as 'transcriptB', IF(    CHAR_LENGTH(`biblio_token2`.`id`) || CHAR_LENGTH(`biblio_token2`.`token`), CONCAT_WS('',   `biblio_token2`.`id`, '  ', `biblio_token2`.`token`), '') as 'tokenB', IF(    CHAR_LENGTH(`code_encounter_scenes2`.`scene`), CONCAT_WS('',   `code_encounter_scenes2`.`scene`, '  '), '') as 'sceneB', `code_encounters`.`type` as 'type', `code_encounters`.`conflicttype` as 'conflicttype', IF(    CHAR_LENGTH(`code_encounter_scenes3`.`scene`), CONCAT_WS('',   `code_encounter_scenes3`.`scene`), '') as 'story_scene', `code_encounters`.`nd_color` as 'nd_color', `code_encounters`.`nd_width` as 'nd_width', `code_encounters`.`nd_style` as 'nd_style', `code_encounters`.`nd_opacity` as 'nd_opacity', `code_encounters`.`nd_visibility` as 'nd_visibility', `code_encounters`.`lbl_lable` as 'lbl_lable', `code_encounters`.`lbl_color` as 'lbl_color', `code_encounters`.`lbl_size` as 'lbl_size'",
			'code_encounter_scenes' => "`code_encounter_scenes`.`id` as 'id', `code_encounter_scenes`.`scene` as 'scene'",
			'story' => "`story`.`id` as 'id', `story`.`subject` as 'subject', `story`.`story` as 'story', `story`.`tags` as 'tags', `story`.`collaboration_status` as 'collaboration_status'",
			'story_characters' => "`story_characters`.`id` as 'id', IF(    CHAR_LENGTH(`story1`.`id`) || CHAR_LENGTH(`story1`.`story`), CONCAT_WS('',   `story1`.`id`, '  ', `story1`.`story`), '') as 'story', IF(    CHAR_LENGTH(`class_dramatica_archetype1`.`archetype`), CONCAT_WS('',   `class_dramatica_archetype1`.`archetype`), '') as 'role', `story_characters`.`character` as 'character', IF(    CHAR_LENGTH(`biblio_author1`.`memberID`), CONCAT_WS('',   `biblio_author1`.`memberID`), '') as 'memberID', IF(    CHAR_LENGTH(`biblio_author1`.`last_name`) || CHAR_LENGTH(`biblio_author1`.`first_name`), CONCAT_WS('',   `biblio_author1`.`last_name`, ', ', `biblio_author1`.`first_name`), '') as 'agent_name', `story_characters`.`cw_name` as 'cw_name', IF(    CHAR_LENGTH(`biblio_author1`.`img`), CONCAT_WS('',   `biblio_author1`.`img`), '') as 'img', `story_characters`.`MC_resolve` as 'MC_resolve', `story_characters`.`MC_growth` as 'MC_growth', `story_characters`.`MC_approach` as 'MC_approach', `story_characters`.`MC_PS_style` as 'MC_PS_style', `story_characters`.`cw_age` as 'cw_age', `story_characters`.`cw_gender` as 'cw_gender', `story_characters`.`cw_communication_style` as 'cw_communication_style', `story_characters`.`cw_background` as 'cw_background', `story_characters`.`cw_appearance` as 'cw_appearance', `story_characters`.`cw_relationships` as 'cw_relationships', `story_characters`.`cw_ambition` as 'cw_ambition', `story_characters`.`cw_character_defects` as 'cw_character_defects', `story_characters`.`cw_thoughts` as 'cw_thoughts', `story_characters`.`cw_relatedness` as 'cw_relatedness', `story_characters`.`cw_restrictions` as 'cw_restrictions', `story_characters`.`locations` as 'locations', `story_characters`.`persons` as 'persons', `story_characters`.`events` as 'events', IF(    CHAR_LENGTH(`class_nt1`.`noetictension`), CONCAT_WS('',   `class_nt1`.`noetictension`), '') as 'noetictension', IF(    CHAR_LENGTH(`class_im1`.`impression`), CONCAT_WS('',   `class_im1`.`impression`), '') as 'impression'",
			'storypoints_static' => "`storypoints_static`.`id` as 'id', IF(    CHAR_LENGTH(`story1`.`id`) || CHAR_LENGTH(`story1`.`story`), CONCAT_WS('',   `story1`.`id`, '  ', `story1`.`story`), '') as 'story', IF(    CHAR_LENGTH(`class_dramatica_throughline1`.`throughline`), CONCAT_WS('',   `class_dramatica_throughline1`.`throughline`), '') as 'throughline', IF(    CHAR_LENGTH(`class_dramatica_domain1`.`domain`), CONCAT_WS('',   `class_dramatica_domain1`.`domain`), '') as 'throughline_domain', IF(    CHAR_LENGTH(`class_dramatica_concern1`.`concern`), CONCAT_WS('',   `class_dramatica_concern1`.`concern`), '') as 'concern', IF(    CHAR_LENGTH(`class_dramatica_issue1`.`issue`), CONCAT_WS('',   `class_dramatica_issue1`.`issue`), '') as 'issue', IF(    CHAR_LENGTH(`class_dramatica_themes1`.`theme`), CONCAT_WS('',   `class_dramatica_themes1`.`theme`), '') as 'problem', IF(    CHAR_LENGTH(`class_dramatica_themes2`.`theme`), CONCAT_WS('',   `class_dramatica_themes2`.`theme`), '') as 'solution', IF(    CHAR_LENGTH(`class_dramatica_themes3`.`theme`), CONCAT_WS('',   `class_dramatica_themes3`.`theme`), '') as 'symptom', IF(    CHAR_LENGTH(`class_dramatica_themes4`.`theme`), CONCAT_WS('',   `class_dramatica_themes4`.`theme`), '') as 'response', IF(    CHAR_LENGTH(`class_dramatica_issue2`.`issue`), CONCAT_WS('',   `class_dramatica_issue2`.`issue`), '') as 'catalyst', IF(    CHAR_LENGTH(`class_dramatica_issue3`.`issue`), CONCAT_WS('',   `class_dramatica_issue3`.`issue`), '') as 'inhibitor', IF(    CHAR_LENGTH(`class_dramatica_concern2`.`concern`), CONCAT_WS('',   `class_dramatica_concern2`.`concern`), '') as 'benchmark'",
			'storydynamic' => "`storydynamic`.`id` as 'id', IF(    CHAR_LENGTH(`story1`.`id`) || CHAR_LENGTH(`story1`.`story`), CONCAT_WS('',   `story1`.`id`, '  ', `story1`.`story`), '') as 'story', `storydynamic`.`MC_resolve` as 'MC_resolve', `storydynamic`.`MC_growth` as 'MC_growth', `storydynamic`.`MC_approach` as 'MC_approach', `storydynamic`.`MC_PS_style` as 'MC_PS_style', `storydynamic`.`IC_resolve` as 'IC_resolve', `storydynamic`.`OS_driver` as 'OS_driver', `storydynamic`.`OS_limit` as 'OS_limit', `storydynamic`.`OS_outcome` as 'OS_outcome', `storydynamic`.`OS_judgement` as 'OS_judgement', IF(    CHAR_LENGTH(`class_dramatica_domain1`.`domain`), CONCAT_WS('',   `class_dramatica_domain1`.`domain`), '') as 'OS_goal_domain', IF(    CHAR_LENGTH(`class_dramatica_concern1`.`concern`), CONCAT_WS('',   `class_dramatica_concern1`.`concern`), '') as 'OS_goal_concern', IF(    CHAR_LENGTH(`class_dramatica_domain2`.`domain`), CONCAT_WS('',   `class_dramatica_domain2`.`domain`), '') as 'OS_consequence_domain', IF(    CHAR_LENGTH(`class_dramatica_concern2`.`concern`), CONCAT_WS('',   `class_dramatica_concern2`.`concern`), '') as 'OS_consequence_concern', IF(    CHAR_LENGTH(`class_dramatica_domain3`.`domain`), CONCAT_WS('',   `class_dramatica_domain3`.`domain`), '') as 'OS_cost_domain', IF(    CHAR_LENGTH(`class_dramatica_concern3`.`concern`), CONCAT_WS('',   `class_dramatica_concern3`.`concern`), '') as 'OS_cost_concern', IF(    CHAR_LENGTH(`class_dramatica_domain4`.`domain`), CONCAT_WS('',   `class_dramatica_domain4`.`domain`), '') as 'OS_dividend_domain', IF(    CHAR_LENGTH(`class_dramatica_concern4`.`concern`), CONCAT_WS('',   `class_dramatica_concern4`.`concern`), '') as 'OS_dividend_concern', IF(    CHAR_LENGTH(`class_dramatica_domain5`.`domain`), CONCAT_WS('',   `class_dramatica_domain5`.`domain`), '') as 'OS_requirements_domain', IF(    CHAR_LENGTH(`class_dramatica_concern5`.`concern`), CONCAT_WS('',   `class_dramatica_concern5`.`concern`), '') as 'OS_requirements_concern', IF(    CHAR_LENGTH(`class_dramatica_domain6`.`domain`), CONCAT_WS('',   `class_dramatica_domain6`.`domain`), '') as 'OS_prerequesites_domain', IF(    CHAR_LENGTH(`class_dramatica_concern6`.`concern`), CONCAT_WS('',   `class_dramatica_concern6`.`concern`), '') as 'OS_prerequesites_concern', IF(    CHAR_LENGTH(`class_dramatica_domain7`.`domain`), CONCAT_WS('',   `class_dramatica_domain7`.`domain`), '') as 'OS_preconditions_domain', IF(    CHAR_LENGTH(`class_dramatica_concern7`.`concern`), CONCAT_WS('',   `class_dramatica_concern7`.`concern`), '') as 'OS_preconditions_concern', IF(    CHAR_LENGTH(`class_dramatica_domain8`.`domain`), CONCAT_WS('',   `class_dramatica_domain8`.`domain`), '') as 'OS_forewarnings_domain', IF(    CHAR_LENGTH(`class_dramatica_concern8`.`concern`), CONCAT_WS('',   `class_dramatica_concern8`.`concern`), '') as 'OS_forewarnings_concern'",
			'storyweaving_scenes' => "`storyweaving_scenes`.`id` as 'id', IF(    CHAR_LENGTH(`story1`.`id`) || CHAR_LENGTH(`story1`.`story`), CONCAT_WS('',   `story1`.`id`, '  ', `story1`.`story`), '') as 'story', `storyweaving_scenes`.`step` as 'step', IF(    CHAR_LENGTH(`class_dramatica_throughline1`.`throughline`), CONCAT_WS('',   `class_dramatica_throughline1`.`throughline`), '') as 'throughline', IF(    CHAR_LENGTH(`class_dramatica_domain1`.`domain`), CONCAT_WS('',   `class_dramatica_domain1`.`domain`), '') as 'domain', IF(    CHAR_LENGTH(`class_dramatica_concern1`.`concern`), CONCAT_WS('',   `class_dramatica_concern1`.`concern`), '') as 'concern', `storyweaving_scenes`.`sequence` as 'sequence', IF(    CHAR_LENGTH(`class_dramatica_issue1`.`issue`), CONCAT_WS('',   `class_dramatica_issue1`.`issue`), '') as 'issue', IF(    CHAR_LENGTH(`class_dramatica_themes1`.`theme`), CONCAT_WS('',   `class_dramatica_themes1`.`theme`), '') as 'theme'",
			'storylines' => "`storylines`.`id` as 'id', IF(    CHAR_LENGTH(`story1`.`id`) || CHAR_LENGTH(`story1`.`story`), CONCAT_WS('',   `story1`.`id`, '  ', `story1`.`story`), '') as 'story', `storylines`.`story_act` as 'story_act', IF(    CHAR_LENGTH(`storyweaving_scenes1`.`id`), CONCAT_WS('',   `storyweaving_scenes1`.`id`), '') as 'storyweaving_scene_no', IF(    CHAR_LENGTH(`storyweaving_scenes1`.`step`) || CHAR_LENGTH(`class_dramatica_throughline1`.`throughline`), CONCAT_WS('',   `storyweaving_scenes1`.`step`, '  ', `class_dramatica_throughline1`.`throughline`), '') as 'storyweaving_scene', IF(    CHAR_LENGTH(`storyweaving_scenes1`.`sequence`), CONCAT_WS('',   `storyweaving_scenes1`.`sequence`), '') as 'storyweaving_sequence', IF(    CHAR_LENGTH(`class_dramatica_issue1`.`issue`) || CHAR_LENGTH(`class_dramatica_themes1`.`theme`), CONCAT_WS('',   `class_dramatica_issue1`.`issue`, `class_dramatica_themes1`.`theme`), '') as 'storyweaving_theme', IF(    CHAR_LENGTH(`class_dramatica_archetype1`.`archetype`), CONCAT_WS('',   `class_dramatica_archetype1`.`archetype`, ' '), '') as 'role', IF(    CHAR_LENGTH(`story_characters1`.`character`) || CHAR_LENGTH(`story_characters1`.`cw_name`), CONCAT_WS('',   `story_characters1`.`character`, ' - ', `story_characters1`.`cw_name`), '') as 'character', IF(    CHAR_LENGTH(`code_encounters1`.`id`) || CHAR_LENGTH(`code_encounter_scenes1`.`scene`), CONCAT_WS('',   `code_encounters1`.`id`, '  ', `code_encounter_scenes1`.`scene`), '') as 'characterevent_scene', IF(    CHAR_LENGTH(`code_encounter_scenes2`.`scene`) || CHAR_LENGTH(`code_encounter_scenes3`.`scene`), CONCAT_WS('',   `code_encounter_scenes2`.`scene`, `code_encounter_scenes3`.`scene`, '  '), '') as 'character_event', `storylines`.`storyline_no` as 'storyline_no', `storylines`.`storyline` as 'storyline'",
			'dictionary' => "`dictionary`.`id` as 'id', `dictionary`.`term` as 'term', `dictionary`.`definition` as 'definition'",
			'class_agent_type1' => "`class_agent_type1`.`id` as 'id', `class_agent_type1`.`type` as 'type'",
			'class_agent_type2' => "`class_agent_type2`.`id` as 'id', `class_agent_type2`.`type` as 'type'",
			'class_authority_agent' => "`class_authority_agent`.`id` as 'id', `class_authority_agent`.`abbreviation` as 'abbreviation', `class_authority_agent`.`authority_name` as 'authority_name'",
			'class_authority_library' => "`class_authority_library`.`id` as 'id', `class_authority_library`.`abbreviation` as 'abbreviation', `class_authority_library`.`authority_name` as 'authority_name'",
			'class_bibliography_genre' => "`class_bibliography_genre`.`id` as 'id', `class_bibliography_genre`.`genre` as 'genre'",
			'class_bibliography_type' => "`class_bibliography_type`.`id` as 'id', `class_bibliography_type`.`type` as 'type'",
			'class_dramatica_archetype' => "`class_dramatica_archetype`.`id` as 'id', `class_dramatica_archetype`.`archetype` as 'archetype', `class_dramatica_archetype`.`description` as 'description'",
			'class_dramatica_domain' => "`class_dramatica_domain`.`id` as 'id', `class_dramatica_domain`.`domain` as 'domain', `class_dramatica_domain`.`description` as 'description'",
			'class_dramatica_concern' => "`class_dramatica_concern`.`id` as 'id', IF(    CHAR_LENGTH(`class_dramatica_domain1`.`domain`), CONCAT_WS('',   `class_dramatica_domain1`.`domain`), '') as 'domain', `class_dramatica_concern`.`concern` as 'concern', `class_dramatica_concern`.`description` as 'description'",
			'class_dramatica_issue' => "`class_dramatica_issue`.`id` as 'id', IF(    CHAR_LENGTH(`class_dramatica_domain1`.`domain`), CONCAT_WS('',   `class_dramatica_domain1`.`domain`), '') as 'domain', IF(    CHAR_LENGTH(`class_dramatica_concern1`.`concern`), CONCAT_WS('',   `class_dramatica_concern1`.`concern`), '') as 'concern', `class_dramatica_issue`.`issue` as 'issue', `class_dramatica_issue`.`description` as 'description'",
			'class_dramatica_themes' => "`class_dramatica_themes`.`id` as 'id', IF(    CHAR_LENGTH(`class_dramatica_domain1`.`domain`), CONCAT_WS('',   `class_dramatica_domain1`.`domain`), '') as 'domain', IF(    CHAR_LENGTH(`class_dramatica_concern1`.`concern`), CONCAT_WS('',   `class_dramatica_concern1`.`concern`), '') as 'concern', IF(    CHAR_LENGTH(`class_dramatica_issue1`.`issue`), CONCAT_WS('',   `class_dramatica_issue1`.`issue`), '') as 'issue', `class_dramatica_themes`.`theme` as 'theme', `class_dramatica_themes`.`description` as 'description'",
			'class_dramatica_throughline' => "`class_dramatica_throughline`.`id` as 'id', `class_dramatica_throughline`.`throughline` as 'throughline', `class_dramatica_throughline`.`description` as 'description'",
			'class_im' => "`class_im`.`id` as 'id', `class_im`.`impression` as 'impression', `class_im`.`description` as 'description', `class_im`.`category` as 'category'",
			'class_language' => "`class_language`.`id` as 'id', `class_language`.`short` as 'short', `class_language`.`language` as 'language'",
			'class_nt' => "`class_nt`.`id` as 'id', `class_nt`.`noetictension` as 'noetictension'",
			'class_character_element' => "`class_character_element`.`id` as 'id', `class_character_element`.`element` as 'element', `class_character_element`.`value` as 'value'",
			'class_rights' => "`class_rights`.`id` as 'id', `class_rights`.`right` as 'right', `class_rights`.`description` as 'description', `class_rights`.`certification` as 'certification'"
		);

		if(isset($sql_fields[$table_name])){
			return $sql_fields[$table_name];
		}

		return false;
	}
	#########################################################
	function get_sql_from($table_name, $skip_permissions = false){
		$sql_from = array(   
			'biblio_author' => "`biblio_author` LEFT JOIN `class_agent_type1` as class_agent_type11 ON `class_agent_type11`.`id`=`biblio_author`.`agenttype1` LEFT JOIN `class_agent_type2` as class_agent_type21 ON `class_agent_type21`.`id`=`biblio_author`.`agenttype2` LEFT JOIN `class_authority_agent` as class_authority_agent1 ON `class_authority_agent1`.`id`=`biblio_author`.`authority_organization` ",
			'biblio_doc' => "`biblio_doc` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`biblio_doc`.`author_name` LEFT JOIN `class_bibliography_type` as class_bibliography_type1 ON `class_bibliography_type1`.`id`=`biblio_doc`.`type` LEFT JOIN `class_bibliography_genre` as class_bibliography_genre1 ON `class_bibliography_genre1`.`id`=`biblio_doc`.`genre` LEFT JOIN `class_language` as class_language1 ON `class_language1`.`id`=`biblio_doc`.`language` LEFT JOIN `class_rights` as class_rights1 ON `class_rights1`.`id`=`biblio_doc`.`rights` LEFT JOIN `class_authority_library` as class_authority_library1 ON `class_authority_library1`.`id`=`biblio_doc`.`authority_organization` ",
			'biblio_trascript' => "`biblio_trascript` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`biblio_trascript`.`author` LEFT JOIN `biblio_doc` as biblio_doc1 ON `biblio_doc1`.`id`=`biblio_trascript`.`bibliography_title` ",
			'biblio_token' => "`biblio_token` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`biblio_token`.`author` LEFT JOIN `biblio_doc` as biblio_doc1 ON `biblio_doc1`.`id`=`biblio_token`.`bibliography` LEFT JOIN `biblio_trascript` as biblio_trascript1 ON `biblio_trascript1`.`id`=`biblio_token`.`transcript` ",
			'code_invivo' => "`code_invivo` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`code_invivo`.`author` LEFT JOIN `biblio_doc` as biblio_doc1 ON `biblio_doc1`.`id`=`code_invivo`.`bibliography` LEFT JOIN `biblio_trascript` as biblio_trascript1 ON `biblio_trascript1`.`id`=`code_invivo`.`transcript` LEFT JOIN `biblio_token` as biblio_token1 ON `biblio_token1`.`id`=`code_invivo`.`token_sequence` ",
			'code_herme' => "`code_herme` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`code_herme`.`author` LEFT JOIN `biblio_doc` as biblio_doc1 ON `biblio_doc1`.`id`=`code_herme`.`bibliography` LEFT JOIN `biblio_trascript` as biblio_trascript1 ON `biblio_trascript1`.`id`=`code_herme`.`transcript` LEFT JOIN `biblio_token` as biblio_token1 ON `biblio_token1`.`id`=`code_herme`.`token_sequence` LEFT JOIN `class_im` as class_im1 ON `class_im1`.`id`=`code_herme`.`impression` LEFT JOIN `class_nt` as class_nt1 ON `class_nt1`.`id`=`code_herme`.`noetictension` ",
			'code_chrev_scenes' => "`code_chrev_scenes` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`code_chrev_scenes`.`author` LEFT JOIN `biblio_doc` as biblio_doc1 ON `biblio_doc1`.`id`=`code_chrev_scenes`.`bibliography` LEFT JOIN `biblio_trascript` as biblio_trascript1 ON `biblio_trascript1`.`id`=`code_chrev_scenes`.`transcript` LEFT JOIN `biblio_token` as biblio_token1 ON `biblio_token1`.`id`=`code_chrev_scenes`.`token_sequence` LEFT JOIN `biblio_author` as biblio_author2 ON `biblio_author2`.`id`=`code_chrev_scenes`.`agent` LEFT JOIN `code_invivo` as code_invivo1 ON `code_invivo1`.`id`=`code_chrev_scenes`.`invivo_code` LEFT JOIN `biblio_token` as biblio_token2 ON `biblio_token2`.`id`=`code_invivo1`.`token_sequence` LEFT JOIN `code_herme` as code_herme1 ON `code_herme1`.`id`=`code_chrev_scenes`.`herme_code` LEFT JOIN `code_encounter_scenes` as code_encounter_scenes1 ON `code_encounter_scenes1`.`id`=`code_chrev_scenes`.`scene` LEFT JOIN `class_im` as class_im1 ON `class_im1`.`id`=`code_herme1`.`impression` LEFT JOIN `class_nt` as class_nt1 ON `class_nt1`.`id`=`code_herme1`.`noetictension` ",
			'code_character_development' => "`code_character_development` LEFT JOIN `story` as story1 ON `story1`.`id`=`code_character_development`.`story` LEFT JOIN `story_characters` as story_characters1 ON `story_characters1`.`id`=`code_character_development`.`agent` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`story_characters1`.`agent_name` LEFT JOIN `biblio_author` as biblio_author2 ON `biblio_author2`.`id`=`code_character_development`.`author` LEFT JOIN `biblio_doc` as biblio_doc1 ON `biblio_doc1`.`id`=`code_character_development`.`bibliography` LEFT JOIN `biblio_trascript` as biblio_trascript1 ON `biblio_trascript1`.`id`=`code_character_development`.`transcript` LEFT JOIN `biblio_token` as biblio_token1 ON `biblio_token1`.`id`=`code_character_development`.`token` LEFT JOIN `code_herme` as code_herme1 ON `code_herme1`.`id`=`code_character_development`.`code` LEFT JOIN `class_character_element` as class_character_element1 ON `class_character_element1`.`id`=`code_character_development`.`character_element` LEFT JOIN `class_dramatica_archetype` as class_dramatica_archetype1 ON `class_dramatica_archetype1`.`id`=`story_characters1`.`role` ",
			'code_encounters' => "`code_encounters` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`code_encounters`.`agentA` LEFT JOIN `biblio_author` as biblio_author2 ON `biblio_author2`.`id`=`code_encounters`.`authorA` LEFT JOIN `biblio_doc` as biblio_doc1 ON `biblio_doc1`.`id`=`code_encounters`.`bibliographyA` LEFT JOIN `biblio_trascript` as biblio_trascript1 ON `biblio_trascript1`.`id`=`code_encounters`.`transcriptA` LEFT JOIN `biblio_token` as biblio_token1 ON `biblio_token1`.`id`=`code_encounters`.`tokenA` LEFT JOIN `code_encounter_scenes` as code_encounter_scenes1 ON `code_encounter_scenes1`.`id`=`code_encounters`.`sceneA` LEFT JOIN `biblio_author` as biblio_author3 ON `biblio_author3`.`id`=`code_encounters`.`agentB` LEFT JOIN `biblio_author` as biblio_author4 ON `biblio_author4`.`id`=`code_encounters`.`authorB` LEFT JOIN `biblio_doc` as biblio_doc2 ON `biblio_doc2`.`id`=`code_encounters`.`bibliographyB` LEFT JOIN `biblio_trascript` as biblio_trascript2 ON `biblio_trascript2`.`id`=`code_encounters`.`transcriptB` LEFT JOIN `biblio_token` as biblio_token2 ON `biblio_token2`.`id`=`code_encounters`.`tokenB` LEFT JOIN `code_encounter_scenes` as code_encounter_scenes2 ON `code_encounter_scenes2`.`id`=`code_encounters`.`sceneB` LEFT JOIN `code_encounter_scenes` as code_encounter_scenes3 ON `code_encounter_scenes3`.`id`=`code_encounters`.`story_scene` ",
			'code_encounter_scenes' => "`code_encounter_scenes` ",
			'story' => "`story` ",
			'story_characters' => "`story_characters` LEFT JOIN `story` as story1 ON `story1`.`id`=`story_characters`.`story` LEFT JOIN `class_dramatica_archetype` as class_dramatica_archetype1 ON `class_dramatica_archetype1`.`id`=`story_characters`.`role` LEFT JOIN `biblio_author` as biblio_author1 ON `biblio_author1`.`id`=`story_characters`.`agent_name` LEFT JOIN `class_nt` as class_nt1 ON `class_nt1`.`id`=`story_characters`.`noetictension` LEFT JOIN `class_im` as class_im1 ON `class_im1`.`id`=`story_characters`.`impression` ",
			'storypoints_static' => "`storypoints_static` LEFT JOIN `story` as story1 ON `story1`.`id`=`storypoints_static`.`story` LEFT JOIN `class_dramatica_throughline` as class_dramatica_throughline1 ON `class_dramatica_throughline1`.`id`=`storypoints_static`.`throughline` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain1 ON `class_dramatica_domain1`.`id`=`storypoints_static`.`throughline_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern1 ON `class_dramatica_concern1`.`id`=`storypoints_static`.`concern` LEFT JOIN `class_dramatica_issue` as class_dramatica_issue1 ON `class_dramatica_issue1`.`id`=`storypoints_static`.`issue` LEFT JOIN `class_dramatica_themes` as class_dramatica_themes1 ON `class_dramatica_themes1`.`id`=`storypoints_static`.`problem` LEFT JOIN `class_dramatica_themes` as class_dramatica_themes2 ON `class_dramatica_themes2`.`id`=`storypoints_static`.`solution` LEFT JOIN `class_dramatica_themes` as class_dramatica_themes3 ON `class_dramatica_themes3`.`id`=`storypoints_static`.`symptom` LEFT JOIN `class_dramatica_themes` as class_dramatica_themes4 ON `class_dramatica_themes4`.`id`=`storypoints_static`.`response` LEFT JOIN `class_dramatica_issue` as class_dramatica_issue2 ON `class_dramatica_issue2`.`id`=`storypoints_static`.`catalyst` LEFT JOIN `class_dramatica_issue` as class_dramatica_issue3 ON `class_dramatica_issue3`.`id`=`storypoints_static`.`inhibitor` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern2 ON `class_dramatica_concern2`.`id`=`storypoints_static`.`benchmark` ",
			'storydynamic' => "`storydynamic` LEFT JOIN `story` as story1 ON `story1`.`id`=`storydynamic`.`story` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain1 ON `class_dramatica_domain1`.`id`=`storydynamic`.`OS_goal_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern1 ON `class_dramatica_concern1`.`id`=`storydynamic`.`OS_goal_concern` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain2 ON `class_dramatica_domain2`.`id`=`storydynamic`.`OS_consequence_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern2 ON `class_dramatica_concern2`.`id`=`storydynamic`.`OS_consequence_concern` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain3 ON `class_dramatica_domain3`.`id`=`storydynamic`.`OS_cost_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern3 ON `class_dramatica_concern3`.`id`=`storydynamic`.`OS_cost_concern` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain4 ON `class_dramatica_domain4`.`id`=`storydynamic`.`OS_dividend_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern4 ON `class_dramatica_concern4`.`id`=`storydynamic`.`OS_dividend_concern` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain5 ON `class_dramatica_domain5`.`id`=`storydynamic`.`OS_requirements_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern5 ON `class_dramatica_concern5`.`id`=`storydynamic`.`OS_requirements_concern` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain6 ON `class_dramatica_domain6`.`id`=`storydynamic`.`OS_prerequesites_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern6 ON `class_dramatica_concern6`.`id`=`storydynamic`.`OS_prerequesites_concern` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain7 ON `class_dramatica_domain7`.`id`=`storydynamic`.`OS_preconditions_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern7 ON `class_dramatica_concern7`.`id`=`storydynamic`.`OS_preconditions_concern` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain8 ON `class_dramatica_domain8`.`id`=`storydynamic`.`OS_forewarnings_domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern8 ON `class_dramatica_concern8`.`id`=`storydynamic`.`OS_forewarnings_concern` ",
			'storyweaving_scenes' => "`storyweaving_scenes` LEFT JOIN `story` as story1 ON `story1`.`id`=`storyweaving_scenes`.`story` LEFT JOIN `class_dramatica_throughline` as class_dramatica_throughline1 ON `class_dramatica_throughline1`.`id`=`storyweaving_scenes`.`throughline` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain1 ON `class_dramatica_domain1`.`id`=`storyweaving_scenes`.`domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern1 ON `class_dramatica_concern1`.`id`=`storyweaving_scenes`.`concern` LEFT JOIN `class_dramatica_issue` as class_dramatica_issue1 ON `class_dramatica_issue1`.`id`=`storyweaving_scenes`.`issue` LEFT JOIN `class_dramatica_themes` as class_dramatica_themes1 ON `class_dramatica_themes1`.`id`=`storyweaving_scenes`.`theme` ",
			'storylines' => "`storylines` LEFT JOIN `story` as story1 ON `story1`.`id`=`storylines`.`story` LEFT JOIN `storyweaving_scenes` as storyweaving_scenes1 ON `storyweaving_scenes1`.`id`=`storylines`.`storyweaving_scene_no` LEFT JOIN `class_dramatica_archetype` as class_dramatica_archetype1 ON `class_dramatica_archetype1`.`id`=`storylines`.`role` LEFT JOIN `story_characters` as story_characters1 ON `story_characters1`.`id`=`storylines`.`character` LEFT JOIN `code_encounters` as code_encounters1 ON `code_encounters1`.`id`=`storylines`.`characterevent_scene` LEFT JOIN `code_encounter_scenes` as code_encounter_scenes1 ON `code_encounter_scenes1`.`id`=`code_encounters1`.`story_scene` LEFT JOIN `class_dramatica_throughline` as class_dramatica_throughline1 ON `class_dramatica_throughline1`.`id`=`storyweaving_scenes1`.`throughline` LEFT JOIN `class_dramatica_issue` as class_dramatica_issue1 ON `class_dramatica_issue1`.`id`=`storyweaving_scenes1`.`issue` LEFT JOIN `class_dramatica_themes` as class_dramatica_themes1 ON `class_dramatica_themes1`.`id`=`storyweaving_scenes1`.`theme` LEFT JOIN `code_encounter_scenes` as code_encounter_scenes2 ON `code_encounter_scenes2`.`id`=`code_encounters1`.`sceneA` LEFT JOIN `code_encounter_scenes` as code_encounter_scenes3 ON `code_encounter_scenes3`.`id`=`code_encounters1`.`sceneB` ",
			'dictionary' => "`dictionary` ",
			'class_agent_type1' => "`class_agent_type1` ",
			'class_agent_type2' => "`class_agent_type2` ",
			'class_authority_agent' => "`class_authority_agent` ",
			'class_authority_library' => "`class_authority_library` ",
			'class_bibliography_genre' => "`class_bibliography_genre` ",
			'class_bibliography_type' => "`class_bibliography_type` ",
			'class_dramatica_archetype' => "`class_dramatica_archetype` ",
			'class_dramatica_domain' => "`class_dramatica_domain` ",
			'class_dramatica_concern' => "`class_dramatica_concern` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain1 ON `class_dramatica_domain1`.`id`=`class_dramatica_concern`.`domain` ",
			'class_dramatica_issue' => "`class_dramatica_issue` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain1 ON `class_dramatica_domain1`.`id`=`class_dramatica_issue`.`domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern1 ON `class_dramatica_concern1`.`id`=`class_dramatica_issue`.`concern` ",
			'class_dramatica_themes' => "`class_dramatica_themes` LEFT JOIN `class_dramatica_domain` as class_dramatica_domain1 ON `class_dramatica_domain1`.`id`=`class_dramatica_themes`.`domain` LEFT JOIN `class_dramatica_concern` as class_dramatica_concern1 ON `class_dramatica_concern1`.`id`=`class_dramatica_themes`.`concern` LEFT JOIN `class_dramatica_issue` as class_dramatica_issue1 ON `class_dramatica_issue1`.`id`=`class_dramatica_themes`.`issue` ",
			'class_dramatica_throughline' => "`class_dramatica_throughline` ",
			'class_im' => "`class_im` ",
			'class_language' => "`class_language` ",
			'class_nt' => "`class_nt` ",
			'class_character_element' => "`class_character_element` ",
			'class_rights' => "`class_rights` "
		);

		$pkey = array(   
			'biblio_author' => 'id',
			'biblio_doc' => 'id',
			'biblio_trascript' => 'id',
			'biblio_token' => 'id',
			'code_invivo' => 'id',
			'code_herme' => 'id',
			'code_chrev_scenes' => 'id',
			'code_character_development' => 'id',
			'code_encounters' => 'id',
			'code_encounter_scenes' => 'id',
			'story' => 'id',
			'story_characters' => 'id',
			'storypoints_static' => 'id',
			'storydynamic' => 'id',
			'storyweaving_scenes' => 'id',
			'storylines' => 'id',
			'dictionary' => 'id',
			'class_agent_type1' => 'id',
			'class_agent_type2' => 'id',
			'class_authority_agent' => 'id',
			'class_authority_library' => 'id',
			'class_bibliography_genre' => 'id',
			'class_bibliography_type' => 'id',
			'class_dramatica_archetype' => 'id',
			'class_dramatica_domain' => 'id',
			'class_dramatica_concern' => 'id',
			'class_dramatica_issue' => 'id',
			'class_dramatica_themes' => 'id',
			'class_dramatica_throughline' => 'id',
			'class_im' => 'id',
			'class_language' => 'id',
			'class_nt' => 'id',
			'class_character_element' => 'id',
			'class_rights' => 'id'
		);

		if(isset($sql_from[$table_name])){
			if($skip_permissions) return $sql_from[$table_name];

			// mm: build the query based on current member's permissions
			$perm = getTablePermissions($table_name);
			if($perm[2] == 1){ // view owner only
				$sql_from[$table_name] .= ", membership_userrecords WHERE `{$table_name}`.`{$pkey[$table_name]}`=membership_userrecords.pkValue and membership_userrecords.tableName='{$table_name}' and lcase(membership_userrecords.memberID)='" . getLoggedMemberID() . "'";
			}elseif($perm[2] == 2){ // view group only
				$sql_from[$table_name] .= ", membership_userrecords WHERE `{$table_name}`.`{$pkey[$table_name]}`=membership_userrecords.pkValue and membership_userrecords.tableName='{$table_name}' and membership_userrecords.groupID='" . getLoggedGroupID() . "'";
			}elseif($perm[2] == 3){ // view all
				$sql_from[$table_name] .= ' WHERE 1=1';
			}else{ // view none
				return false;
			}
			return $sql_from[$table_name];
		}

		return false;
	}
	#########################################################
	function getLoggedGroupID(){
		if($_SESSION['memberGroupID']!=''){
			return $_SESSION['memberGroupID'];
		}else{
			setAnonymousAccess();
			return getLoggedGroupID();
		}
	}
	#########################################################
	function getLoggedMemberID(){
		if($_SESSION['memberID']!=''){
			return strtolower($_SESSION['memberID']);
		}else{
			setAnonymousAccess();
			return getLoggedMemberID();
		}
	}
	#########################################################
	function setAnonymousAccess(){
		$adminConfig = config('adminConfig');

		$anonGroupID=sqlValue("select groupID from membership_groups where name='".$adminConfig['anonymousGroup']."'");
		$_SESSION['memberGroupID']=($anonGroupID ? $anonGroupID : 0);

		$anonMemberID=sqlValue("select lcase(memberID) from membership_users where lcase(memberID)='".strtolower($adminConfig['anonymousMember'])."' and groupID='$anonGroupID'");
		$_SESSION['memberID']=($anonMemberID ? $anonMemberID : 0);
	}
	#########################################################
	function logInMember(){
		$redir='index.php';
		if($_POST['signIn']!=''){
			if($_POST['username']!='' && $_POST['password']!=''){
				$username=makeSafe(strtolower(trim($_POST['username'])));
				$password=md5(trim($_POST['password']));

				if(sqlValue("select count(1) from membership_users where lcase(memberID)='$username' and passMD5='$password' and isApproved=1 and isBanned=0")==1){
					$_SESSION['memberID']=$username;
					$_SESSION['memberGroupID']=sqlValue("select groupID from membership_users where lcase(memberID)='$username'");
					if($_POST['rememberMe']==1){
						@setcookie('spindle_rememberMe', md5($username.$password), time()+86400*30);
					}else{
						@setcookie('spindle_rememberMe', '', time()-86400*30);
					}

					// hook: login_ok
					if(function_exists('login_ok')){
						$args=array();
						if(!$redir=login_ok(getMemberInfo(), $args)){
							$redir='index.php';
						}
					}

					redirect($redir);
					exit;
				}
			}

			// hook: login_failed
			if(function_exists('login_failed')){
				$args=array();
				login_failed(array(
					'username' => $_POST['username'],
					'password' => $_POST['password'],
					'IP' => $_SERVER['REMOTE_ADDR']
					), $args);
			}

			redirect("index.php?loginFailed=1");
			exit;
		}elseif((!$_SESSION['memberID'] || $_SESSION['memberID']==$adminConfig['anonymousMember']) && $_COOKIE['spindle_rememberMe']!=''){
			$chk=makeSafe($_COOKIE['spindle_rememberMe']);
			if($username=sqlValue("select memberID from membership_users where convert(md5(concat(memberID, passMD5)), char)='$chk' and isBanned=0")){
				$_SESSION['memberID']=$username;
				$_SESSION['memberGroupID']=sqlValue("select groupID from membership_users where lcase(memberID)='$username'");
			}
		}
	}
	#########################################################
	function logOutMember(){
		logOutUser();
		redirect("index.php?signIn=1");
	}
	#########################################################
	function htmlUserBar(){
		global $adminConfig, $Translation;

		ob_start();
		$home_page = (basename($_SERVER['PHP_SELF'])=='index.php' ? true : false);

		?>
		<nav class="navbar navbar-default navbar-fixed-top hidden-print" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- application title is obtained from the name besides the yellow database icon in AppGini, use underscores for spaces -->
				<a class="navbar-brand" href="index.php"><i class="glyphicon glyphicon-home"></i> spindle</a>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<?php if(!$home_page){ ?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $Translation['select a table']; ?> <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu">
								<?php echo NavMenus(); ?>
							</ul>
						</li>
					<?php } ?>
				</ul>

				<?php if(getLoggedAdmin()){ ?>
					<ul class="nav navbar-nav">
						<a href="admin/pageHome.php" class="btn btn-danger navbar-btn visible-sm visible-md visible-lg"><i class="glyphicon glyphicon-wrench"></i> <?php echo $Translation['admin area']; ?></a>
						<a href="admin/pageHome.php" class="visible-xs btn btn-danger navbar-btn btn-lg"><i class="glyphicon glyphicon-wrench"></i> <?php echo $Translation['admin area']; ?></a>
					</ul>
				<?php } ?>

				<?php if(!$_GET['signIn'] && !$_GET['loginFailed']){ ?>
					<?php if(getLoggedMemberID() == $adminConfig['anonymousMember']){ ?>
					<?php }else{ ?>
						<a class="btn navbar-btn btn-default navbar-right" href="index.php?signOut=1"><i class="glyphicon glyphicon-log-out"></i> <?php echo $Translation['sign out']; ?></a>
						<p class="navbar-text navbar-right">
							<?php echo $Translation['signed as']; ?> <strong><a href="membership_profile.php" class="navbar-link"><?php echo getLoggedMemberID(); ?></a></strong>
						</p>
					<?php } ?>
				<?php } ?>
			</div>
		</nav>
		<?php

		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}
	#########################################################
	function showNotifications($msg = '', $class = '', $fadeout = true){
		global $Translation;

		$notify_template_no_fadeout = '<div id="%%ID%%" class="alert alert-dismissable %%CLASS%%" style="display: none;">' .
					'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' .
					'%%MSG%%</div>' .
					'<script> jQuery(function(){ jQuery("#%%ID%%").show("slow"); }); </script>'."\n";
		$notify_template = '<div id="%%ID%%" class="alert %%CLASS%%" style="display: none;">%%MSG%%</div>' .
					'<script>' .
						'jQuery(function(){' .
							'jQuery("#%%ID%%").show("slow", function(){' .
								'setTimeout(function(){ jQuery("#%%ID%%").hide("slow"); }, 4000);' .
							'});' .
						'});' .
					'</script>'."\n";

		if(!$msg){ // if no msg, use url to detect message to display
			if($_REQUEST['record-added-ok'] != ''){
				$msg = $Translation['new record saved'];
				$class = 'alert-success';
			}elseif($_REQUEST['record-added-error'] != ''){
				$msg = $Translation['Couldn\'t save the new record'];
				$class = 'alert-danger';
				$fadeout = false;
			}elseif($_REQUEST['record-updated-ok'] != ''){
				$msg = $Translation['record updated'];
				$class = 'alert-success';
			}elseif($_REQUEST['record-updated-error'] != ''){
				$msg = $Translation['Couldn\'t save changes to the record'];
				$class = 'alert-danger';
				$fadeout = false;
			}elseif($_REQUEST['record-deleted-ok'] != ''){
				$msg = $Translation['The record has been deleted successfully'];
				$class = 'alert-success';
				$fadeout = false;
			}elseif($_REQUEST['record-deleted-error'] != ''){
				$msg = $Translation['Couldn\'t delete this record'];
				$class = 'alert-danger';
				$fadeout = false;
			}else{
				return '';
			}
		}
		$id = 'notification-' . rand();

		$out = ($fadeout ? $notify_template : $notify_template_no_fadeout);
		$out = str_replace('%%ID%%', $id, $out);
		$out = str_replace('%%MSG%%', $msg, $out);
		$out = str_replace('%%CLASS%%', $class, $out);

		return $out;
	}
	#########################################################
	function parseMySQLDate($date, $altDate){
		// is $date valid?
		if(preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($date))){
			return trim($date);
		}

		if($date != '--' && preg_match("/^\d{4}-\d{1,2}-\d{1,2}$/", trim($altDate))){
			return trim($altDate);
		}

		if($date != '--' && $altDate && intval($altDate)==$altDate){
			return @date('Y-m-d', @time() + ($altDate >= 1 ? $altDate - 1 : $altDate) * 86400);
		}

		return '';
	}
	#########################################################
	function parseCode($code, $isInsert=true, $rawData=false){
		if($isInsert){
			$arrCodes=array(
				'<%%creatorusername%%>' => $_SESSION['memberID'],
				'<%%creatorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%creatorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%creatorgroup%%>' => sqlValue("select name from membership_groups where groupID='{$_SESSION['memberGroupID']}'"),

				'<%%creationdate%%>' => ($rawData ? @date('Y-m-d') : @date('j/n/Y')),
				'<%%creationtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%creationdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('j/n/Y h:i:s a')),
				'<%%creationtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			);
		}else{
			$arrCodes=array(
				'<%%editorusername%%>' => $_SESSION['memberID'],
				'<%%editorgroupid%%>' => $_SESSION['memberGroupID'],
				'<%%editorip%%>' => $_SERVER['REMOTE_ADDR'],
				'<%%editorgroup%%>' => sqlValue("select name from membership_groups where groupID='{$_SESSION['memberGroupID']}'"),

				'<%%editingdate%%>' => ($rawData ? @date('Y-m-d') : @date('j/n/Y')),
				'<%%editingtime%%>' => ($rawData ? @date('H:i:s') : @date('h:i:s a')),
				'<%%editingdatetime%%>' => ($rawData ? @date('Y-m-d H:i:s') : @date('j/n/Y h:i:s a')),
				'<%%editingtimestamp%%>' => ($rawData ? @date('Y-m-d H:i:s') : @time())
			);
		}

		$pc=str_ireplace(array_keys($arrCodes), array_values($arrCodes), $code);

		return $pc;
	}
	#########################################################
	function addFilter($index, $filterAnd, $filterField, $filterOperator, $filterValue){
		// validate input
		if($index<1 || $index>80 || !is_int($index))   return false;
		if($filterAnd!='or')   $filterAnd='and';
		$filterField=intval($filterField);
		if(!in_array($filterOperator, array('<=>', '!=', '>', '>=', '<', '<=', 'like', 'not like', 'isEmpty', 'isNotEmpty')))
			$filterOperator='like';

		if(!$filterField){
			$filterOperator='';
			$filterValue='';
		}

		if($_SERVER['REQUEST_METHOD']=='POST'){
			$_POST['FilterAnd'][$index]=$filterAnd;
			$_POST['FilterField'][$index]=$filterField;
			$_POST['FilterOperator'][$index]=$filterOperator;
			$_POST['FilterValue'][$index]=$filterValue;
		}else{
			$_GET['FilterAnd'][$index]=$filterAnd;
			$_GET['FilterField'][$index]=$filterField;
			$_GET['FilterOperator'][$index]=$filterOperator;
			$_GET['FilterValue'][$index]=$filterValue;
		}

		return true;
	}
	#########################################################
	function clearFilters(){
		for($i=1; $i<=80; $i++){
			addFilter($i, '', 0, '', '');
		}
	}
	#########################################################
	function getMemberInfo($memberID = ''){
		static $member_info = array();

		if(!$memberID){
			$memberID = getLoggedMemberID();
		}

		// return cached results, if present
		if(isset($member_info[$memberID])) return $member_info[$memberID];

		$adminConfig = config('adminConfig');
		$mi = array();

		if($memberID){
			$res = sql("select * from membership_users where memberID='" . makeSafe($memberID) . "'", $eo);
			if($row = db_fetch_assoc($res)){
				$mi = array(
					'username' => $memberID,
					'groupID' => $row['groupID'],
					'group' => sqlValue("select name from membership_groups where groupID='{$row['groupID']}'"),
					'admin' => ($adminConfig['adminUsername'] == $memberID ? true : false),
					'email' => $row['email'],
					'custom' => array(
						$row['custom1'], 
						$row['custom2'], 
						$row['custom3'], 
						$row['custom4']
					),
					'banned' => ($row['isBanned'] ? true : false),
					'approved' => ($row['isApproved'] ? true : false),
					'signupDate' => @date('n/j/Y', @strtotime($row['signupDate'])),
					'comments' => $row['comments'],
					'IP' => $_SERVER['REMOTE_ADDR']
				);

				// cache results
				$member_info[$memberID] = $mi;
			}
		}

		return $mi;
	}
	#########################################################
	if(!function_exists('str_ireplace')){
		function str_ireplace($search, $replace, $subject){
			$ret=$subject;
			if(is_array($search)){
				for($i=0; $i<count($search); $i++){
					$ret=str_ireplace($search[$i], $replace[$i], $ret);
				}
			}else{
				$ret=preg_replace('/'.preg_quote($search, '/').'/i', $replace, $ret);
			}

			return $ret;
		} 
	} 
	#########################################################
	/**
	* Loads a given view from the templates folder, passing the given data to it
	* @param $view the name of a php file (without extension) to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_view (optional) associative array containing the data to pass to the view
	* @return the output of the parsed view as a string
	*/
	function loadView($view, $the_data_to_pass_to_the_view=false){
		global $Translation;

		$view = dirname(__FILE__)."/templates/$view.php";
		if(!is_file($view)) return false;

		if(is_array($the_data_to_pass_to_the_view)){
			foreach($the_data_to_pass_to_the_view as $k => $v)
				$$k = $v;
		}
		unset($the_data_to_pass_to_the_view, $k, $v);

		ob_start();
		@include($view);
		$out=ob_get_contents();
		ob_end_clean();

		return $out;
	}
	#########################################################
	/**
	* Loads a table template from the templates folder, passing the given data to it
	* @param $table_name the name of the table whose template is to be loaded from the 'templates' folder
	* @param $the_data_to_pass_to_the_table associative array containing the data to pass to the table template
	* @return the output of the parsed table template as a string
	*/
	function loadTable($table_name, $the_data_to_pass_to_the_table = array()){
		$dont_load_header = $the_data_to_pass_to_the_table['dont_load_header'];
		$dont_load_footer = $the_data_to_pass_to_the_table['dont_load_footer'];

		$header = $table = $footer = '';

		if(!$dont_load_header){
			// try to load tablename-header
			if(!($header = loadView("{$table_name}-header", $the_data_to_pass_to_the_table))){
				$header = loadView('table-common-header', $the_data_to_pass_to_the_table);
			}
		}

		$table = loadView($table_name, $the_data_to_pass_to_the_table);

		if(!$dont_load_footer){
			// try to load tablename-footer
			if(!($footer = loadView("{$table_name}-footer", $the_data_to_pass_to_the_table))){
				$footer = loadView('table-common-footer', $the_data_to_pass_to_the_table);
			}
		}

		return "{$header}{$table}{$footer}";
	}
	#########################################################
	function filterDropdownBy($filterable, $filterers, $parentFilterers, $parentPKField, $parentCaption, $parentTable, &$filterableCombo){
		$filterersArray = explode(',', $filterers);
		$parentFilterersArray = explode(',', $parentFilterers);
		$parentFiltererList = '`' . implode('`, `', $parentFilterersArray) . '`';
		$res=sql("SELECT `$parentPKField`, $parentCaption, $parentFiltererList FROM `$parentTable` ORDER BY 2", $eo);
		$filterableData = array();
		while($row=db_fetch_row($res)){
			$filterableData[$row[0]] = $row[1];
			$filtererIndex = 0;
			foreach($filterersArray as $filterer){
				$filterableDataByFilterer[$filterer][$row[$filtererIndex + 2]][$row[0]] = $row[1];
				$filtererIndex++;
			}
			$row[0] = addslashes($row[0]);
			$row[1] = addslashes($row[1]);
			$jsonFilterableData .= "\"{$row[0]}\":\"{$row[1]}\",";
		}
		$jsonFilterableData .= '}';
		$jsonFilterableData = '{'.str_replace(',}', '}', $jsonFilterableData);     
		$filterJS = "\nvar {$filterable}_data = $jsonFilterableData;";

		foreach($filterersArray as $filterer){
			if(is_array($filterableDataByFilterer[$filterer])) foreach($filterableDataByFilterer[$filterer] as $filtererItem => $filterableItem){
				$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filtererItem).'":{';
				foreach($filterableItem as $filterableItemID => $filterableItemData){
					$jsonFilterableDataByFilterer[$filterer] .= '"'.addslashes($filterableItemID).'":"'.addslashes($filterableItemData).'",';
				}
				$jsonFilterableDataByFilterer[$filterer] .= '},';
			}
			$jsonFilterableDataByFilterer[$filterer] .= '}';
			$jsonFilterableDataByFilterer[$filterer] = '{'.str_replace(',}', '}', $jsonFilterableDataByFilterer[$filterer]);

			$filterJS.="\n\n// code for filtering {$filterable} by {$filterer}\n";
			$filterJS.="\nvar {$filterable}_data_by_{$filterer} = {$jsonFilterableDataByFilterer[$filterer]}; ";
			$filterJS.="\nvar selected_{$filterable} = \$F('{$filterable}');";
			$filterJS.="\nvar {$filterable}_change_by_{$filterer} = function(){";
			$filterJS.="\n\t$('{$filterable}').options.length=0;";
			$filterJS.="\n\t$('{$filterable}').options[0] = new Option();";
			$filterJS.="\n\tif(\$F('{$filterer}')){";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[\$F('{$filterer}')]){";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data_by_{$filterer}[\$F('{$filterer}')][{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t}else{";
			$filterJS.="\n\t\tfor({$filterable}_item in {$filterable}_data){";
			$filterJS.="\n\t\t\t$('{$filterable}').options[$('{$filterable}').options.length] = new Option(";
			$filterJS.="\n\t\t\t\t{$filterable}_data[{$filterable}_item],";
			$filterJS.="\n\t\t\t\t{$filterable}_item,";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false),";
			$filterJS.="\n\t\t\t\t({$filterable}_item == selected_{$filterable} ? true : false)";
			$filterJS.="\n\t\t\t);";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t\tif(selected_{$filterable} && selected_{$filterable} == \$F('{$filterable}')){";
			$filterJS.="\n\t\t\tfor({$filterer}_item in {$filterable}_data_by_{$filterer}){";
			$filterJS.="\n\t\t\t\tfor({$filterable}_item in {$filterable}_data_by_{$filterer}[{$filterer}_item]){";
			$filterJS.="\n\t\t\t\t\tif({$filterable}_item == selected_{$filterable}){";
			$filterJS.="\n\t\t\t\t\t\t$('{$filterer}').value = {$filterer}_item;";
			$filterJS.="\n\t\t\t\t\t\tbreak;";
			$filterJS.="\n\t\t\t\t\t}";
			$filterJS.="\n\t\t\t\t}";
			$filterJS.="\n\t\t\t\tif({$filterable}_item == selected_{$filterable}) break;";
			$filterJS.="\n\t\t\t}";
			$filterJS.="\n\t\t}";
			$filterJS.="\n\t}";
			$filterJS.="\n\t$('{$filterable}').highlight();";
			$filterJS.="\n};";
			$filterJS.="\n$('{$filterer}').observe('change', function(){ window.setTimeout({$filterable}_change_by_{$filterer}, 25); });";
			$filterJS.="\n";
		}

		$filterableCombo = new Combo;
		$filterableCombo->ListType = 0;
		$filterableCombo->ListItem = array_slice(array_values($filterableData), 0, 10);
		$filterableCombo->ListData = array_slice(array_keys($filterableData), 0, 10);
		$filterableCombo->SelectName = $filterable;
		$filterableCombo->AllowNull = true;

		return $filterJS;
	}
	#########################################################
	function br2nl($text){
		return  preg_replace('/\<br(\s*)?\/?\>/i', "\n", $text);
	}

	#########################################################
	if(!function_exists('htmlspecialchars_decode')){
		function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT){
			return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
		}
	}

	#########################################################
	function entitiesToUTF8($input){
		return preg_replace_callback('/(&#[0-9]+;)/', '_toUTF8', $input);
	}

	function _toUTF8($m){
		if(function_exists('mb_convert_encoding')){
			return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
		}else{
			return $m[1];
		}
	}

	#########################################################
	function func_get_args_byref() {
		if(!function_exists('debug_backtrace')) return false;

		$trace = debug_backtrace();
		return $trace[1]['args'];
	}

	#########################################################
	function html_attr($str) {
		return htmlspecialchars($str, ENT_QUOTES);
	}
	#########################################################

	function permissions_sql($table, $level = 'all'){
		if(!in_array($level, array('user', 'group'))){ $level = 'all'; }
		$perm = getTablePermissions($table);
		$from = '';
		$where = '';
		$pk = getPKFieldName($table);

		if($perm[2] == 1 || ($perm[2] > 1 && $level == 'user')){ // view owner only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."')";
		}elseif($perm[2] == 2 || ($perm[2] > 2 && $level == 'group')){ // view group only
			$from = 'membership_userrecords';
			$where = "(`$table`.`$pk`=membership_userrecords.pkValue and membership_userrecords.tableName='$table' and membership_userrecords.groupID='".getLoggedGroupID()."')";
		}elseif($perm[2] == 3){ // view all
			// no further action
		}elseif($perm[2] == 0){ // view none
			return false;
		}

		return array('where' => $where, 'from' => $from, 0 => $where, 1 => $from);
	}

	#########################################################
	function error_message($msg, $back_url = ''){
		$curr_dir = dirname(__FILE__);
		global $Translation;

		ob_start();

		include_once($curr_dir . '/header.php');
		echo '<div class="panel panel-danger">';
			echo '<div class="panel-heading"><h3 class="panel-title">' . $Translation['error:'] . '</h3></div>';
			echo '<div class="panel-body"><p class="text-danger">' . $msg . '</p>';
			if($back_url !== false){ // explicitly passing false suppresses the back link completely
				echo '<div class="text-center">';
				if($back_url){
					echo '<a href="' . $back_url . '" class="btn btn-danger btn-lg vspacer-lg"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}else{
					echo '<a href="#" class="btn btn-danger btn-lg vspacer-lg" onclick="history.go(-1); return false;"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['< back'] . '</a>';
				}
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';
		include_once($curr_dir . '/footer.php');

		$out = ob_get_contents();
		ob_end_clean();

		return $out;
	}
	#########################################################

