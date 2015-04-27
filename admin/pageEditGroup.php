<?php
	$currDir=dirname(__FILE__);
	require("$currDir/incCommon.php");

	// get groupID of anonymous group
	$anonGroupID=sqlValue("select groupID from membership_groups where name='".$adminConfig['anonymousGroup']."'");

	// request to save changes?
	if($_POST['saveChanges']!=''){
		// validate data
		$name=makeSafe($_POST['name']);
		$description=makeSafe($_POST['description']);
		switch($_POST['visitorSignup']){
			case 0:
				$allowSignup=0;
				$needsApproval=1;
				break;
			case 2:
				$allowSignup=1;
				$needsApproval=0;
				break;
			default:
				$allowSignup=1;
				$needsApproval=1;
		}
		###############################
		$biblio_author_insert=checkPermissionVal('biblio_author_insert');
		$biblio_author_view=checkPermissionVal('biblio_author_view');
		$biblio_author_edit=checkPermissionVal('biblio_author_edit');
		$biblio_author_delete=checkPermissionVal('biblio_author_delete');
		###############################
		$biblio_doc_insert=checkPermissionVal('biblio_doc_insert');
		$biblio_doc_view=checkPermissionVal('biblio_doc_view');
		$biblio_doc_edit=checkPermissionVal('biblio_doc_edit');
		$biblio_doc_delete=checkPermissionVal('biblio_doc_delete');
		###############################
		$biblio_trascript_insert=checkPermissionVal('biblio_trascript_insert');
		$biblio_trascript_view=checkPermissionVal('biblio_trascript_view');
		$biblio_trascript_edit=checkPermissionVal('biblio_trascript_edit');
		$biblio_trascript_delete=checkPermissionVal('biblio_trascript_delete');
		###############################
		$biblio_token_insert=checkPermissionVal('biblio_token_insert');
		$biblio_token_view=checkPermissionVal('biblio_token_view');
		$biblio_token_edit=checkPermissionVal('biblio_token_edit');
		$biblio_token_delete=checkPermissionVal('biblio_token_delete');
		###############################
		$code_invivo_insert=checkPermissionVal('code_invivo_insert');
		$code_invivo_view=checkPermissionVal('code_invivo_view');
		$code_invivo_edit=checkPermissionVal('code_invivo_edit');
		$code_invivo_delete=checkPermissionVal('code_invivo_delete');
		###############################
		$code_herme_insert=checkPermissionVal('code_herme_insert');
		$code_herme_view=checkPermissionVal('code_herme_view');
		$code_herme_edit=checkPermissionVal('code_herme_edit');
		$code_herme_delete=checkPermissionVal('code_herme_delete');
		###############################
		$code_chrev_scenes_insert=checkPermissionVal('code_chrev_scenes_insert');
		$code_chrev_scenes_view=checkPermissionVal('code_chrev_scenes_view');
		$code_chrev_scenes_edit=checkPermissionVal('code_chrev_scenes_edit');
		$code_chrev_scenes_delete=checkPermissionVal('code_chrev_scenes_delete');
		###############################
		$code_character_development_insert=checkPermissionVal('code_character_development_insert');
		$code_character_development_view=checkPermissionVal('code_character_development_view');
		$code_character_development_edit=checkPermissionVal('code_character_development_edit');
		$code_character_development_delete=checkPermissionVal('code_character_development_delete');
		###############################
		$code_encounters_insert=checkPermissionVal('code_encounters_insert');
		$code_encounters_view=checkPermissionVal('code_encounters_view');
		$code_encounters_edit=checkPermissionVal('code_encounters_edit');
		$code_encounters_delete=checkPermissionVal('code_encounters_delete');
		###############################
		$code_encounter_scenes_insert=checkPermissionVal('code_encounter_scenes_insert');
		$code_encounter_scenes_view=checkPermissionVal('code_encounter_scenes_view');
		$code_encounter_scenes_edit=checkPermissionVal('code_encounter_scenes_edit');
		$code_encounter_scenes_delete=checkPermissionVal('code_encounter_scenes_delete');
		###############################
		$story_insert=checkPermissionVal('story_insert');
		$story_view=checkPermissionVal('story_view');
		$story_edit=checkPermissionVal('story_edit');
		$story_delete=checkPermissionVal('story_delete');
		###############################
		$story_characters_insert=checkPermissionVal('story_characters_insert');
		$story_characters_view=checkPermissionVal('story_characters_view');
		$story_characters_edit=checkPermissionVal('story_characters_edit');
		$story_characters_delete=checkPermissionVal('story_characters_delete');
		###############################
		$storypoints_static_insert=checkPermissionVal('storypoints_static_insert');
		$storypoints_static_view=checkPermissionVal('storypoints_static_view');
		$storypoints_static_edit=checkPermissionVal('storypoints_static_edit');
		$storypoints_static_delete=checkPermissionVal('storypoints_static_delete');
		###############################
		$storydynamic_insert=checkPermissionVal('storydynamic_insert');
		$storydynamic_view=checkPermissionVal('storydynamic_view');
		$storydynamic_edit=checkPermissionVal('storydynamic_edit');
		$storydynamic_delete=checkPermissionVal('storydynamic_delete');
		###############################
		$storyweaving_scenes_insert=checkPermissionVal('storyweaving_scenes_insert');
		$storyweaving_scenes_view=checkPermissionVal('storyweaving_scenes_view');
		$storyweaving_scenes_edit=checkPermissionVal('storyweaving_scenes_edit');
		$storyweaving_scenes_delete=checkPermissionVal('storyweaving_scenes_delete');
		###############################
		$storylines_insert=checkPermissionVal('storylines_insert');
		$storylines_view=checkPermissionVal('storylines_view');
		$storylines_edit=checkPermissionVal('storylines_edit');
		$storylines_delete=checkPermissionVal('storylines_delete');
		###############################
		$dictionary_insert=checkPermissionVal('dictionary_insert');
		$dictionary_view=checkPermissionVal('dictionary_view');
		$dictionary_edit=checkPermissionVal('dictionary_edit');
		$dictionary_delete=checkPermissionVal('dictionary_delete');
		###############################
		$class_agent_type1_insert=checkPermissionVal('class_agent_type1_insert');
		$class_agent_type1_view=checkPermissionVal('class_agent_type1_view');
		$class_agent_type1_edit=checkPermissionVal('class_agent_type1_edit');
		$class_agent_type1_delete=checkPermissionVal('class_agent_type1_delete');
		###############################
		$class_agent_type2_insert=checkPermissionVal('class_agent_type2_insert');
		$class_agent_type2_view=checkPermissionVal('class_agent_type2_view');
		$class_agent_type2_edit=checkPermissionVal('class_agent_type2_edit');
		$class_agent_type2_delete=checkPermissionVal('class_agent_type2_delete');
		###############################
		$class_authority_agent_insert=checkPermissionVal('class_authority_agent_insert');
		$class_authority_agent_view=checkPermissionVal('class_authority_agent_view');
		$class_authority_agent_edit=checkPermissionVal('class_authority_agent_edit');
		$class_authority_agent_delete=checkPermissionVal('class_authority_agent_delete');
		###############################
		$class_authority_library_insert=checkPermissionVal('class_authority_library_insert');
		$class_authority_library_view=checkPermissionVal('class_authority_library_view');
		$class_authority_library_edit=checkPermissionVal('class_authority_library_edit');
		$class_authority_library_delete=checkPermissionVal('class_authority_library_delete');
		###############################
		$class_bibliography_genre_insert=checkPermissionVal('class_bibliography_genre_insert');
		$class_bibliography_genre_view=checkPermissionVal('class_bibliography_genre_view');
		$class_bibliography_genre_edit=checkPermissionVal('class_bibliography_genre_edit');
		$class_bibliography_genre_delete=checkPermissionVal('class_bibliography_genre_delete');
		###############################
		$class_bibliography_type_insert=checkPermissionVal('class_bibliography_type_insert');
		$class_bibliography_type_view=checkPermissionVal('class_bibliography_type_view');
		$class_bibliography_type_edit=checkPermissionVal('class_bibliography_type_edit');
		$class_bibliography_type_delete=checkPermissionVal('class_bibliography_type_delete');
		###############################
		$class_dramatica_archetype_insert=checkPermissionVal('class_dramatica_archetype_insert');
		$class_dramatica_archetype_view=checkPermissionVal('class_dramatica_archetype_view');
		$class_dramatica_archetype_edit=checkPermissionVal('class_dramatica_archetype_edit');
		$class_dramatica_archetype_delete=checkPermissionVal('class_dramatica_archetype_delete');
		###############################
		$class_dramatica_domain_insert=checkPermissionVal('class_dramatica_domain_insert');
		$class_dramatica_domain_view=checkPermissionVal('class_dramatica_domain_view');
		$class_dramatica_domain_edit=checkPermissionVal('class_dramatica_domain_edit');
		$class_dramatica_domain_delete=checkPermissionVal('class_dramatica_domain_delete');
		###############################
		$class_dramatica_concern_insert=checkPermissionVal('class_dramatica_concern_insert');
		$class_dramatica_concern_view=checkPermissionVal('class_dramatica_concern_view');
		$class_dramatica_concern_edit=checkPermissionVal('class_dramatica_concern_edit');
		$class_dramatica_concern_delete=checkPermissionVal('class_dramatica_concern_delete');
		###############################
		$class_dramatica_issue_insert=checkPermissionVal('class_dramatica_issue_insert');
		$class_dramatica_issue_view=checkPermissionVal('class_dramatica_issue_view');
		$class_dramatica_issue_edit=checkPermissionVal('class_dramatica_issue_edit');
		$class_dramatica_issue_delete=checkPermissionVal('class_dramatica_issue_delete');
		###############################
		$class_dramatica_themes_insert=checkPermissionVal('class_dramatica_themes_insert');
		$class_dramatica_themes_view=checkPermissionVal('class_dramatica_themes_view');
		$class_dramatica_themes_edit=checkPermissionVal('class_dramatica_themes_edit');
		$class_dramatica_themes_delete=checkPermissionVal('class_dramatica_themes_delete');
		###############################
		$class_dramatica_throughline_insert=checkPermissionVal('class_dramatica_throughline_insert');
		$class_dramatica_throughline_view=checkPermissionVal('class_dramatica_throughline_view');
		$class_dramatica_throughline_edit=checkPermissionVal('class_dramatica_throughline_edit');
		$class_dramatica_throughline_delete=checkPermissionVal('class_dramatica_throughline_delete');
		###############################
		$class_im_insert=checkPermissionVal('class_im_insert');
		$class_im_view=checkPermissionVal('class_im_view');
		$class_im_edit=checkPermissionVal('class_im_edit');
		$class_im_delete=checkPermissionVal('class_im_delete');
		###############################
		$class_language_insert=checkPermissionVal('class_language_insert');
		$class_language_view=checkPermissionVal('class_language_view');
		$class_language_edit=checkPermissionVal('class_language_edit');
		$class_language_delete=checkPermissionVal('class_language_delete');
		###############################
		$class_nt_insert=checkPermissionVal('class_nt_insert');
		$class_nt_view=checkPermissionVal('class_nt_view');
		$class_nt_edit=checkPermissionVal('class_nt_edit');
		$class_nt_delete=checkPermissionVal('class_nt_delete');
		###############################
		$class_character_element_insert=checkPermissionVal('class_character_element_insert');
		$class_character_element_view=checkPermissionVal('class_character_element_view');
		$class_character_element_edit=checkPermissionVal('class_character_element_edit');
		$class_character_element_delete=checkPermissionVal('class_character_element_delete');
		###############################
		$class_rights_insert=checkPermissionVal('class_rights_insert');
		$class_rights_view=checkPermissionVal('class_rights_view');
		$class_rights_edit=checkPermissionVal('class_rights_edit');
		$class_rights_delete=checkPermissionVal('class_rights_delete');
		###############################

		// new group or old?
		if($_POST['groupID']==''){ // new group
			// make sure group name is unique
			if(sqlValue("select count(1) from membership_groups where name='$name'")){
				echo "<div class=\"alert alert-danger\">Error: Group name already exists. You must choose a unique group name.</div>";
				include("$currDir/incFooter.php");
			}

			// add group
			sql("insert into membership_groups set name='$name', description='$description', allowSignup='$allowSignup', needsApproval='$needsApproval'", $eo);

			// get new groupID
			$groupID=db_insert_id(db_link());

		}else{ // old group
			// validate groupID
			$groupID=intval($_POST['groupID']);

			if($groupID==$anonGroupID){
				$name=$adminConfig['anonymousGroup'];
				$allowSignup=0;
				$needsApproval=0;
			}

			// make sure group name is unique
			if(sqlValue("select count(1) from membership_groups where name='$name' and groupID!='$groupID'")){
				echo "<div class=\"alert alert-danger\">Error: Group name already exists. You must choose a unique group name.</div>";
				include("$currDir/incFooter.php");
			}

			// update group
			sql("update membership_groups set name='$name', description='$description', allowSignup='$allowSignup', needsApproval='$needsApproval' where groupID='$groupID'", $eo);

			// reset then add group permissions
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='biblio_author'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='biblio_doc'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='biblio_trascript'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='biblio_token'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='code_invivo'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='code_herme'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='code_chrev_scenes'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='code_character_development'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='code_encounters'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='code_encounter_scenes'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='story'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='story_characters'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='storypoints_static'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='storydynamic'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='storyweaving_scenes'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='storylines'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='dictionary'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_agent_type1'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_agent_type2'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_authority_agent'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_authority_library'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_bibliography_genre'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_bibliography_type'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_dramatica_archetype'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_dramatica_domain'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_dramatica_concern'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_dramatica_issue'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_dramatica_themes'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_dramatica_throughline'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_im'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_language'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_nt'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_character_element'", $eo);
			sql("delete from membership_grouppermissions where groupID='$groupID' and tableName='class_rights'", $eo);
		}

		// add group permissions
		if($groupID){
			// table 'biblio_author'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='biblio_author', allowInsert='$biblio_author_insert', allowView='$biblio_author_view', allowEdit='$biblio_author_edit', allowDelete='$biblio_author_delete'", $eo);
			// table 'biblio_doc'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='biblio_doc', allowInsert='$biblio_doc_insert', allowView='$biblio_doc_view', allowEdit='$biblio_doc_edit', allowDelete='$biblio_doc_delete'", $eo);
			// table 'biblio_trascript'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='biblio_trascript', allowInsert='$biblio_trascript_insert', allowView='$biblio_trascript_view', allowEdit='$biblio_trascript_edit', allowDelete='$biblio_trascript_delete'", $eo);
			// table 'biblio_token'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='biblio_token', allowInsert='$biblio_token_insert', allowView='$biblio_token_view', allowEdit='$biblio_token_edit', allowDelete='$biblio_token_delete'", $eo);
			// table 'code_invivo'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='code_invivo', allowInsert='$code_invivo_insert', allowView='$code_invivo_view', allowEdit='$code_invivo_edit', allowDelete='$code_invivo_delete'", $eo);
			// table 'code_herme'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='code_herme', allowInsert='$code_herme_insert', allowView='$code_herme_view', allowEdit='$code_herme_edit', allowDelete='$code_herme_delete'", $eo);
			// table 'code_chrev_scenes'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='code_chrev_scenes', allowInsert='$code_chrev_scenes_insert', allowView='$code_chrev_scenes_view', allowEdit='$code_chrev_scenes_edit', allowDelete='$code_chrev_scenes_delete'", $eo);
			// table 'code_character_development'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='code_character_development', allowInsert='$code_character_development_insert', allowView='$code_character_development_view', allowEdit='$code_character_development_edit', allowDelete='$code_character_development_delete'", $eo);
			// table 'code_encounters'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='code_encounters', allowInsert='$code_encounters_insert', allowView='$code_encounters_view', allowEdit='$code_encounters_edit', allowDelete='$code_encounters_delete'", $eo);
			// table 'code_encounter_scenes'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='code_encounter_scenes', allowInsert='$code_encounter_scenes_insert', allowView='$code_encounter_scenes_view', allowEdit='$code_encounter_scenes_edit', allowDelete='$code_encounter_scenes_delete'", $eo);
			// table 'story'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='story', allowInsert='$story_insert', allowView='$story_view', allowEdit='$story_edit', allowDelete='$story_delete'", $eo);
			// table 'story_characters'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='story_characters', allowInsert='$story_characters_insert', allowView='$story_characters_view', allowEdit='$story_characters_edit', allowDelete='$story_characters_delete'", $eo);
			// table 'storypoints_static'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='storypoints_static', allowInsert='$storypoints_static_insert', allowView='$storypoints_static_view', allowEdit='$storypoints_static_edit', allowDelete='$storypoints_static_delete'", $eo);
			// table 'storydynamic'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='storydynamic', allowInsert='$storydynamic_insert', allowView='$storydynamic_view', allowEdit='$storydynamic_edit', allowDelete='$storydynamic_delete'", $eo);
			// table 'storyweaving_scenes'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='storyweaving_scenes', allowInsert='$storyweaving_scenes_insert', allowView='$storyweaving_scenes_view', allowEdit='$storyweaving_scenes_edit', allowDelete='$storyweaving_scenes_delete'", $eo);
			// table 'storylines'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='storylines', allowInsert='$storylines_insert', allowView='$storylines_view', allowEdit='$storylines_edit', allowDelete='$storylines_delete'", $eo);
			// table 'dictionary'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='dictionary', allowInsert='$dictionary_insert', allowView='$dictionary_view', allowEdit='$dictionary_edit', allowDelete='$dictionary_delete'", $eo);
			// table 'class_agent_type1'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_agent_type1', allowInsert='$class_agent_type1_insert', allowView='$class_agent_type1_view', allowEdit='$class_agent_type1_edit', allowDelete='$class_agent_type1_delete'", $eo);
			// table 'class_agent_type2'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_agent_type2', allowInsert='$class_agent_type2_insert', allowView='$class_agent_type2_view', allowEdit='$class_agent_type2_edit', allowDelete='$class_agent_type2_delete'", $eo);
			// table 'class_authority_agent'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_authority_agent', allowInsert='$class_authority_agent_insert', allowView='$class_authority_agent_view', allowEdit='$class_authority_agent_edit', allowDelete='$class_authority_agent_delete'", $eo);
			// table 'class_authority_library'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_authority_library', allowInsert='$class_authority_library_insert', allowView='$class_authority_library_view', allowEdit='$class_authority_library_edit', allowDelete='$class_authority_library_delete'", $eo);
			// table 'class_bibliography_genre'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_bibliography_genre', allowInsert='$class_bibliography_genre_insert', allowView='$class_bibliography_genre_view', allowEdit='$class_bibliography_genre_edit', allowDelete='$class_bibliography_genre_delete'", $eo);
			// table 'class_bibliography_type'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_bibliography_type', allowInsert='$class_bibliography_type_insert', allowView='$class_bibliography_type_view', allowEdit='$class_bibliography_type_edit', allowDelete='$class_bibliography_type_delete'", $eo);
			// table 'class_dramatica_archetype'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_dramatica_archetype', allowInsert='$class_dramatica_archetype_insert', allowView='$class_dramatica_archetype_view', allowEdit='$class_dramatica_archetype_edit', allowDelete='$class_dramatica_archetype_delete'", $eo);
			// table 'class_dramatica_domain'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_dramatica_domain', allowInsert='$class_dramatica_domain_insert', allowView='$class_dramatica_domain_view', allowEdit='$class_dramatica_domain_edit', allowDelete='$class_dramatica_domain_delete'", $eo);
			// table 'class_dramatica_concern'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_dramatica_concern', allowInsert='$class_dramatica_concern_insert', allowView='$class_dramatica_concern_view', allowEdit='$class_dramatica_concern_edit', allowDelete='$class_dramatica_concern_delete'", $eo);
			// table 'class_dramatica_issue'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_dramatica_issue', allowInsert='$class_dramatica_issue_insert', allowView='$class_dramatica_issue_view', allowEdit='$class_dramatica_issue_edit', allowDelete='$class_dramatica_issue_delete'", $eo);
			// table 'class_dramatica_themes'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_dramatica_themes', allowInsert='$class_dramatica_themes_insert', allowView='$class_dramatica_themes_view', allowEdit='$class_dramatica_themes_edit', allowDelete='$class_dramatica_themes_delete'", $eo);
			// table 'class_dramatica_throughline'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_dramatica_throughline', allowInsert='$class_dramatica_throughline_insert', allowView='$class_dramatica_throughline_view', allowEdit='$class_dramatica_throughline_edit', allowDelete='$class_dramatica_throughline_delete'", $eo);
			// table 'class_im'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_im', allowInsert='$class_im_insert', allowView='$class_im_view', allowEdit='$class_im_edit', allowDelete='$class_im_delete'", $eo);
			// table 'class_language'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_language', allowInsert='$class_language_insert', allowView='$class_language_view', allowEdit='$class_language_edit', allowDelete='$class_language_delete'", $eo);
			// table 'class_nt'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_nt', allowInsert='$class_nt_insert', allowView='$class_nt_view', allowEdit='$class_nt_edit', allowDelete='$class_nt_delete'", $eo);
			// table 'class_character_element'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_character_element', allowInsert='$class_character_element_insert', allowView='$class_character_element_view', allowEdit='$class_character_element_edit', allowDelete='$class_character_element_delete'", $eo);
			// table 'class_rights'
			sql("insert into membership_grouppermissions set groupID='$groupID', tableName='class_rights', allowInsert='$class_rights_insert', allowView='$class_rights_view', allowEdit='$class_rights_edit', allowDelete='$class_rights_delete'", $eo);
		}

		// redirect to group editing page
		redirect("admin/pageEditGroup.php?groupID=$groupID");

	}elseif($_GET['groupID']!=''){
		// we have an edit request for a group
		$groupID=intval($_GET['groupID']);
	}

	include("$currDir/incHeader.php");

	if($groupID!=''){
		// fetch group data to fill in the form below
		$res=sql("select * from membership_groups where groupID='$groupID'", $eo);
		if($row=db_fetch_assoc($res)){
			// get group data
			$name=$row['name'];
			$description=$row['description'];
			$visitorSignup=($row['allowSignup']==1 && $row['needsApproval']==1 ? 1 : ($row['allowSignup']==1 ? 2 : 0));

			// get group permissions for each table
			$res=sql("select * from membership_grouppermissions where groupID='$groupID'", $eo);
			while($row=db_fetch_assoc($res)){
				$tableName=$row['tableName'];
				$vIns=$tableName."_insert";
				$vUpd=$tableName."_edit";
				$vDel=$tableName."_delete";
				$vVue=$tableName."_view";
				$$vIns=$row['allowInsert'];
				$$vUpd=$row['allowEdit'];
				$$vDel=$row['allowDelete'];
				$$vVue=$row['allowView'];
			}
		}else{
			// no such group exists
			echo "<div class=\"alert alert-danger\">Error: Group not found!</div>";
			$groupID=0;
		}
	}
?>
<div class="page-header"><h1><?php echo ($groupID ? "Edit Group '$name'" : "Add New Group"); ?></h1></div>
<?php if($anonGroupID==$groupID){ ?>
	<div class="alert alert-warning">Attention! This is the anonymous group.</div>
<?php } ?>
<input type="checkbox" id="showToolTips" value="1" checked><label for="showToolTips">Show tool tips as mouse moves over options</label>
<form method="post" action="pageEditGroup.php">
	<input type="hidden" name="groupID" value="<?php echo $groupID; ?>">
	<div class="table-responsive"><table class="table table-striped">
		<tr>
			<td align="right" class="tdFormCaption" valign="top">
				<div class="formFieldCaption">Group name</div>
				</td>
			<td align="left" class="tdFormInput">
				<input type="text" name="name" <?php echo ($anonGroupID==$groupID ? "readonly" : ""); ?> value="<?php echo $name; ?>" size="20" class="formTextBox">
				<br>
				<?php if($anonGroupID==$groupID){ ?>
					The name of the anonymous group is read-only here.
				<?php }else{ ?>
					If you name the group '<?php echo $adminConfig['anonymousGroup']; ?>', it will be considered the anonymous group<br>
					that defines the permissions of guest visitors that do not log into the system.
				<?php } ?>
				</td>
			</tr>
		<tr>
			<td align="right" valign="top" class="tdFormCaption">
				<div class="formFieldCaption">Description</div>
				</td>
			<td align="left" class="tdFormInput">
				<textarea name="description" cols="50" rows="5" class="formTextBox"><?php echo $description; ?></textarea>
				</td>
			</tr>
		<?php if($anonGroupID!=$groupID){ ?>
		<tr>
			<td align="right" valign="top" class="tdFormCaption">
				<div class="formFieldCaption">Allow visitors to sign up?</div>
				</td>
			<td align="left" class="tdFormInput">
				<?php
					echo htmlRadioGroup(
						"visitorSignup",
						array(0, 1, 2),
						array(
							"No. Only the admin can add users.",
							"Yes, and the admin must approve them.",
							"Yes, and automatically approve them."
						),
						($groupID ? $visitorSignup : $adminConfig['defaultSignUp'])
					);
				?>
				</td>
			</tr>
		<?php } ?>
		<tr>
			<td colspan="2" align="right" class="tdFormFooter">
				<input type="submit" name="saveChanges" value="Save changes">
				</td>
			</tr>
		<tr>
			<td colspan="2" class="tdFormHeader">
				<table class="table table-striped">
					<tr>
						<td class="tdFormHeader" colspan="5"><h2>Table permissions for this group</h2></td>
						</tr>
					<?php
						// permissions arrays common to the radio groups below
						$arrPermVal=array(0, 1, 2, 3);
						$arrPermText=array("No", "Owner", "Group", "All");
					?>
					<tr>
						<td class="tdHeader"><div class="ColCaption">Table</div></td>
						<td class="tdHeader"><div class="ColCaption">Insert</div></td>
						<td class="tdHeader"><div class="ColCaption">View</div></td>
						<td class="tdHeader"><div class="ColCaption">Edit</div></td>
						<td class="tdHeader"><div class="ColCaption">Delete</div></td>
						</tr>
				<!-- biblio_author table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Agents</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(biblio_author_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="biblio_author_insert" value="1" <?php echo ($biblio_author_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_author_view", $arrPermVal, $arrPermText, $biblio_author_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_author_edit", $arrPermVal, $arrPermText, $biblio_author_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_author_delete", $arrPermVal, $arrPermText, $biblio_author_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- biblio_doc table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Bibliography</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(biblio_doc_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="biblio_doc_insert" value="1" <?php echo ($biblio_doc_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_doc_view", $arrPermVal, $arrPermText, $biblio_doc_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_doc_edit", $arrPermVal, $arrPermText, $biblio_doc_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_doc_delete", $arrPermVal, $arrPermText, $biblio_doc_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- biblio_trascript table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Trascripts</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(biblio_trascript_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="biblio_trascript_insert" value="1" <?php echo ($biblio_trascript_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_trascript_view", $arrPermVal, $arrPermText, $biblio_trascript_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_trascript_edit", $arrPermVal, $arrPermText, $biblio_trascript_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_trascript_delete", $arrPermVal, $arrPermText, $biblio_trascript_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- biblio_token table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Token</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(biblio_token_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="biblio_token_insert" value="1" <?php echo ($biblio_token_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_token_view", $arrPermVal, $arrPermText, $biblio_token_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_token_edit", $arrPermVal, $arrPermText, $biblio_token_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("biblio_token_delete", $arrPermVal, $arrPermText, $biblio_token_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- code_invivo table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Invivo</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(code_invivo_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="code_invivo_insert" value="1" <?php echo ($code_invivo_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_invivo_view", $arrPermVal, $arrPermText, $code_invivo_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_invivo_edit", $arrPermVal, $arrPermText, $code_invivo_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_invivo_delete", $arrPermVal, $arrPermText, $code_invivo_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- code_herme table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Hermeneutic</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(code_herme_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="code_herme_insert" value="1" <?php echo ($code_herme_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_herme_view", $arrPermVal, $arrPermText, $code_herme_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_herme_edit", $arrPermVal, $arrPermText, $code_herme_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_herme_delete", $arrPermVal, $arrPermText, $code_herme_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- code_chrev_scenes table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Character scenes</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(code_chrev_scenes_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="code_chrev_scenes_insert" value="1" <?php echo ($code_chrev_scenes_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_chrev_scenes_view", $arrPermVal, $arrPermText, $code_chrev_scenes_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_chrev_scenes_edit", $arrPermVal, $arrPermText, $code_chrev_scenes_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_chrev_scenes_delete", $arrPermVal, $arrPermText, $code_chrev_scenes_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- code_character_development table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Character dev.</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(code_character_development_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="code_character_development_insert" value="1" <?php echo ($code_character_development_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_character_development_view", $arrPermVal, $arrPermText, $code_character_development_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_character_development_edit", $arrPermVal, $arrPermText, $code_character_development_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_character_development_delete", $arrPermVal, $arrPermText, $code_character_development_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- code_encounters table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Encounters</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(code_encounters_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="code_encounters_insert" value="1" <?php echo ($code_encounters_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_encounters_view", $arrPermVal, $arrPermText, $code_encounters_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_encounters_edit", $arrPermVal, $arrPermText, $code_encounters_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_encounters_delete", $arrPermVal, $arrPermText, $code_encounters_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- code_encounter_scenes table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Encounter scenes</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(code_encounter_scenes_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="code_encounter_scenes_insert" value="1" <?php echo ($code_encounter_scenes_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_encounter_scenes_view", $arrPermVal, $arrPermText, $code_encounter_scenes_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_encounter_scenes_edit", $arrPermVal, $arrPermText, $code_encounter_scenes_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("code_encounter_scenes_delete", $arrPermVal, $arrPermText, $code_encounter_scenes_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- story table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Story</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(story_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="story_insert" value="1" <?php echo ($story_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("story_view", $arrPermVal, $arrPermText, $story_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("story_edit", $arrPermVal, $arrPermText, $story_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("story_delete", $arrPermVal, $arrPermText, $story_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- story_characters table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Characters</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(story_characters_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="story_characters_insert" value="1" <?php echo ($story_characters_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("story_characters_view", $arrPermVal, $arrPermText, $story_characters_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("story_characters_edit", $arrPermVal, $arrPermText, $story_characters_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("story_characters_delete", $arrPermVal, $arrPermText, $story_characters_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- storypoints_static table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Storypoints</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(storypoints_static_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="storypoints_static_insert" value="1" <?php echo ($storypoints_static_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storypoints_static_view", $arrPermVal, $arrPermText, $storypoints_static_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storypoints_static_edit", $arrPermVal, $arrPermText, $storypoints_static_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storypoints_static_delete", $arrPermVal, $arrPermText, $storypoints_static_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- storydynamic table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Story dynamics</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(storydynamic_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="storydynamic_insert" value="1" <?php echo ($storydynamic_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storydynamic_view", $arrPermVal, $arrPermText, $storydynamic_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storydynamic_edit", $arrPermVal, $arrPermText, $storydynamic_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storydynamic_delete", $arrPermVal, $arrPermText, $storydynamic_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- storyweaving_scenes table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Storyweaving</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(storyweaving_scenes_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="storyweaving_scenes_insert" value="1" <?php echo ($storyweaving_scenes_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storyweaving_scenes_view", $arrPermVal, $arrPermText, $storyweaving_scenes_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storyweaving_scenes_edit", $arrPermVal, $arrPermText, $storyweaving_scenes_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storyweaving_scenes_delete", $arrPermVal, $arrPermText, $storyweaving_scenes_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- storylines table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Storylines</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(storylines_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="storylines_insert" value="1" <?php echo ($storylines_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storylines_view", $arrPermVal, $arrPermText, $storylines_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storylines_edit", $arrPermVal, $arrPermText, $storylines_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("storylines_delete", $arrPermVal, $arrPermText, $storylines_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- dictionary table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Dictionary</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(dictionary_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="dictionary_insert" value="1" <?php echo ($dictionary_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("dictionary_view", $arrPermVal, $arrPermText, $dictionary_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("dictionary_edit", $arrPermVal, $arrPermText, $dictionary_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("dictionary_delete", $arrPermVal, $arrPermText, $dictionary_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_agent_type1 table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Class agenttype1</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_agent_type1_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_agent_type1_insert" value="1" <?php echo ($class_agent_type1_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_agent_type1_view", $arrPermVal, $arrPermText, $class_agent_type1_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_agent_type1_edit", $arrPermVal, $arrPermText, $class_agent_type1_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_agent_type1_delete", $arrPermVal, $arrPermText, $class_agent_type1_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_agent_type2 table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Class agenttype2</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_agent_type2_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_agent_type2_insert" value="1" <?php echo ($class_agent_type2_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_agent_type2_view", $arrPermVal, $arrPermText, $class_agent_type2_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_agent_type2_edit", $arrPermVal, $arrPermText, $class_agent_type2_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_agent_type2_delete", $arrPermVal, $arrPermText, $class_agent_type2_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_authority_agent table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Person's authority register</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_authority_agent_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_authority_agent_insert" value="1" <?php echo ($class_authority_agent_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_authority_agent_view", $arrPermVal, $arrPermText, $class_authority_agent_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_authority_agent_edit", $arrPermVal, $arrPermText, $class_authority_agent_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_authority_agent_delete", $arrPermVal, $arrPermText, $class_authority_agent_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_authority_library table -->
					<tr>
						<td class="tdCaptionCell" valign="top">class_authority_library</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_authority_library_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_authority_library_insert" value="1" <?php echo ($class_authority_library_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_authority_library_view", $arrPermVal, $arrPermText, $class_authority_library_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_authority_library_edit", $arrPermVal, $arrPermText, $class_authority_library_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_authority_library_delete", $arrPermVal, $arrPermText, $class_authority_library_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_bibliography_genre table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Genre</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_bibliography_genre_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_bibliography_genre_insert" value="1" <?php echo ($class_bibliography_genre_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_bibliography_genre_view", $arrPermVal, $arrPermText, $class_bibliography_genre_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_bibliography_genre_edit", $arrPermVal, $arrPermText, $class_bibliography_genre_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_bibliography_genre_delete", $arrPermVal, $arrPermText, $class_bibliography_genre_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_bibliography_type table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Type</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_bibliography_type_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_bibliography_type_insert" value="1" <?php echo ($class_bibliography_type_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_bibliography_type_view", $arrPermVal, $arrPermText, $class_bibliography_type_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_bibliography_type_edit", $arrPermVal, $arrPermText, $class_bibliography_type_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_bibliography_type_delete", $arrPermVal, $arrPermText, $class_bibliography_type_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_dramatica_archetype table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Archetype</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_dramatica_archetype_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_dramatica_archetype_insert" value="1" <?php echo ($class_dramatica_archetype_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_archetype_view", $arrPermVal, $arrPermText, $class_dramatica_archetype_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_archetype_edit", $arrPermVal, $arrPermText, $class_dramatica_archetype_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_archetype_delete", $arrPermVal, $arrPermText, $class_dramatica_archetype_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_dramatica_domain table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Domain</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_dramatica_domain_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_dramatica_domain_insert" value="1" <?php echo ($class_dramatica_domain_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_domain_view", $arrPermVal, $arrPermText, $class_dramatica_domain_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_domain_edit", $arrPermVal, $arrPermText, $class_dramatica_domain_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_domain_delete", $arrPermVal, $arrPermText, $class_dramatica_domain_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_dramatica_concern table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Concern</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_dramatica_concern_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_dramatica_concern_insert" value="1" <?php echo ($class_dramatica_concern_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_concern_view", $arrPermVal, $arrPermText, $class_dramatica_concern_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_concern_edit", $arrPermVal, $arrPermText, $class_dramatica_concern_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_concern_delete", $arrPermVal, $arrPermText, $class_dramatica_concern_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_dramatica_issue table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Issue</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_dramatica_issue_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_dramatica_issue_insert" value="1" <?php echo ($class_dramatica_issue_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_issue_view", $arrPermVal, $arrPermText, $class_dramatica_issue_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_issue_edit", $arrPermVal, $arrPermText, $class_dramatica_issue_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_issue_delete", $arrPermVal, $arrPermText, $class_dramatica_issue_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_dramatica_themes table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Themes</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_dramatica_themes_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_dramatica_themes_insert" value="1" <?php echo ($class_dramatica_themes_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_themes_view", $arrPermVal, $arrPermText, $class_dramatica_themes_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_themes_edit", $arrPermVal, $arrPermText, $class_dramatica_themes_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_themes_delete", $arrPermVal, $arrPermText, $class_dramatica_themes_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_dramatica_throughline table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Throughline</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_dramatica_throughline_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_dramatica_throughline_insert" value="1" <?php echo ($class_dramatica_throughline_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_throughline_view", $arrPermVal, $arrPermText, $class_dramatica_throughline_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_throughline_edit", $arrPermVal, $arrPermText, $class_dramatica_throughline_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_dramatica_throughline_delete", $arrPermVal, $arrPermText, $class_dramatica_throughline_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_im table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Impression</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_im_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_im_insert" value="1" <?php echo ($class_im_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_im_view", $arrPermVal, $arrPermText, $class_im_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_im_edit", $arrPermVal, $arrPermText, $class_im_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_im_delete", $arrPermVal, $arrPermText, $class_im_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_language table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Language</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_language_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_language_insert" value="1" <?php echo ($class_language_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_language_view", $arrPermVal, $arrPermText, $class_language_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_language_edit", $arrPermVal, $arrPermText, $class_language_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_language_delete", $arrPermVal, $arrPermText, $class_language_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_nt table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Noetic tension</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_nt_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_nt_insert" value="1" <?php echo ($class_nt_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_nt_view", $arrPermVal, $arrPermText, $class_nt_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_nt_edit", $arrPermVal, $arrPermText, $class_nt_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_nt_delete", $arrPermVal, $arrPermText, $class_nt_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_character_element table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Character elements</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_character_element_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_character_element_insert" value="1" <?php echo ($class_character_element_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_character_element_view", $arrPermVal, $arrPermText, $class_character_element_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_character_element_edit", $arrPermVal, $arrPermText, $class_character_element_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_character_element_delete", $arrPermVal, $arrPermText, $class_character_element_delete, "highlight");
							?>
							</td>
						</tr>
				<!-- class_rights table -->
					<tr>
						<td class="tdCaptionCell" valign="top">Class rights</td>
						<td class="tdCell" valign="top">
							<input onMouseOver="stm(class_rights_addTip, toolTipStyle);" onMouseOut="htm();" type="checkbox" name="class_rights_insert" value="1" <?php echo ($class_rights_insert ? "checked class=\"highlight\"" : ""); ?>>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_rights_view", $arrPermVal, $arrPermText, $class_rights_view, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_rights_edit", $arrPermVal, $arrPermText, $class_rights_edit, "highlight");
							?>
							</td>
						<td class="tdCell">
							<?php
								echo htmlRadioGroup("class_rights_delete", $arrPermVal, $arrPermText, $class_rights_delete, "highlight");
							?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		<tr>
			<td colspan="2" align="right" class="tdFormFooter">
				<input type="submit" name="saveChanges" value="Save changes">
				</td>
			</tr>
		</table></div>
</form>

	<script>
		$j(function(){
			var highlight_selections = function(){
				$j('input[type=radio]:checked').next().addClass('text-primary');
				$j('input[type=radio]:not(:checked)').next().removeClass('text-primary');
			}

			$j('input[type=radio]').change(function(){ highlight_selections(); });
			highlight_selections();
		});
	</script>


<?php
	include("$currDir/incFooter.php");
?>