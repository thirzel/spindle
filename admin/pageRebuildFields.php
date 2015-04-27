<?php
	$currDir=dirname(__FILE__);
	require("$currDir/incCommon.php");
	include("$currDir/incHeader.php");

	/* application schema as created in AppGini */
	$schema = array(   
		'biblio_author' => array(   
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'memberID' => array('appgini' => 'VARCHAR(40) unique '),
			'img' => array('appgini' => 'VARCHAR(40) '),
			'groupID' => array('appgini' => 'VARCHAR(40) '),
			'selection_class' => array('appgini' => 'VARCHAR(40) '),
			'agenttype1' => array('appgini' => 'INT unsigned '),
			'agenttype2' => array('appgini' => 'INT unsigned '),
			'gender' => array('appgini' => 'VARCHAR(40) '),
			'last_name' => array('appgini' => 'VARCHAR(40) '),
			'first_name' => array('appgini' => 'VARCHAR(40) '),
			'other_name' => array('appgini' => 'VARCHAR(40) '),
			'birthday' => array('appgini' => 'DATETIME '),
			'birth_location' => array('appgini' => 'VARCHAR(40) '),
			'deathday' => array('appgini' => 'DATETIME '),
			'death_location' => array('appgini' => 'VARCHAR(40) '),
			'workplace' => array('appgini' => 'VARCHAR(40) '),
			'knows' => array('appgini' => 'VARCHAR(40) '),
			'shortbio' => array('appgini' => 'TEXT '),
			'data_evaluation' => array('appgini' => 'VARCHAR(40) '),
			'authority_record' => array('appgini' => 'VARCHAR(255) '),
			'authority_organization' => array('appgini' => 'INT(10) unsigned ')
		),
		'biblio_doc' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'img' => array('appgini' => 'VARCHAR(40) '),
			'author_name' => array('appgini' => 'INT unsigned '),
			'author_id' => array('appgini' => 'INT unsigned '),
			'type' => array('appgini' => 'INT(10) unsigned '),
			'genre' => array('appgini' => 'INT(10) unsigned '),
			'created' => array('appgini' => 'DATETIME '),
			'published' => array('appgini' => 'DATETIME '),
			'title' => array('appgini' => 'LONGTEXT '),
			'subtitle' => array('appgini' => 'LONGTEXT '),
			'publisher' => array('appgini' => 'VARCHAR(40) '),
			'location' => array('appgini' => 'VARCHAR(40) '),
			'citation' => array('appgini' => 'TEXT '),
			'description' => array('appgini' => 'TEXT '),
			'source' => array('appgini' => 'VARCHAR(40) '),
			'medium' => array('appgini' => 'VARCHAR(40) '),
			'language' => array('appgini' => 'INT(10) unsigned '),
			'format' => array('appgini' => 'VARCHAR(40) '),
			'subject' => array('appgini' => 'TEXT '),
			'rights' => array('appgini' => 'INT unsigned '),
			'rights_holder' => array('appgini' => 'VARCHAR(255) '),
			'data_evaluation' => array('appgini' => 'VARCHAR(40) '),
			'authority_record' => array('appgini' => 'VARCHAR(255) '),
			'authority_organization' => array('appgini' => 'INT(10) unsigned '),
			'pdf_book' => array('appgini' => 'VARCHAR(255) '),
			'ext_source' => array('appgini' => 'VARCHAR(255) ')
		),
		'biblio_trascript' => array(   
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'author' => array('appgini' => 'INT unsigned '),
			'author_memberID' => array('appgini' => 'INT unsigned '),
			'bibliography_id' => array('appgini' => 'INT(10) unsigned '),
			'bibliography_title' => array('appgini' => 'INT(10) unsigned '),
			'trascriber_memberID' => array('appgini' => 'VARCHAR(40) '),
			'transcript_title' => array('appgini' => 'VARCHAR(40) '),
			'transcript' => array('appgini' => 'VARCHAR(40) '),
			'credits' => array('appgini' => 'VARCHAR(40) ')
		),
		'biblio_token' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'author' => array('appgini' => 'INT unsigned '),
			'bibliography' => array('appgini' => 'INT(10) unsigned '),
			'transcript' => array('appgini' => 'INT unsigned '),
			'token_sequence' => array('appgini' => 'INT(11) '),
			'token' => array('appgini' => 'LONGTEXT ')
		),
		'code_invivo' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'author' => array('appgini' => 'INT unsigned '),
			'bibliography' => array('appgini' => 'INT(10) unsigned '),
			'transcript' => array('appgini' => 'INT unsigned '),
			'token_sequence' => array('appgini' => 'INT(10) unsigned '),
			'token' => array('appgini' => 'INT(10) unsigned '),
			'invivo' => array('appgini' => 'LONGTEXT '),
			'start_date' => array('appgini' => 'DATETIME '),
			'end_date' => array('appgini' => 'DATETIME '),
			'person' => array('appgini' => 'VARCHAR(255) '),
			'place' => array('appgini' => 'VARCHAR(40) '),
			'freecode' => array('appgini' => 'LONGTEXT ')
		),
		'code_herme' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'author' => array('appgini' => 'INT unsigned '),
			'bibliography' => array('appgini' => 'INT(10) unsigned '),
			'transcript' => array('appgini' => 'INT unsigned '),
			'token_sequence' => array('appgini' => 'INT(10) unsigned '),
			'token' => array('appgini' => 'INT(10) unsigned '),
			'impression' => array('appgini' => 'INT(10) unsigned '),
			'noetictension' => array('appgini' => 'INT(10) unsigned '),
			'freecode' => array('appgini' => 'LONGTEXT ')
		),
		'code_chrev_scenes' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'author' => array('appgini' => 'INT unsigned '),
			'bibliography' => array('appgini' => 'INT(10) unsigned '),
			'transcript' => array('appgini' => 'INT unsigned '),
			'token_sequence' => array('appgini' => 'INT(10) unsigned '),
			'token' => array('appgini' => 'INT(10) unsigned '),
			'agent' => array('appgini' => 'INT unsigned '),
			'invivo_code' => array('appgini' => 'INT(10) unsigned '),
			'startdate' => array('appgini' => 'INT(10) unsigned default \'1\' '),
			'end_date' => array('appgini' => 'INT(10) unsigned default \'1\' '),
			'person' => array('appgini' => 'INT(10) unsigned '),
			'place' => array('appgini' => 'INT(10) unsigned '),
			'freecode' => array('appgini' => 'INT(10) unsigned '),
			'herme_code' => array('appgini' => 'INT(10) unsigned '),
			'impression' => array('appgini' => 'INT(10) unsigned '),
			'noetictension' => array('appgini' => 'INT(10) unsigned '),
			'comment' => array('appgini' => 'INT(10) unsigned '),
			'scene' => array('appgini' => 'INT unsigned ')
		),
		'code_character_development' => array(   
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'story' => array('appgini' => 'INT(10) unsigned '),
			'agent' => array('appgini' => 'INT(10) unsigned '),
			'story_character' => array('appgini' => 'INT(10) unsigned '),
			'author' => array('appgini' => 'INT unsigned '),
			'bibliography' => array('appgini' => 'INT(10) unsigned '),
			'transcript' => array('appgini' => 'INT unsigned '),
			'token_sequence' => array('appgini' => 'INT(10) unsigned '),
			'token' => array('appgini' => 'INT(10) unsigned '),
			'code' => array('appgini' => 'INT(10) unsigned '),
			'character_element' => array('appgini' => 'INT unsigned '),
			'character_elem_value' => array('appgini' => 'INT unsigned '),
			'comment' => array('appgini' => 'TEXT ')
		),
		'code_encounters' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'agentA' => array('appgini' => 'INT unsigned '),
			'authorA' => array('appgini' => 'INT unsigned '),
			'bibliographyA' => array('appgini' => 'INT(10) unsigned '),
			'transcriptA' => array('appgini' => 'INT unsigned '),
			'tokenA' => array('appgini' => 'INT(10) unsigned '),
			'sceneA' => array('appgini' => 'INT unsigned '),
			'agentB' => array('appgini' => 'INT unsigned '),
			'authorB' => array('appgini' => 'INT unsigned '),
			'bibliographyB' => array('appgini' => 'INT(10) unsigned '),
			'transcriptB' => array('appgini' => 'INT unsigned '),
			'tokenB' => array('appgini' => 'INT(10) unsigned '),
			'sceneB' => array('appgini' => 'INT unsigned '),
			'type' => array('appgini' => 'VARCHAR(40) '),
			'conflicttype' => array('appgini' => 'VARCHAR(40) '),
			'story_scene' => array('appgini' => 'INT unsigned '),
			'nd_color' => array('appgini' => 'INT(10) unsigned '),
			'nd_width' => array('appgini' => 'VARCHAR(40) '),
			'nd_style' => array('appgini' => 'VARCHAR(40) '),
			'nd_opacity' => array('appgini' => 'VARCHAR(40) '),
			'nd_visibility' => array('appgini' => 'VARCHAR(40) '),
			'lbl_lable' => array('appgini' => 'VARCHAR(40) '),
			'lbl_color' => array('appgini' => 'VARCHAR(40) '),
			'lbl_size' => array('appgini' => 'VARCHAR(40) ')
		),
		'code_encounter_scenes' => array(   
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'scene' => array('appgini' => 'TEXT ')
		),
		'story' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'subject' => array('appgini' => 'VARCHAR(40) '),
			'story' => array('appgini' => 'VARCHAR(40) '),
			'tags' => array('appgini' => 'VARCHAR(80) '),
			'collaboration_status' => array('appgini' => 'VARCHAR(40) ')
		),
		'story_characters' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'story' => array('appgini' => 'INT(10) unsigned '),
			'role' => array('appgini' => 'INT(10) unsigned '),
			'character' => array('appgini' => 'VARCHAR(40) '),
			'memberID' => array('appgini' => 'INT unsigned '),
			'agent_name' => array('appgini' => 'INT unsigned '),
			'cw_name' => array('appgini' => 'VARCHAR(40) '),
			'img' => array('appgini' => 'INT unsigned '),
			'MC_resolve' => array('appgini' => 'INT(10) unsigned '),
			'MC_growth' => array('appgini' => 'INT(10) unsigned '),
			'MC_approach' => array('appgini' => 'INT(10) unsigned '),
			'MC_PS_style' => array('appgini' => 'INT(10) unsigned '),
			'cw_age' => array('appgini' => 'VARCHAR(40) '),
			'cw_gender' => array('appgini' => 'INT(10) unsigned '),
			'cw_communication_style' => array('appgini' => 'TEXT '),
			'cw_background' => array('appgini' => 'TEXT '),
			'cw_appearance' => array('appgini' => 'TEXT '),
			'cw_relationships' => array('appgini' => 'VARCHAR(255) '),
			'cw_ambition' => array('appgini' => 'TEXT '),
			'cw_character_defects' => array('appgini' => 'TEXT '),
			'cw_thoughts' => array('appgini' => 'TEXT '),
			'cw_relatedness' => array('appgini' => 'VARCHAR(255) '),
			'cw_restrictions' => array('appgini' => 'TEXT '),
			'locations' => array('appgini' => 'VARCHAR(255) '),
			'persons' => array('appgini' => 'VARCHAR(255) '),
			'events' => array('appgini' => 'TEXT '),
			'noetictension' => array('appgini' => 'INT(10) unsigned '),
			'impression' => array('appgini' => 'INT(10) unsigned ')
		),
		'storypoints_static' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'story' => array('appgini' => 'INT(10) unsigned '),
			'throughline' => array('appgini' => 'INT(10) unsigned '),
			'throughline_domain' => array('appgini' => 'INT(10) unsigned '),
			'concern' => array('appgini' => 'INT(10) unsigned '),
			'issue' => array('appgini' => 'INT(10) unsigned '),
			'problem' => array('appgini' => 'INT(10) unsigned '),
			'solution' => array('appgini' => 'INT(10) unsigned '),
			'symptom' => array('appgini' => 'INT(10) unsigned '),
			'response' => array('appgini' => 'INT(10) unsigned '),
			'catalyst' => array('appgini' => 'INT(10) unsigned '),
			'inhibitor' => array('appgini' => 'INT(10) unsigned '),
			'benchmark' => array('appgini' => 'INT(10) unsigned ')
		),
		'storydynamic' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'story' => array('appgini' => 'INT(10) unsigned '),
			'MC_resolve' => array('appgini' => 'VARCHAR(40) '),
			'MC_growth' => array('appgini' => 'VARCHAR(40) '),
			'MC_approach' => array('appgini' => 'VARCHAR(40) '),
			'MC_PS_style' => array('appgini' => 'VARCHAR(40) '),
			'IC_resolve' => array('appgini' => 'VARCHAR(40) '),
			'OS_driver' => array('appgini' => 'VARCHAR(40) '),
			'OS_limit' => array('appgini' => 'VARCHAR(40) '),
			'OS_outcome' => array('appgini' => 'VARCHAR(40) '),
			'OS_judgement' => array('appgini' => 'VARCHAR(40) '),
			'OS_goal_domain' => array('appgini' => 'INT(10) unsigned '),
			'OS_goal_concern' => array('appgini' => 'INT(10) unsigned '),
			'OS_consequence_domain' => array('appgini' => 'INT(10) unsigned '),
			'OS_consequence_concern' => array('appgini' => 'INT(10) unsigned '),
			'OS_cost_domain' => array('appgini' => 'INT(10) unsigned '),
			'OS_cost_concern' => array('appgini' => 'INT(10) unsigned '),
			'OS_dividend_domain' => array('appgini' => 'INT(10) unsigned '),
			'OS_dividend_concern' => array('appgini' => 'INT(10) unsigned '),
			'OS_requirements_domain' => array('appgini' => 'INT(10) unsigned '),
			'OS_requirements_concern' => array('appgini' => 'INT(10) unsigned '),
			'OS_prerequesites_domain' => array('appgini' => 'INT(10) unsigned '),
			'OS_prerequesites_concern' => array('appgini' => 'INT(10) unsigned '),
			'OS_preconditions_domain' => array('appgini' => 'INT(10) unsigned '),
			'OS_preconditions_concern' => array('appgini' => 'INT(10) unsigned '),
			'OS_forewarnings_domain' => array('appgini' => 'INT(10) unsigned '),
			'OS_forewarnings_concern' => array('appgini' => 'INT(10) unsigned ')
		),
		'storyweaving_scenes' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'story' => array('appgini' => 'INT(10) unsigned '),
			'step' => array('appgini' => 'VARCHAR(40) '),
			'throughline' => array('appgini' => 'INT(10) unsigned '),
			'domain' => array('appgini' => 'INT(10) unsigned '),
			'concern' => array('appgini' => 'INT(10) unsigned '),
			'sequence' => array('appgini' => 'VARCHAR(40) '),
			'issue' => array('appgini' => 'INT(10) unsigned '),
			'theme' => array('appgini' => 'INT(10) unsigned ')
		),
		'storylines' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'story' => array('appgini' => 'INT(10) unsigned '),
			'story_act' => array('appgini' => 'VARCHAR(40) '),
			'storyweaving_scene_no' => array('appgini' => 'INT(10) unsigned '),
			'storyweaving_scene' => array('appgini' => 'INT(10) unsigned '),
			'storyweaving_sequence' => array('appgini' => 'INT(10) unsigned '),
			'storyweaving_theme' => array('appgini' => 'INT(10) unsigned '),
			'role' => array('appgini' => 'INT(10) unsigned '),
			'character' => array('appgini' => 'INT(10) unsigned '),
			'characterevent_scene' => array('appgini' => 'INT(10) unsigned '),
			'character_event' => array('appgini' => 'INT(10) unsigned '),
			'storyline_no' => array('appgini' => 'VARCHAR(40) '),
			'storyline' => array('appgini' => 'TEXT ')
		),
		'dictionary' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'term' => array('appgini' => 'VARCHAR(40) '),
			'definition' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_agent_type1' => array(   
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'type' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_agent_type2' => array(   
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'type' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_authority_agent' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'abbreviation' => array('appgini' => 'VARCHAR(40) '),
			'authority_name' => array('appgini' => 'VARCHAR(250) ')
		),
		'class_authority_library' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'abbreviation' => array('appgini' => 'VARCHAR(40) '),
			'authority_name' => array('appgini' => 'VARCHAR(80) ')
		),
		'class_bibliography_genre' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'genre' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_bibliography_type' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'type' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_dramatica_archetype' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'archetype' => array('appgini' => 'VARCHAR(40) '),
			'description' => array('appgini' => 'TEXT ')
		),
		'class_dramatica_domain' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'domain' => array('appgini' => 'VARCHAR(40) '),
			'description' => array('appgini' => 'TEXT ')
		),
		'class_dramatica_concern' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'domain' => array('appgini' => 'INT(10) unsigned '),
			'concern' => array('appgini' => 'VARCHAR(40) '),
			'description' => array('appgini' => 'TEXT ')
		),
		'class_dramatica_issue' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'domain' => array('appgini' => 'INT(10) unsigned '),
			'concern' => array('appgini' => 'INT(10) unsigned '),
			'issue' => array('appgini' => 'VARCHAR(40) '),
			'description' => array('appgini' => 'TEXT ')
		),
		'class_dramatica_themes' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'domain' => array('appgini' => 'INT(10) unsigned '),
			'concern' => array('appgini' => 'INT(10) unsigned '),
			'issue' => array('appgini' => 'INT(10) unsigned '),
			'theme' => array('appgini' => 'VARCHAR(40) '),
			'description' => array('appgini' => 'TEXT ')
		),
		'class_dramatica_throughline' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'throughline' => array('appgini' => 'VARCHAR(40) '),
			'description' => array('appgini' => 'TEXT ')
		),
		'class_im' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'impression' => array('appgini' => 'VARCHAR(40) '),
			'description' => array('appgini' => 'TEXT '),
			'category' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_language' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'short' => array('appgini' => 'VARCHAR(40) '),
			'language' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_nt' => array(   
			'id' => array('appgini' => 'INT(10) unsigned not null primary key auto_increment '),
			'noetictension' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_character_element' => array(   
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'element' => array('appgini' => 'VARCHAR(40) '),
			'value' => array('appgini' => 'VARCHAR(40) ')
		),
		'class_rights' => array(   
			'id' => array('appgini' => 'INT unsigned not null primary key auto_increment '),
			'right' => array('appgini' => 'VARCHAR(40) '),
			'description' => array('appgini' => 'TEXT '),
			'certification' => array('appgini' => 'VARCHAR(40) ')
		)
	);

	$table_captions = getTableList();

	/* function for preparing field definition for comparison */
	function prepare_def($def){
		$def = trim($def);
		$def = strtolower($def);

		/* ignore length for int data types */
		$def = preg_replace('/int\w*\([0-9]+\)/', 'int', $def);

		/* make sure there is always a space before mysql words */
		$def = preg_replace('/(\S)(unsigned|not null|binary|zerofill|auto_increment|default)/', '$1 $2', $def);

		/* treat 0.000.. same as 0 */
		$def = preg_replace('/([0-9])*\.0+/', '$1', $def);

		/* treat unsigned zerofill same as zerofill */
		$def = str_ireplace('unsigned zerofill', 'zerofill', $def);

		/* ignore zero-padding for date data types */
		$def = preg_replace("/date\s*default\s*'([0-9]{4})-0?([1-9])-0?([1-9])'/i", "date default '$1-$2-$3'", $def);

		return $def;
	}

	/* process requested fixes */
	$fix_table = (isset($_GET['t']) ? $_GET['t'] : false);
	$fix_field = (isset($_GET['f']) ? $_GET['f'] : false);

	if($fix_table && $fix_field && isset($schema[$fix_table][$fix_field])){
		$field_added = $field_updated = false;

		// field exists?
		$res = sql("show columns from `{$fix_table}` like '{$fix_field}'", $eo);
		if($row = db_fetch_assoc($res)){
			// modify field
			$qry = "alter table `{$fix_table}` modify `{$fix_field}` {$schema[$fix_table][$fix_field]['appgini']}";
			sql($qry, $eo);
			$field_updated = true;
		}else{
			// create field
			$qry = "alter table `{$fix_table}` add column `{$fix_field}` {$schema[$fix_table][$fix_field]['appgini']}";
			sql($qry, $eo);
			$field_added = true;
		}
	}

	foreach($table_captions as $tn => $tc){
		$eo['silentErrors'] = true;
		$res = sql("show columns from `{$tn}`", $eo);
		if($res){
			while($row = db_fetch_assoc($res)){
				if(!isset($schema[$tn][$row['Field']]['appgini'])) continue;
				$field_description = strtoupper(str_replace(' ', '', $row['Type']));
				$field_description = str_ireplace('unsigned', ' unsigned', $field_description);
				$field_description = str_ireplace('zerofill', ' zerofill', $field_description);
				$field_description = str_ireplace('binary', ' binary', $field_description);
				$field_description .= ($row['Null'] == 'NO' ? ' not null' : '');
				$field_description .= ($row['Key'] == 'PRI' ? ' primary key' : '');
				$field_description .= ($row['Key'] == 'UNI' ? ' unique' : '');
				$field_description .= ($row['Default'] != '' ? " default '" . makeSafe($row['Default']) . "'" : '');
				$field_description .= ($row['Extra'] == 'auto_increment' ? ' auto_increment' : '');

				$schema[$tn][$row['Field']]['db'] = '';
				if(isset($schema[$tn][$row['Field']])){
					$schema[$tn][$row['Field']]['db'] = $field_description;
				}
			}
		}
	}
?>

<?php if($field_added || $field_updated){ ?>
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<i class="glyphicon glyphicon-info-sign"></i>
		An attempt to <?php echo ($field_added ? 'create' : 'update'); ?> the field <i><?php echo $fix_field; ?></i> in <i><?php echo $fix_table; ?></i> table
		was made by executing this query:
		<pre><?php echo $qry; ?></pre>
		Results are shown below.
	</div>
<?php } ?>

<div class="page-header"><h1>
	View/Rebuild fields
	<button type="button" class="btn btn-default" id="show_deviations_only"><i class="glyphicon glyphicon-eye-close"></i> Show deviations only</button>
	<button type="button" class="btn btn-default hidden" id="show_all_fields"><i class="glyphicon glyphicon-eye-open"></i> Show all fields</button>
</h1></div>

<p class="lead">This page compares the tables and fields structure/schema as designed in AppGini to the actual database structure and allows you to fix any deviations.</p>

<div class="alert summary"></div>
<table class="table table-responsive table-hover table-striped">
	<thead><tr>
		<th></th>
		<th>Field</th>
		<th>AppGini definition</th>
		<th>Current definition in the database</th>
		<th></th>
	</tr></thead>

	<tbody>
	<?php foreach($schema as $tn => $fields){ ?>
		<tr class="text-info"><td colspan="5"><h4 data-placement="left" data-toggle="tooltip" title="<?php echo $tn; ?> table"><i class="glyphicon glyphicon-th-list"></i> <?php echo $table_captions[$tn]; ?></h4></td></tr>
		<?php foreach($fields as $fn => $fd){ ?>
			<?php $diff = ((prepare_def($fd['appgini']) == prepare_def($fd['db'])) ? false : true); ?>
			<?php $no_db = ($fd['db'] ? false : true); ?>
			<tr class="<?php echo ($diff ? 'highlight' : 'field_ok'); ?>">
				<td><i class="glyphicon glyphicon-<?php echo ($diff ? 'remove text-danger' : 'ok text-success'); ?>"></i></td>
				<td><?php echo $fn; ?></td>
				<td class="<?php echo ($diff ? 'bold text-success' : ''); ?>"><?php echo $fd['appgini']; ?></td>
				<td class="<?php echo ($diff ? 'bold text-danger' : ''); ?>"><?php echo thisOr($fd['db'], "Doesn't exist!"); ?></td>
				<td>
					<?php if($diff && $no_db){ ?>
						<a href="pageRebuildFields.php?t=<?php echo $tn; ?>&f=<?php echo $fn; ?>" class="btn btn-success btn-xs btn_create" data-toggle="tooltip" data-placement="top" title="Create the field by running an ADD COLUMN query."><i class="glyphicon glyphicon-plus"></i> Create it</a>
					<?php }elseif($diff){ ?>
						<a href="pageRebuildFields.php?t=<?php echo $tn; ?>&f=<?php echo $fn; ?>" class="btn btn-warning btn-xs btn_update" data-toggle="tooltip" title="Fix the field by running an ALTER COLUMN query so that its definition becomes the same as that in AppGini."><i class="glyphicon glyphicon-cog"></i> Fix it</a>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	<?php } ?>
	</tbody>
</table>
<div class="alert summary"></div>

<style>
	.bold{ font-weight: bold; }
	.highlight, .highlight td{ background-color: #FFFFE0 !important; }
	[data-toggle="tooltip"]{ display: block !important; }
</style>

<script>
	jQuery(function(){
		jQuery('[data-toggle="tooltip"]').tooltip();

		jQuery('#show_deviations_only').click(function(){
			jQuery(this).addClass('hidden');
			jQuery('#show_all_fields').removeClass('hidden');
			jQuery('.field_ok').hide();
		});

		jQuery('#show_all_fields').click(function(){
			jQuery(this).addClass('hidden');
			jQuery('#show_deviations_only').removeClass('hidden');
			jQuery('.field_ok').show();
		});

		jQuery('.btn_update').click(function(){
			return confirm("DANGER!! In some cases, this might lead to data loss, truncation, or corruption. It might be a better idea sometimes to update the field in AppGini to match that in the database. Would you still like to continue?");
		});

		var count_updates = jQuery('.btn_update').length;
		var count_creates = jQuery('.btn_create').length;
		if(!count_creates && !count_updates){
			jQuery('.summary').addClass('alert-success').html('No deviations found. All fields OK!');
		}else{
			jQuery('.summary')
				.addClass('alert-warning')
				.html(
					'Found ' + count_creates + ' non-existing fields that need to be created.<br>' +
					'Found ' + count_updates + ' deviating fields that might need to be updated.'
				);
		}
	});
</script>

<?php
	include("$currDir/incFooter.php");
?>
