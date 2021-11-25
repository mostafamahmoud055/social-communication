<?php
ob_start();	
session_start();

if(isset($_REQUEST['delete'])){
	foreach($_REQUEST['file'] as $file){
		if(isset($file)){
			if(unlink($file)){
				$_SESSION['message']= "<h3 class='green'>File deleted successfuly</h3>";
				header('Location:.index.php');
				}else{
				$_SESSION['message']= "<h3 class='red'>Can Not Delete File</h3>";	
					}
			}
		}
	
	}
	
//----------rename------------------------
if(isset($_GET['rename'])){
	$newname=$_GET['newname'];
	$name=$_GET['file'];
	$newname=array_filter($newname);
	$diff=count($name)-count($newname);
	if ($diff==0){	
		$n=0;
		$new_file_name=array();
		foreach($newname as $value){
			$new_file_name[$n]=$value;
			$n++;
		}
		for ($i=0;$i<count($name);$i++){
			rename($name[$i],$new_file_name[$i]);
			}
	$_SESSION['message']="<h3 class='green'>Files renamed Successfully</h3>";}//processing
	else{$_SESSION['message']="<h3 class='red'>Data Miss Match</h3>";}
header('Location:.index.php');
}//end rename process
	
?>