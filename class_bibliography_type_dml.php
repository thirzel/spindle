<?php

// Data functions for table class_bibliography_type

// This script and data application were generated by AppGini 5.31
// Download AppGini for free from http://bigprof.com/appgini/download/

function class_bibliography_type_insert(){
	global $Translation;

	if($_GET['insert_x']!=''){$_POST=$_GET;}

	// mm: can member insert record?
	$arrPerm=getTablePermissions('class_bibliography_type');
	if(!$arrPerm[1]){
		return false;
	}

	$data['type'] = makeSafe($_POST['type']);
		if($data['type'] == empty_lookup_value){ $data['type'] = ''; }

	// hook: class_bibliography_type_before_insert
	if(function_exists('class_bibliography_type_before_insert')){
		$args=array();
		if(!class_bibliography_type_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('insert into `class_bibliography_type` set       `type`=' . (($data['type'] !== '' && $data['type'] !== NULL) ? "'{$data['type']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"class_bibliography_type_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID=db_insert_id(db_link());

	// hook: class_bibliography_type_after_insert
	if(function_exists('class_bibliography_type_after_insert')){
		$res = sql("select * from `class_bibliography_type` where `id`='" . makeSafe($recID) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID);
		$args=array();
		if(!class_bibliography_type_after_insert($data, getMemberInfo(), $args)){ return (get_magic_quotes_gpc() ? stripslashes($recID) : $recID); }
	}

	// mm: save ownership data
	sql("insert into membership_userrecords set tableName='class_bibliography_type', pkValue='$recID', memberID='".getLoggedMemberID()."', dateAdded='".time()."', dateUpdated='".time()."', groupID='".getLoggedGroupID()."'", $eo);

	return (get_magic_quotes_gpc() ? stripslashes($recID) : $recID);
}

function class_bibliography_type_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('class_bibliography_type');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='class_bibliography_type' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='class_bibliography_type' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: class_bibliography_type_before_delete
	if(function_exists('class_bibliography_type_before_delete')){
		$args=array();
		if(!class_bibliography_type_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	// child table: biblio_doc
	$res = sql("select `id` from `class_bibliography_type` where `id`='$selected_id'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("select count(1) from `biblio_doc` where `type`='".addslashes($id[0])."'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "biblio_doc", $RetMsg);
		return $RetMsg;
	}elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["confirm delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "biblio_doc", $RetMsg);
		$RetMsg = str_replace("<Delete>", "<input type=\"button\" class=\"button\" value=\"".$Translation['yes']."\" onClick=\"window.location='class_bibliography_type_view.php?SelectedID=".urlencode($selected_id)."&delete_x=1&confirmed=1';\">", $RetMsg);
		$RetMsg = str_replace("<Cancel>", "<input type=\"button\" class=\"button\" value=\"".$Translation['no']."\" onClick=\"window.location='class_bibliography_type_view.php?SelectedID=".urlencode($selected_id)."';\">", $RetMsg);
		return $RetMsg;
	}

	sql("delete from `class_bibliography_type` where `id`='$selected_id'", $eo);

	// hook: class_bibliography_type_after_delete
	if(function_exists('class_bibliography_type_after_delete')){
		$args=array();
		class_bibliography_type_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='class_bibliography_type' and pkValue='$selected_id'", $eo);
}

function class_bibliography_type_update($selected_id){
	global $Translation;

	if($_GET['update_x']!=''){$_POST=$_GET;}

	// mm: can member edit record?
	$arrPerm=getTablePermissions('class_bibliography_type');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='class_bibliography_type' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='class_bibliography_type' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['type'] = makeSafe($_POST['type']);
		if($data['type'] == empty_lookup_value){ $data['type'] = ''; }
	$data['selectedID']=makeSafe($selected_id);

	// hook: class_bibliography_type_before_update
	if(function_exists('class_bibliography_type_before_update')){
		$args=array();
		if(!class_bibliography_type_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `class_bibliography_type` set       `type`=' . (($data['type'] !== '' && $data['type'] !== NULL) ? "'{$data['type']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="class_bibliography_type_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: class_bibliography_type_after_update
	if(function_exists('class_bibliography_type_after_update')){
		$res = sql("SELECT * FROM `class_bibliography_type` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!class_bibliography_type_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='class_bibliography_type' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function class_bibliography_type_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('class_bibliography_type');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}


	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='class_bibliography_type' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='class_bibliography_type' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `class_bibliography_type` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found']);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
	}else{
	}

	ob_start();
	?>

	<script>
		// initial lookup values

		jQuery(function() {
		});
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$templateCode = @file_get_contents('./templates/class_bibliography_type_templateDVP.html');
	}else{
		$templateCode = @file_get_contents('./templates/class_bibliography_type_templateDV.html');
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Detail View', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return class_bibliography_type_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return class_bibliography_type_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode=str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'window.parent.jQuery(\'.modal\').modal(\'hide\'); return false;';
	}else{
		$backAction = '$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode=str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate){
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return class_bibliography_type_validateData();"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode=str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode=str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode=str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode=str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode=str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode=str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#type').replaceWith('<p class=\"form-control-static\" id=\"type\">' + (jQuery('#type').val() || '') + '</p>');\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos

	// process foreign key links
	if($selected_id){
	}

	// process images
	$templateCode=str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode=str_replace('<%%UPLOADFILE(type)%%>', '', $templateCode);

	// process values
	if($selected_id){
		$templateCode=str_replace('<%%VALUE(id)%%>', htmlspecialchars($row['id'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		$templateCode=str_replace('<%%VALUE(type)%%>', htmlspecialchars($row['type'], ENT_QUOTES), $templateCode);
		$templateCode=str_replace('<%%URLVALUE(type)%%>', urlencode($urow['type']), $templateCode);
	}else{
		$templateCode=str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode=str_replace('<%%VALUE(type)%%>', '', $templateCode);
		$templateCode=str_replace('<%%URLVALUE(type)%%>', urlencode(''), $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode=str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode=str_replace('<%%', '<!-- ', $templateCode);
	$templateCode=str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_POST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('[id^=\"{$name}_plink\"]').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode=preg_replace('/blank.gif" rel="lightbox\[.*?\]"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	// hook: class_bibliography_type_dv
	if(function_exists('class_bibliography_type_dv')){
		$args=array();
		class_bibliography_type_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>