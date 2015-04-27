<?php
	// check this file's MD5 to make sure it wasn't called before
	$prevMD5=@implode('', @file(dirname(__FILE__).'/setup.md5'));
	$thisMD5=md5(@implode('', @file("./updateDB.php")));
	if($thisMD5==$prevMD5){
		$setupAlreadyRun=true;
	}else{
		// set up tables
		if(!isset($silent)){
			$silent=true;
		}

		// set up tables
		setupTable('biblio_author', "create table if not exists `biblio_author` (   `id` INT unsigned not null auto_increment , primary key (`id`), `memberID` VARCHAR(40) , unique(`memberID`), `img` VARCHAR(40) , `groupID` VARCHAR(40) , `selection_class` VARCHAR(40) , `agenttype1` INT unsigned , `agenttype2` INT unsigned , `gender` VARCHAR(40) , `last_name` VARCHAR(40) , `first_name` VARCHAR(40) , `other_name` VARCHAR(40) , `birthday` DATETIME , `birth_location` VARCHAR(40) , `deathday` DATETIME , `death_location` VARCHAR(40) , `workplace` VARCHAR(40) , `knows` VARCHAR(40) , `shortbio` TEXT , `data_evaluation` VARCHAR(40) , `authority_record` VARCHAR(255) , `authority_organization` INT(10) unsigned ) CHARSET utf8", $silent);
		setupIndexes('biblio_author', array('agenttype1','agenttype2','authority_organization'));
		setupTable('biblio_doc', "create table if not exists `biblio_doc` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `img` VARCHAR(40) , `author_name` INT unsigned , `author_id` INT unsigned , `type` INT(10) unsigned , `genre` INT(10) unsigned , `created` DATETIME , `published` DATETIME , `title` LONGTEXT , `subtitle` LONGTEXT , `publisher` VARCHAR(40) , `location` VARCHAR(40) , `citation` TEXT , `description` TEXT , `source` VARCHAR(40) , `medium` VARCHAR(40) , `language` INT(10) unsigned , `format` VARCHAR(40) , `subject` TEXT , `rights` INT unsigned , `rights_holder` VARCHAR(255) , `data_evaluation` VARCHAR(40) , `authority_record` VARCHAR(255) , `authority_organization` INT(10) unsigned , `pdf_book` VARCHAR(255) , `ext_source` VARCHAR(255) ) CHARSET utf8", $silent);
		setupIndexes('biblio_doc', array('author_name','type','genre','language','rights','authority_organization'));
		setupTable('biblio_trascript', "create table if not exists `biblio_trascript` (   `id` INT unsigned not null auto_increment , primary key (`id`), `author` INT unsigned , `author_memberID` INT unsigned , `bibliography_id` INT(10) unsigned , `bibliography_title` INT(10) unsigned , `trascriber_memberID` VARCHAR(40) , `transcript_title` VARCHAR(40) , `transcript` VARCHAR(40) , `credits` VARCHAR(40) ) CHARSET utf8", $silent);
		setupIndexes('biblio_trascript', array('author','bibliography_title'));
		setupTable('biblio_token', "create table if not exists `biblio_token` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `author` INT unsigned , `bibliography` INT(10) unsigned , `transcript` INT unsigned , `token_sequence` INT(11) , `token` LONGTEXT ) CHARSET utf8", $silent);
		setupIndexes('biblio_token', array('author','bibliography','transcript'));
		setupTable('code_invivo', "create table if not exists `code_invivo` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `author` INT unsigned , `bibliography` INT(10) unsigned , `transcript` INT unsigned , `token_sequence` INT(10) unsigned , `token` INT(10) unsigned , `invivo` LONGTEXT , `start_date` DATETIME , `end_date` DATETIME , `person` VARCHAR(255) , `place` VARCHAR(40) , `freecode` LONGTEXT ) CHARSET utf8", $silent);
		setupIndexes('code_invivo', array('author','bibliography','transcript','token_sequence'));
		setupTable('code_herme', "create table if not exists `code_herme` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `author` INT unsigned , `bibliography` INT(10) unsigned , `transcript` INT unsigned , `token_sequence` INT(10) unsigned , `token` INT(10) unsigned , `impression` INT(10) unsigned , `noetictension` INT(10) unsigned , `freecode` LONGTEXT ) CHARSET utf8", $silent);
		setupIndexes('code_herme', array('author','bibliography','transcript','token_sequence','impression','noetictension'));
		setupTable('code_chrev_scenes', "create table if not exists `code_chrev_scenes` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `author` INT unsigned , `bibliography` INT(10) unsigned , `transcript` INT unsigned , `token_sequence` INT(10) unsigned , `token` INT(10) unsigned , `agent` INT unsigned , `invivo_code` INT(10) unsigned , `startdate` INT(10) unsigned default '1' , `end_date` INT(10) unsigned default '1' , `person` INT(10) unsigned , `place` INT(10) unsigned , `freecode` INT(10) unsigned , `herme_code` INT(10) unsigned , `impression` INT(10) unsigned , `noetictension` INT(10) unsigned , `comment` INT(10) unsigned , `scene` INT unsigned ) CHARSET utf8", $silent);
		setupIndexes('code_chrev_scenes', array('author','bibliography','transcript','token_sequence','agent','invivo_code','herme_code','scene'));
		setupTable('code_character_development', "create table if not exists `code_character_development` (   `id` INT unsigned not null auto_increment , primary key (`id`), `story` INT(10) unsigned , `agent` INT(10) unsigned , `story_character` INT(10) unsigned , `author` INT unsigned , `bibliography` INT(10) unsigned , `transcript` INT unsigned , `token_sequence` INT(10) unsigned , `token` INT(10) unsigned , `code` INT(10) unsigned , `character_element` INT unsigned , `character_elem_value` INT unsigned , `comment` TEXT ) CHARSET utf8", $silent);
		setupIndexes('code_character_development', array('story','agent','author','bibliography','transcript','token','code','character_element'));
		setupTable('code_encounters', "create table if not exists `code_encounters` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `agentA` INT unsigned , `authorA` INT unsigned , `bibliographyA` INT(10) unsigned , `transcriptA` INT unsigned , `tokenA` INT(10) unsigned , `sceneA` INT unsigned , `agentB` INT unsigned , `authorB` INT unsigned , `bibliographyB` INT(10) unsigned , `transcriptB` INT unsigned , `tokenB` INT(10) unsigned , `sceneB` INT unsigned , `type` VARCHAR(40) , `conflicttype` VARCHAR(40) , `story_scene` INT unsigned , `nd_color` INT(10) unsigned , `nd_width` VARCHAR(40) , `nd_style` VARCHAR(40) , `nd_opacity` VARCHAR(40) , `nd_visibility` VARCHAR(40) , `lbl_lable` VARCHAR(40) , `lbl_color` VARCHAR(40) , `lbl_size` VARCHAR(40) ) CHARSET utf8", $silent);
		setupIndexes('code_encounters', array('agentA','authorA','bibliographyA','transcriptA','tokenA','sceneA','agentB','authorB','bibliographyB','transcriptB','tokenB','sceneB','story_scene'));
		setupTable('code_encounter_scenes', "create table if not exists `code_encounter_scenes` (   `id` INT unsigned not null auto_increment , primary key (`id`), `scene` TEXT ) CHARSET utf8", $silent);
		setupTable('story', "create table if not exists `story` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `subject` VARCHAR(40) , `story` VARCHAR(40) , `tags` VARCHAR(80) , `collaboration_status` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('story_characters', "create table if not exists `story_characters` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `story` INT(10) unsigned , `role` INT(10) unsigned , `character` VARCHAR(40) , `memberID` INT unsigned , `agent_name` INT unsigned , `cw_name` VARCHAR(40) , `img` INT unsigned , `MC_resolve` INT(10) unsigned , `MC_growth` INT(10) unsigned , `MC_approach` INT(10) unsigned , `MC_PS_style` INT(10) unsigned , `cw_age` VARCHAR(40) , `cw_gender` INT(10) unsigned , `cw_communication_style` TEXT , `cw_background` TEXT , `cw_appearance` TEXT , `cw_relationships` VARCHAR(255) , `cw_ambition` TEXT , `cw_character_defects` TEXT , `cw_thoughts` TEXT , `cw_relatedness` VARCHAR(255) , `cw_restrictions` TEXT , `locations` VARCHAR(255) , `persons` VARCHAR(255) , `events` TEXT , `noetictension` INT(10) unsigned , `impression` INT(10) unsigned ) CHARSET utf8", $silent);
		setupIndexes('story_characters', array('story','role','agent_name','noetictension','impression'));
		setupTable('storypoints_static', "create table if not exists `storypoints_static` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `story` INT(10) unsigned , `throughline` INT(10) unsigned , `throughline_domain` INT(10) unsigned , `concern` INT(10) unsigned , `issue` INT(10) unsigned , `problem` INT(10) unsigned , `solution` INT(10) unsigned , `symptom` INT(10) unsigned , `response` INT(10) unsigned , `catalyst` INT(10) unsigned , `inhibitor` INT(10) unsigned , `benchmark` INT(10) unsigned ) CHARSET utf8", $silent);
		setupIndexes('storypoints_static', array('story','throughline','throughline_domain','concern','issue','problem','solution','symptom','response','catalyst','inhibitor','benchmark'));
		setupTable('storydynamic', "create table if not exists `storydynamic` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `story` INT(10) unsigned , `MC_resolve` VARCHAR(40) , `MC_growth` VARCHAR(40) , `MC_approach` VARCHAR(40) , `MC_PS_style` VARCHAR(40) , `IC_resolve` VARCHAR(40) , `OS_driver` VARCHAR(40) , `OS_limit` VARCHAR(40) , `OS_outcome` VARCHAR(40) , `OS_judgement` VARCHAR(40) , `OS_goal_domain` INT(10) unsigned , `OS_goal_concern` INT(10) unsigned , `OS_consequence_domain` INT(10) unsigned , `OS_consequence_concern` INT(10) unsigned , `OS_cost_domain` INT(10) unsigned , `OS_cost_concern` INT(10) unsigned , `OS_dividend_domain` INT(10) unsigned , `OS_dividend_concern` INT(10) unsigned , `OS_requirements_domain` INT(10) unsigned , `OS_requirements_concern` INT(10) unsigned , `OS_prerequesites_domain` INT(10) unsigned , `OS_prerequesites_concern` INT(10) unsigned , `OS_preconditions_domain` INT(10) unsigned , `OS_preconditions_concern` INT(10) unsigned , `OS_forewarnings_domain` INT(10) unsigned , `OS_forewarnings_concern` INT(10) unsigned ) CHARSET utf8", $silent);
		setupIndexes('storydynamic', array('story','OS_goal_domain','OS_goal_concern','OS_consequence_domain','OS_consequence_concern','OS_cost_domain','OS_cost_concern','OS_dividend_domain','OS_dividend_concern','OS_requirements_domain','OS_requirements_concern','OS_prerequesites_domain','OS_prerequesites_concern','OS_preconditions_domain','OS_preconditions_concern','OS_forewarnings_domain','OS_forewarnings_concern'));
		setupTable('storyweaving_scenes', "create table if not exists `storyweaving_scenes` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `story` INT(10) unsigned , `step` VARCHAR(40) , `throughline` INT(10) unsigned , `domain` INT(10) unsigned , `concern` INT(10) unsigned , `sequence` VARCHAR(40) , `issue` INT(10) unsigned , `theme` INT(10) unsigned ) CHARSET utf8", $silent);
		setupIndexes('storyweaving_scenes', array('story','throughline','domain','concern','issue','theme'));
		setupTable('storylines', "create table if not exists `storylines` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `story` INT(10) unsigned , `story_act` VARCHAR(40) , `storyweaving_scene_no` INT(10) unsigned , `storyweaving_scene` INT(10) unsigned , `storyweaving_sequence` INT(10) unsigned , `storyweaving_theme` INT(10) unsigned , `role` INT(10) unsigned , `character` INT(10) unsigned , `characterevent_scene` INT(10) unsigned , `character_event` INT(10) unsigned , `storyline_no` VARCHAR(40) , `storyline` TEXT ) CHARSET utf8", $silent);
		setupIndexes('storylines', array('story','storyweaving_scene_no','role','character','characterevent_scene'));
		setupTable('dictionary', "create table if not exists `dictionary` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `term` VARCHAR(40) , `definition` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_agent_type1', "create table if not exists `class_agent_type1` (   `id` INT unsigned not null auto_increment , primary key (`id`), `type` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_agent_type2', "create table if not exists `class_agent_type2` (   `id` INT unsigned not null auto_increment , primary key (`id`), `type` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_authority_agent', "create table if not exists `class_authority_agent` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `abbreviation` VARCHAR(40) , `authority_name` VARCHAR(250) ) CHARSET utf8", $silent);
		setupTable('class_authority_library', "create table if not exists `class_authority_library` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `abbreviation` VARCHAR(40) , `authority_name` VARCHAR(80) ) CHARSET utf8", $silent);
		setupTable('class_bibliography_genre', "create table if not exists `class_bibliography_genre` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `genre` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_bibliography_type', "create table if not exists `class_bibliography_type` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `type` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_dramatica_archetype', "create table if not exists `class_dramatica_archetype` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `archetype` VARCHAR(40) , `description` TEXT ) CHARSET utf8", $silent);
		setupTable('class_dramatica_domain', "create table if not exists `class_dramatica_domain` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `domain` VARCHAR(40) , `description` TEXT ) CHARSET utf8", $silent);
		setupTable('class_dramatica_concern', "create table if not exists `class_dramatica_concern` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `domain` INT(10) unsigned , `concern` VARCHAR(40) , `description` TEXT ) CHARSET utf8", $silent);
		setupIndexes('class_dramatica_concern', array('domain'));
		setupTable('class_dramatica_issue', "create table if not exists `class_dramatica_issue` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `domain` INT(10) unsigned , `concern` INT(10) unsigned , `issue` VARCHAR(40) , `description` TEXT ) CHARSET utf8", $silent);
		setupIndexes('class_dramatica_issue', array('domain','concern'));
		setupTable('class_dramatica_themes', "create table if not exists `class_dramatica_themes` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `domain` INT(10) unsigned , `concern` INT(10) unsigned , `issue` INT(10) unsigned , `theme` VARCHAR(40) , `description` TEXT ) CHARSET utf8", $silent);
		setupIndexes('class_dramatica_themes', array('domain','concern','issue'));
		setupTable('class_dramatica_throughline', "create table if not exists `class_dramatica_throughline` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `throughline` VARCHAR(40) , `description` TEXT ) CHARSET utf8", $silent);
		setupTable('class_im', "create table if not exists `class_im` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `impression` VARCHAR(40) , `description` TEXT , `category` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_language', "create table if not exists `class_language` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `short` VARCHAR(40) , `language` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_nt', "create table if not exists `class_nt` (   `id` INT(10) unsigned not null auto_increment , primary key (`id`), `noetictension` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_character_element', "create table if not exists `class_character_element` (   `id` INT unsigned not null auto_increment , primary key (`id`), `element` VARCHAR(40) , `value` VARCHAR(40) ) CHARSET utf8", $silent);
		setupTable('class_rights', "create table if not exists `class_rights` (   `id` INT unsigned not null auto_increment , primary key (`id`), `right` VARCHAR(40) , `description` TEXT , `certification` VARCHAR(40) ) CHARSET utf8", $silent);


		// save MD5
		if($fp=@fopen(dirname(__FILE__).'/setup.md5', 'w')){
			fwrite($fp, $thisMD5);
			fclose($fp);
		}
	}


	function setupIndexes($tableName, $arrFields){
		if(!is_array($arrFields)){
			return false;
		}

		foreach($arrFields as $fieldName){
			if(!$res=@db_query("SHOW COLUMNS FROM `$tableName` like '$fieldName'")){
				continue;
			}
			if(!$row=@db_fetch_assoc($res)){
				continue;
			}
			if($row['Key']==''){
				@db_query("ALTER TABLE `$tableName` ADD INDEX `$fieldName` (`$fieldName`)");
			}
		}
	}


	function setupTable($tableName, $createSQL='', $silent=true, $arrAlter=''){
		global $Translation;
		ob_start();

		echo '<div style="padding: 5px; border-bottom:solid 1px silver; font-family: verdana, arial; font-size: 10px;">';

		// is there a table rename query?
		if(is_array($arrAlter)){
			$matches=array();
			if(preg_match("/ALTER TABLE `(.*)` RENAME `$tableName`/", $arrAlter[0], $matches)){
				$oldTableName=$matches[1];
			}
		}

		if($res=@db_query("select count(1) from `$tableName`")){ // table already exists
			if($row = @db_fetch_array($res)){
				echo str_replace("<TableName>", $tableName, str_replace("<NumRecords>", $row[0],$Translation["table exists"]));
				if(is_array($arrAlter)){
					echo '<br>';
					foreach($arrAlter as $alter){
						if($alter!=''){
							echo "$alter ... ";
							if(!@db_query($alter)){
								echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
								echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
							}else{
								echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
							}
						}
					}
				}else{
					echo $Translation["table uptodate"];
				}
			}else{
				echo str_replace("<TableName>", $tableName, $Translation["couldnt count"]);
			}
		}else{ // given tableName doesn't exist

			if($oldTableName!=''){ // if we have a table rename query
				if($ro=@db_query("select count(1) from `$oldTableName`")){ // if old table exists, rename it.
					$renameQuery=array_shift($arrAlter); // get and remove rename query

					echo "$renameQuery ... ";
					if(!@db_query($renameQuery)){
						echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
						echo '<div class="text-danger">' . $Translation['mysql said'] . ' ' . db_error(db_link()) . '</div>';
					}else{
						echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
					}

					if(is_array($arrAlter)) setupTable($tableName, $createSQL, false, $arrAlter); // execute Alter queries on renamed table ...
				}else{ // if old tableName doesn't exist (nor the new one since we're here), then just create the table.
					setupTable($tableName, $createSQL, false); // no Alter queries passed ...
				}
			}else{ // tableName doesn't exist and no rename, so just create the table
				echo str_replace("<TableName>", $tableName, $Translation["creating table"]);
				if(!@db_query($createSQL)){
					echo '<span class="label label-danger">' . $Translation['failed'] . '</span>';
					echo '<div class="text-danger">' . $Translation['mysql said'] . db_error(db_link()) . '</div>';
				}else{
					echo '<span class="label label-success">' . $Translation['ok'] . '</span>';
				}
			}
		}

		echo "</div>";

		$out=ob_get_contents();
		ob_end_clean();
		if(!$silent){
			echo $out;
		}
	}
?>