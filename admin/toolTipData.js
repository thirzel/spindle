var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// biblio_author table
biblio_author_addTip=["",spacer+"This option allows all members of the group to add records to the 'Agents' table. A member who adds a record to the table becomes the 'owner' of that record."];

biblio_author_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Agents' table."];
biblio_author_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Agents' table."];
biblio_author_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Agents' table."];
biblio_author_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Agents' table."];

biblio_author_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Agents' table."];
biblio_author_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Agents' table."];
biblio_author_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Agents' table."];
biblio_author_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Agents' table, regardless of their owner."];

biblio_author_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Agents' table."];
biblio_author_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Agents' table."];
biblio_author_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Agents' table."];
biblio_author_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Agents' table."];

// biblio_doc table
biblio_doc_addTip=["",spacer+"This option allows all members of the group to add records to the 'Bibliography' table. A member who adds a record to the table becomes the 'owner' of that record."];

biblio_doc_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Bibliography' table."];
biblio_doc_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Bibliography' table."];
biblio_doc_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Bibliography' table."];
biblio_doc_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Bibliography' table."];

biblio_doc_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Bibliography' table."];
biblio_doc_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Bibliography' table."];
biblio_doc_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Bibliography' table."];
biblio_doc_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Bibliography' table, regardless of their owner."];

biblio_doc_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Bibliography' table."];
biblio_doc_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Bibliography' table."];
biblio_doc_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Bibliography' table."];
biblio_doc_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Bibliography' table."];

// biblio_trascript table
biblio_trascript_addTip=["",spacer+"This option allows all members of the group to add records to the 'Trascripts' table. A member who adds a record to the table becomes the 'owner' of that record."];

biblio_trascript_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Trascripts' table."];
biblio_trascript_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Trascripts' table."];
biblio_trascript_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Trascripts' table."];
biblio_trascript_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Trascripts' table."];

biblio_trascript_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Trascripts' table."];
biblio_trascript_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Trascripts' table."];
biblio_trascript_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Trascripts' table."];
biblio_trascript_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Trascripts' table, regardless of their owner."];

biblio_trascript_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Trascripts' table."];
biblio_trascript_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Trascripts' table."];
biblio_trascript_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Trascripts' table."];
biblio_trascript_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Trascripts' table."];

// biblio_token table
biblio_token_addTip=["",spacer+"This option allows all members of the group to add records to the 'Token' table. A member who adds a record to the table becomes the 'owner' of that record."];

biblio_token_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Token' table."];
biblio_token_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Token' table."];
biblio_token_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Token' table."];
biblio_token_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Token' table."];

biblio_token_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Token' table."];
biblio_token_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Token' table."];
biblio_token_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Token' table."];
biblio_token_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Token' table, regardless of their owner."];

biblio_token_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Token' table."];
biblio_token_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Token' table."];
biblio_token_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Token' table."];
biblio_token_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Token' table."];

// code_invivo table
code_invivo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Invivo' table. A member who adds a record to the table becomes the 'owner' of that record."];

code_invivo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Invivo' table."];
code_invivo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Invivo' table."];
code_invivo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Invivo' table."];
code_invivo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Invivo' table."];

code_invivo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Invivo' table."];
code_invivo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Invivo' table."];
code_invivo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Invivo' table."];
code_invivo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Invivo' table, regardless of their owner."];

code_invivo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Invivo' table."];
code_invivo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Invivo' table."];
code_invivo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Invivo' table."];
code_invivo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Invivo' table."];

// code_herme table
code_herme_addTip=["",spacer+"This option allows all members of the group to add records to the 'Hermeneutic' table. A member who adds a record to the table becomes the 'owner' of that record."];

code_herme_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Hermeneutic' table."];
code_herme_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Hermeneutic' table."];
code_herme_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Hermeneutic' table."];
code_herme_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Hermeneutic' table."];

code_herme_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Hermeneutic' table."];
code_herme_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Hermeneutic' table."];
code_herme_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Hermeneutic' table."];
code_herme_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Hermeneutic' table, regardless of their owner."];

code_herme_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Hermeneutic' table."];
code_herme_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Hermeneutic' table."];
code_herme_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Hermeneutic' table."];
code_herme_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Hermeneutic' table."];

// code_chrev_scenes table
code_chrev_scenes_addTip=["",spacer+"This option allows all members of the group to add records to the 'Character scenes' table. A member who adds a record to the table becomes the 'owner' of that record."];

code_chrev_scenes_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Character scenes' table."];
code_chrev_scenes_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Character scenes' table."];
code_chrev_scenes_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Character scenes' table."];
code_chrev_scenes_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Character scenes' table."];

code_chrev_scenes_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Character scenes' table."];
code_chrev_scenes_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Character scenes' table."];
code_chrev_scenes_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Character scenes' table."];
code_chrev_scenes_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Character scenes' table, regardless of their owner."];

code_chrev_scenes_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Character scenes' table."];
code_chrev_scenes_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Character scenes' table."];
code_chrev_scenes_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Character scenes' table."];
code_chrev_scenes_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Character scenes' table."];

// code_character_development table
code_character_development_addTip=["",spacer+"This option allows all members of the group to add records to the 'Character dev.' table. A member who adds a record to the table becomes the 'owner' of that record."];

code_character_development_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Character dev.' table."];
code_character_development_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Character dev.' table."];
code_character_development_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Character dev.' table."];
code_character_development_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Character dev.' table."];

code_character_development_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Character dev.' table."];
code_character_development_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Character dev.' table."];
code_character_development_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Character dev.' table."];
code_character_development_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Character dev.' table, regardless of their owner."];

code_character_development_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Character dev.' table."];
code_character_development_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Character dev.' table."];
code_character_development_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Character dev.' table."];
code_character_development_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Character dev.' table."];

// code_encounters table
code_encounters_addTip=["",spacer+"This option allows all members of the group to add records to the 'Encounters' table. A member who adds a record to the table becomes the 'owner' of that record."];

code_encounters_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Encounters' table."];
code_encounters_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Encounters' table."];
code_encounters_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Encounters' table."];
code_encounters_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Encounters' table."];

code_encounters_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Encounters' table."];
code_encounters_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Encounters' table."];
code_encounters_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Encounters' table."];
code_encounters_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Encounters' table, regardless of their owner."];

code_encounters_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Encounters' table."];
code_encounters_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Encounters' table."];
code_encounters_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Encounters' table."];
code_encounters_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Encounters' table."];

// code_encounter_scenes table
code_encounter_scenes_addTip=["",spacer+"This option allows all members of the group to add records to the 'Encounter scenes' table. A member who adds a record to the table becomes the 'owner' of that record."];

code_encounter_scenes_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Encounter scenes' table."];
code_encounter_scenes_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Encounter scenes' table."];
code_encounter_scenes_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Encounter scenes' table."];
code_encounter_scenes_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Encounter scenes' table."];

code_encounter_scenes_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Encounter scenes' table."];
code_encounter_scenes_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Encounter scenes' table."];
code_encounter_scenes_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Encounter scenes' table."];
code_encounter_scenes_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Encounter scenes' table, regardless of their owner."];

code_encounter_scenes_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Encounter scenes' table."];
code_encounter_scenes_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Encounter scenes' table."];
code_encounter_scenes_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Encounter scenes' table."];
code_encounter_scenes_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Encounter scenes' table."];

// story table
story_addTip=["",spacer+"This option allows all members of the group to add records to the 'Story' table. A member who adds a record to the table becomes the 'owner' of that record."];

story_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Story' table."];
story_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Story' table."];
story_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Story' table."];
story_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Story' table."];

story_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Story' table."];
story_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Story' table."];
story_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Story' table."];
story_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Story' table, regardless of their owner."];

story_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Story' table."];
story_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Story' table."];
story_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Story' table."];
story_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Story' table."];

// story_characters table
story_characters_addTip=["",spacer+"This option allows all members of the group to add records to the 'Characters' table. A member who adds a record to the table becomes the 'owner' of that record."];

story_characters_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Characters' table."];
story_characters_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Characters' table."];
story_characters_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Characters' table."];
story_characters_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Characters' table."];

story_characters_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Characters' table."];
story_characters_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Characters' table."];
story_characters_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Characters' table."];
story_characters_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Characters' table, regardless of their owner."];

story_characters_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Characters' table."];
story_characters_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Characters' table."];
story_characters_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Characters' table."];
story_characters_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Characters' table."];

// storypoints_static table
storypoints_static_addTip=["",spacer+"This option allows all members of the group to add records to the 'Storypoints' table. A member who adds a record to the table becomes the 'owner' of that record."];

storypoints_static_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Storypoints' table."];
storypoints_static_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Storypoints' table."];
storypoints_static_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Storypoints' table."];
storypoints_static_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Storypoints' table."];

storypoints_static_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Storypoints' table."];
storypoints_static_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Storypoints' table."];
storypoints_static_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Storypoints' table."];
storypoints_static_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Storypoints' table, regardless of their owner."];

storypoints_static_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Storypoints' table."];
storypoints_static_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Storypoints' table."];
storypoints_static_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Storypoints' table."];
storypoints_static_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Storypoints' table."];

// storydynamic table
storydynamic_addTip=["",spacer+"This option allows all members of the group to add records to the 'Story dynamics' table. A member who adds a record to the table becomes the 'owner' of that record."];

storydynamic_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Story dynamics' table."];
storydynamic_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Story dynamics' table."];
storydynamic_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Story dynamics' table."];
storydynamic_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Story dynamics' table."];

storydynamic_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Story dynamics' table."];
storydynamic_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Story dynamics' table."];
storydynamic_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Story dynamics' table."];
storydynamic_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Story dynamics' table, regardless of their owner."];

storydynamic_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Story dynamics' table."];
storydynamic_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Story dynamics' table."];
storydynamic_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Story dynamics' table."];
storydynamic_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Story dynamics' table."];

// storyweaving_scenes table
storyweaving_scenes_addTip=["",spacer+"This option allows all members of the group to add records to the 'Storyweaving' table. A member who adds a record to the table becomes the 'owner' of that record."];

storyweaving_scenes_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Storyweaving' table."];
storyweaving_scenes_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Storyweaving' table."];
storyweaving_scenes_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Storyweaving' table."];
storyweaving_scenes_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Storyweaving' table."];

storyweaving_scenes_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Storyweaving' table."];
storyweaving_scenes_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Storyweaving' table."];
storyweaving_scenes_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Storyweaving' table."];
storyweaving_scenes_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Storyweaving' table, regardless of their owner."];

storyweaving_scenes_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Storyweaving' table."];
storyweaving_scenes_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Storyweaving' table."];
storyweaving_scenes_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Storyweaving' table."];
storyweaving_scenes_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Storyweaving' table."];

// storylines table
storylines_addTip=["",spacer+"This option allows all members of the group to add records to the 'Storylines' table. A member who adds a record to the table becomes the 'owner' of that record."];

storylines_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Storylines' table."];
storylines_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Storylines' table."];
storylines_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Storylines' table."];
storylines_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Storylines' table."];

storylines_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Storylines' table."];
storylines_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Storylines' table."];
storylines_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Storylines' table."];
storylines_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Storylines' table, regardless of their owner."];

storylines_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Storylines' table."];
storylines_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Storylines' table."];
storylines_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Storylines' table."];
storylines_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Storylines' table."];

// dictionary table
dictionary_addTip=["",spacer+"This option allows all members of the group to add records to the 'Dictionary' table. A member who adds a record to the table becomes the 'owner' of that record."];

dictionary_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Dictionary' table."];
dictionary_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Dictionary' table."];
dictionary_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Dictionary' table."];
dictionary_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Dictionary' table."];

dictionary_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Dictionary' table."];
dictionary_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Dictionary' table."];
dictionary_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Dictionary' table."];
dictionary_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Dictionary' table, regardless of their owner."];

dictionary_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Dictionary' table."];
dictionary_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Dictionary' table."];
dictionary_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Dictionary' table."];
dictionary_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Dictionary' table."];

// class_agent_type1 table
class_agent_type1_addTip=["",spacer+"This option allows all members of the group to add records to the 'Class agenttype1' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_agent_type1_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Class agenttype1' table."];
class_agent_type1_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Class agenttype1' table."];
class_agent_type1_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Class agenttype1' table."];
class_agent_type1_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Class agenttype1' table."];

class_agent_type1_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Class agenttype1' table."];
class_agent_type1_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Class agenttype1' table."];
class_agent_type1_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Class agenttype1' table."];
class_agent_type1_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Class agenttype1' table, regardless of their owner."];

class_agent_type1_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Class agenttype1' table."];
class_agent_type1_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Class agenttype1' table."];
class_agent_type1_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Class agenttype1' table."];
class_agent_type1_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Class agenttype1' table."];

// class_agent_type2 table
class_agent_type2_addTip=["",spacer+"This option allows all members of the group to add records to the 'Class agenttype2' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_agent_type2_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Class agenttype2' table."];
class_agent_type2_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Class agenttype2' table."];
class_agent_type2_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Class agenttype2' table."];
class_agent_type2_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Class agenttype2' table."];

class_agent_type2_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Class agenttype2' table."];
class_agent_type2_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Class agenttype2' table."];
class_agent_type2_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Class agenttype2' table."];
class_agent_type2_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Class agenttype2' table, regardless of their owner."];

class_agent_type2_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Class agenttype2' table."];
class_agent_type2_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Class agenttype2' table."];
class_agent_type2_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Class agenttype2' table."];
class_agent_type2_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Class agenttype2' table."];

// class_authority_agent table
class_authority_agent_addTip=["",spacer+"This option allows all members of the group to add records to the 'Person's authority register' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_authority_agent_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Person's authority register' table."];
class_authority_agent_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Person's authority register' table."];
class_authority_agent_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Person's authority register' table."];
class_authority_agent_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Person's authority register' table."];

class_authority_agent_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Person's authority register' table."];
class_authority_agent_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Person's authority register' table."];
class_authority_agent_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Person's authority register' table."];
class_authority_agent_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Person's authority register' table, regardless of their owner."];

class_authority_agent_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Person's authority register' table."];
class_authority_agent_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Person's authority register' table."];
class_authority_agent_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Person's authority register' table."];
class_authority_agent_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Person's authority register' table."];

// class_authority_library table
class_authority_library_addTip=["",spacer+"This option allows all members of the group to add records to the 'class_authority_library' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_authority_library_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'class_authority_library' table."];
class_authority_library_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'class_authority_library' table."];
class_authority_library_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'class_authority_library' table."];
class_authority_library_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'class_authority_library' table."];

class_authority_library_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'class_authority_library' table."];
class_authority_library_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'class_authority_library' table."];
class_authority_library_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'class_authority_library' table."];
class_authority_library_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'class_authority_library' table, regardless of their owner."];

class_authority_library_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'class_authority_library' table."];
class_authority_library_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'class_authority_library' table."];
class_authority_library_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'class_authority_library' table."];
class_authority_library_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'class_authority_library' table."];

// class_bibliography_genre table
class_bibliography_genre_addTip=["",spacer+"This option allows all members of the group to add records to the 'Genre' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_bibliography_genre_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Genre' table."];
class_bibliography_genre_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Genre' table."];
class_bibliography_genre_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Genre' table."];
class_bibliography_genre_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Genre' table."];

class_bibliography_genre_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Genre' table."];
class_bibliography_genre_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Genre' table."];
class_bibliography_genre_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Genre' table."];
class_bibliography_genre_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Genre' table, regardless of their owner."];

class_bibliography_genre_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Genre' table."];
class_bibliography_genre_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Genre' table."];
class_bibliography_genre_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Genre' table."];
class_bibliography_genre_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Genre' table."];

// class_bibliography_type table
class_bibliography_type_addTip=["",spacer+"This option allows all members of the group to add records to the 'Type' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_bibliography_type_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Type' table."];
class_bibliography_type_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Type' table."];
class_bibliography_type_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Type' table."];
class_bibliography_type_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Type' table."];

class_bibliography_type_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Type' table."];
class_bibliography_type_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Type' table."];
class_bibliography_type_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Type' table."];
class_bibliography_type_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Type' table, regardless of their owner."];

class_bibliography_type_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Type' table."];
class_bibliography_type_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Type' table."];
class_bibliography_type_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Type' table."];
class_bibliography_type_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Type' table."];

// class_dramatica_archetype table
class_dramatica_archetype_addTip=["",spacer+"This option allows all members of the group to add records to the 'Archetype' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_dramatica_archetype_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Archetype' table."];
class_dramatica_archetype_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Archetype' table."];
class_dramatica_archetype_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Archetype' table."];
class_dramatica_archetype_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Archetype' table."];

class_dramatica_archetype_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Archetype' table."];
class_dramatica_archetype_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Archetype' table."];
class_dramatica_archetype_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Archetype' table."];
class_dramatica_archetype_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Archetype' table, regardless of their owner."];

class_dramatica_archetype_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Archetype' table."];
class_dramatica_archetype_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Archetype' table."];
class_dramatica_archetype_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Archetype' table."];
class_dramatica_archetype_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Archetype' table."];

// class_dramatica_domain table
class_dramatica_domain_addTip=["",spacer+"This option allows all members of the group to add records to the 'Domain' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_dramatica_domain_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Domain' table."];
class_dramatica_domain_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Domain' table."];
class_dramatica_domain_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Domain' table."];
class_dramatica_domain_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Domain' table."];

class_dramatica_domain_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Domain' table."];
class_dramatica_domain_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Domain' table."];
class_dramatica_domain_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Domain' table."];
class_dramatica_domain_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Domain' table, regardless of their owner."];

class_dramatica_domain_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Domain' table."];
class_dramatica_domain_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Domain' table."];
class_dramatica_domain_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Domain' table."];
class_dramatica_domain_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Domain' table."];

// class_dramatica_concern table
class_dramatica_concern_addTip=["",spacer+"This option allows all members of the group to add records to the 'Concern' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_dramatica_concern_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Concern' table."];
class_dramatica_concern_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Concern' table."];
class_dramatica_concern_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Concern' table."];
class_dramatica_concern_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Concern' table."];

class_dramatica_concern_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Concern' table."];
class_dramatica_concern_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Concern' table."];
class_dramatica_concern_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Concern' table."];
class_dramatica_concern_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Concern' table, regardless of their owner."];

class_dramatica_concern_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Concern' table."];
class_dramatica_concern_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Concern' table."];
class_dramatica_concern_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Concern' table."];
class_dramatica_concern_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Concern' table."];

// class_dramatica_issue table
class_dramatica_issue_addTip=["",spacer+"This option allows all members of the group to add records to the 'Issue' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_dramatica_issue_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Issue' table."];
class_dramatica_issue_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Issue' table."];
class_dramatica_issue_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Issue' table."];
class_dramatica_issue_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Issue' table."];

class_dramatica_issue_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Issue' table."];
class_dramatica_issue_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Issue' table."];
class_dramatica_issue_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Issue' table."];
class_dramatica_issue_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Issue' table, regardless of their owner."];

class_dramatica_issue_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Issue' table."];
class_dramatica_issue_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Issue' table."];
class_dramatica_issue_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Issue' table."];
class_dramatica_issue_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Issue' table."];

// class_dramatica_themes table
class_dramatica_themes_addTip=["",spacer+"This option allows all members of the group to add records to the 'Themes' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_dramatica_themes_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Themes' table."];
class_dramatica_themes_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Themes' table."];
class_dramatica_themes_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Themes' table."];
class_dramatica_themes_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Themes' table."];

class_dramatica_themes_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Themes' table."];
class_dramatica_themes_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Themes' table."];
class_dramatica_themes_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Themes' table."];
class_dramatica_themes_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Themes' table, regardless of their owner."];

class_dramatica_themes_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Themes' table."];
class_dramatica_themes_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Themes' table."];
class_dramatica_themes_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Themes' table."];
class_dramatica_themes_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Themes' table."];

// class_dramatica_throughline table
class_dramatica_throughline_addTip=["",spacer+"This option allows all members of the group to add records to the 'Throughline' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_dramatica_throughline_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Throughline' table."];
class_dramatica_throughline_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Throughline' table."];
class_dramatica_throughline_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Throughline' table."];
class_dramatica_throughline_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Throughline' table."];

class_dramatica_throughline_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Throughline' table."];
class_dramatica_throughline_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Throughline' table."];
class_dramatica_throughline_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Throughline' table."];
class_dramatica_throughline_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Throughline' table, regardless of their owner."];

class_dramatica_throughline_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Throughline' table."];
class_dramatica_throughline_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Throughline' table."];
class_dramatica_throughline_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Throughline' table."];
class_dramatica_throughline_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Throughline' table."];

// class_im table
class_im_addTip=["",spacer+"This option allows all members of the group to add records to the 'Impression' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_im_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Impression' table."];
class_im_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Impression' table."];
class_im_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Impression' table."];
class_im_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Impression' table."];

class_im_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Impression' table."];
class_im_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Impression' table."];
class_im_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Impression' table."];
class_im_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Impression' table, regardless of their owner."];

class_im_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Impression' table."];
class_im_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Impression' table."];
class_im_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Impression' table."];
class_im_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Impression' table."];

// class_language table
class_language_addTip=["",spacer+"This option allows all members of the group to add records to the 'Language' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_language_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Language' table."];
class_language_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Language' table."];
class_language_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Language' table."];
class_language_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Language' table."];

class_language_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Language' table."];
class_language_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Language' table."];
class_language_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Language' table."];
class_language_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Language' table, regardless of their owner."];

class_language_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Language' table."];
class_language_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Language' table."];
class_language_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Language' table."];
class_language_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Language' table."];

// class_nt table
class_nt_addTip=["",spacer+"This option allows all members of the group to add records to the 'Noetic tension' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_nt_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Noetic tension' table."];
class_nt_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Noetic tension' table."];
class_nt_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Noetic tension' table."];
class_nt_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Noetic tension' table."];

class_nt_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Noetic tension' table."];
class_nt_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Noetic tension' table."];
class_nt_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Noetic tension' table."];
class_nt_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Noetic tension' table, regardless of their owner."];

class_nt_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Noetic tension' table."];
class_nt_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Noetic tension' table."];
class_nt_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Noetic tension' table."];
class_nt_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Noetic tension' table."];

// class_character_element table
class_character_element_addTip=["",spacer+"This option allows all members of the group to add records to the 'Character elements' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_character_element_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Character elements' table."];
class_character_element_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Character elements' table."];
class_character_element_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Character elements' table."];
class_character_element_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Character elements' table."];

class_character_element_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Character elements' table."];
class_character_element_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Character elements' table."];
class_character_element_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Character elements' table."];
class_character_element_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Character elements' table, regardless of their owner."];

class_character_element_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Character elements' table."];
class_character_element_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Character elements' table."];
class_character_element_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Character elements' table."];
class_character_element_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Character elements' table."];

// class_rights table
class_rights_addTip=["",spacer+"This option allows all members of the group to add records to the 'Class rights' table. A member who adds a record to the table becomes the 'owner' of that record."];

class_rights_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Class rights' table."];
class_rights_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Class rights' table."];
class_rights_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Class rights' table."];
class_rights_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Class rights' table."];

class_rights_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Class rights' table."];
class_rights_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Class rights' table."];
class_rights_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Class rights' table."];
class_rights_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Class rights' table, regardless of their owner."];

class_rights_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Class rights' table."];
class_rights_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Class rights' table."];
class_rights_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Class rights' table."];
class_rights_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Class rights' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
