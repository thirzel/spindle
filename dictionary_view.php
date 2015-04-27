<?php
// This script and data application were generated by AppGini 5.31
// Download AppGini for free from http://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/dictionary.php");
	include("$currDir/dictionary_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('dictionary');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "dictionary";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV=array(   
		"`dictionary`.`id`" => "id",
		"`dictionary`.`term`" => "term",
		"`dictionary`.`definition`" => "definition"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`dictionary`.`id`',
		2 => 2,
		3 => 3
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV=array(   
		"`dictionary`.`id`" => "id",
		"`dictionary`.`term`" => "term",
		"`dictionary`.`definition`" => "definition"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters=array(   
		"`dictionary`.`id`" => "id",
		"`dictionary`.`term`" => "term",
		"`dictionary`.`definition`" => "definition"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS=array(   
		"`dictionary`.`id`" => "id",
		"`dictionary`.`term`" => "term",
		"`dictionary`.`definition`" => "definition"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom="`dictionary` ";
	$x->QueryWhere='';
	$x->QueryOrder='';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "dictionary_view.php";
	$x->RedirectAfterInsert = "dictionary_view.php";
	$x->TableTitle = "Dictionary";
	$x->TableIcon = "table.gif";
	$x->PrimaryKey = "`dictionary`.`id`";

	$x->ColWidth   = array(  150, 150, 150);
	$x->ColCaption = array("id", "term", "definition");
	$x->ColFieldName = array('id', 'term', 'definition');
	$x->ColNumber  = array(1, 2, 3);

	$x->Template = 'templates/dictionary_templateTV.html';
	$x->SelectedTemplate = 'templates/dictionary_templateTVS.html';
	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `dictionary`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='dictionary' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `dictionary`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='dictionary' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`dictionary`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: dictionary_init
	$render=TRUE;
	if(function_exists('dictionary_init')){
		$args=array();
		$render=dictionary_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: dictionary_header
	$headerCode='';
	if(function_exists('dictionary_header')){
		$args=array();
		$headerCode=dictionary_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: dictionary_footer
	$footerCode='';
	if(function_exists('dictionary_footer')){
		$args=array();
		$footerCode=dictionary_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>