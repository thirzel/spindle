<?php
	$currDir=dirname(__FILE__);
	require("$currDir/incCommon.php");
	include("$currDir/incHeader.php");

	// process search
	$memberID=makeSafe(strtolower($_GET['memberID']));
	$groupID=intval($_GET['groupID']);
	$tableName=makeSafe($_GET['tableName']);

	// process sort
	$sortDir=($_GET['sortDir'] ? 'desc' : '');
	$sort=makeSafe($_GET['sort']);
	if($sort!='dateAdded' && $sort!='dateUpdated'){ // default sort is newly created first
		$sort='dateAdded';
		$sortDir='desc';
	}

	if($sort){
		$sortClause="order by $sort $sortDir";
	}

	if($memberID!=''){
		$where.=($where ? " and " : "")."r.memberID like '$memberID%'";
	}

	if($groupID!=''){
		$where.=($where ? " and " : "")."g.groupID='$groupID'";
	}

	if($tableName!=''){
		$where.=($where ? " and " : "")."r.tableName='$tableName'";
	}

	if($where){
		$where="where $where";
	}

	$numRecords=sqlValue("select count(1) from membership_userrecords r left join membership_groups g on r.groupID=g.groupID $where");
	if(!$numRecords){
		echo "<div class=\"status\">No matching results found.</div>";
		$noResults=TRUE;
		$page=1;
	}else{
		$noResults=FALSE;
	}

	$page=intval($_GET['page']);
	if($page<1){
		$page=1;
	}elseif($page>ceil($numRecords/$adminConfig['recordsPerPage']) && !$noResults){
		redirect("admin/pageViewRecords.php?page=".ceil($numRecords/$adminConfig['recordsPerPage']));
	}

	$start=($page-1)*$adminConfig['recordsPerPage'];

?>
<div class="page-header"><h1>Data Records</h1></div>

<table class="table table-striped">
	<tr>
		<td colspan="7" align="center">
			<form method="get" action="pageViewRecords.php">
				<table class="table">
					<tr>
						<td align="center">
							Group
							<?php
								echo htmlSQLSelect("groupID", "select groupID, name from membership_groups order by name", $groupID);
							?>
							&nbsp; &nbsp; &nbsp; 
							Member username
							<input class="formTextBox" type="text" name="memberID" value="<?php echo $memberID; ?>" size="20">
							<input type="hidden" name="page" value="1">
							</td>
						<td valign="bottom" rowspan="3">
							<input type="submit" value="Find">
							<input type="button" value="Reset" onClick="window.location='pageViewRecords.php';">
							</td>
						</tr>
					<tr>
						<td align="center">
							Show records from
							<?php
								$arrFields=array('', 'biblio_author', 'biblio_doc', 'biblio_trascript', 'biblio_token', 'code_invivo', 'code_herme', 'code_chrev_scenes', 'code_character_development', 'code_encounters', 'code_encounter_scenes', 'story', 'story_characters', 'storypoints_static', 'storydynamic', 'storyweaving_scenes', 'storylines', 'dictionary', 'class_agent_type1', 'class_agent_type2', 'class_authority_agent', 'class_authority_library', 'class_bibliography_genre', 'class_bibliography_type', 'class_dramatica_archetype', 'class_dramatica_domain', 'class_dramatica_concern', 'class_dramatica_issue', 'class_dramatica_themes', 'class_dramatica_throughline', 'class_im', 'class_language', 'class_nt', 'class_character_element', 'class_rights');
								$arrFieldCaptions=array('All tables', 'Agents', 'Bibliography', 'Trascripts', 'Token', 'Invivo', 'Hermeneutic', 'Character scenes', 'Character dev.', 'Encounters', 'Encounter scenes', 'Story', 'Characters', 'Storypoints', 'Story dynamics', 'Storyweaving', 'Storylines', 'Dictionary', 'Class agenttype1', 'Class agenttype2', 'Person\'s authority register', 'class_authority_library', 'Genre', 'Type', 'Archetype', 'Domain', 'Concern', 'Issue', 'Themes', 'Throughline', 'Impression', 'Language', 'Noetic tension', 'Character elements', 'Class rights');
								echo htmlSelect('tableName', $arrFields, $arrFieldCaptions, $tableName);
							?>
							</td>
						</tr>
					<tr>
						<td align="center">
							Sort records by
							<?php
								$arrFields=array('dateAdded', 'dateUpdated');
								$arrFieldCaptions=array('Date created', 'Date modified');
								echo htmlSelect('sort', $arrFields, $arrFieldCaptions, $sort);

								$arrFields=array('desc', '');
								$arrFieldCaptions=array('Newer first', 'Older first');
								echo htmlSelect('sortDir', $arrFields, $arrFieldCaptions, $sortDir);
							?>
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	<tr>
		<td class="tdHeader">&nbsp;</td>
		<td class="tdHeader"><div class="ColCaption">Username</div></td>
		<td class="tdHeader"><div class="ColCaption">Group</div></td>
		<td class="tdHeader"><div class="ColCaption">Table</div></td>
		<td class="tdHeader"><div class="ColCaption">Created</div></td>
		<td class="tdHeader"><div class="ColCaption">Modified</div></td>
		<td class="tdHeader"><div class="ColCaption">Data</div></td>
		</tr>
<?php

	$res=sql("select r.recID, r.memberID, g.name, r.tableName, r.dateAdded, r.dateUpdated, r.pkValue from membership_userrecords r left join membership_groups g on r.groupID=g.groupID $where $sortClause limit $start, ".$adminConfig['recordsPerPage'], $eo);
	while($row=db_fetch_row($res)){
		?>
		<tr>
			<td class="tdCaptionCell" align="left">
				<a href="pageEditOwnership.php?recID=<?php echo $row[0]; ?>"><img border="0" src="images/edit_icon.gif" alt="Change ownership of this record" title="Change ownership of this record"></a>
				<a href="pageDeleteRecord.php?recID=<?php echo $row[0]; ?>" onClick="return confirm('Are you sure you want to delete this record?');"><img border="0" src="images/delete_icon.gif" alt="Delete this record" title="Delete this record"></a>
				</td>
			<td class="tdCell" align="left"><?php echo $row[1]; ?></td>
			<td class="tdCell" align="left"><?php echo $row[2]; ?></td>
			<td class="tdCell" align="left"><?php echo $row[3]; ?></td>
			<td class="tdCell" align="left" <?php echo ($sort=='dateAdded' ? "style=\"background-color: #FFFFE0;\"" : "");?>><?php echo @date($adminConfig['PHPDateTimeFormat'], $row[4]); ?></td>
			<td class="tdCell" align="left" <?php echo ($sort=='dateUpdated' ? "style=\"background-color: #FFFFE0;\"" : "");?>><?php echo @date($adminConfig['PHPDateTimeFormat'], $row[5]); ?></td>
			<td class="tdCell" align="left"><?php echo substr(getCSVData($row[3], $row[6]), 0, 40)." ... "; ?></td>
			</tr>
		<?php
	}
	?>
	<tr>
		<td colspan="7">
			<table width="100%" cellspacing="0">
				<tr>
				<td align="left" class="tdFooter">
					<input type="button" onClick="window.location='pageViewRecords.php?groupID=<?php echo $groupID; ?>&memberID=<?php echo $memberID; ?>&tableName=<?php echo $tableName; ?>&page=<?php echo ($page>1 ? $page-1 : 1); ?>&sort=<?php echo $sort; ?>&sortDir=<?php echo $sortDir; ?>';" value="Previous">
					</td>
				<td align="center" class="tdFooter">
					<?php echo "Displaying records ".($start+1)." to ".($start+db_num_rows($res))." of $numRecords"; ?>
					</td>
				<td align="right" class="tdFooter">
					<input type="button" onClick="window.location='pageViewRecords.php?groupID=<?php echo $groupID; ?>&memberID=<?php echo $memberID; ?>&tableName=<?php echo $tableName; ?>&page=<?php echo ($page<ceil($numRecords/$adminConfig['recordsPerPage']) ? $page+1 : ceil($numRecords/$adminConfig['recordsPerPage'])); ?>&sort=<?php echo $sort; ?>&sortDir=<?php echo $sortDir; ?>';" value="Next">
					</td>
			</tr><table></td>
		</tr>
	</table>

<?php
	include("$currDir/incFooter.php");
?>