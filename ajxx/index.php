<?php session_start();?>
<!doctype html>
<html>

<head>
<title>Pami App</title>
<link href="style.css" rel="stylesheet" media="all" type="text/css">
<style>
body { background-color:#292929 !important;}
</style>
</head>
<body background="#292929">
<?php

if($_SESSION['id']=='google'){
	//$message= "<h1 style=' padding:20px; margine :0 auto;color:red'>Welcome ".$_SESSION['username']."</h1>";
	$_SESSION['id']='logged';
	
	}elseif
	($_SESSION['id']='logged'){
		//$message="<h1 style=' padding:20px; margine :0 auto;color:red'>Welcome ".$_SESSION['username']."</h1>";

    
	
	?>
	<?php
	if($_GET['reset_btn']){echo "Session destroy"; session_destroy();}
  unset($_SESSION['token']);
  $_SESSION['token']='';
  


exit();
}
	
    
	
	if($_SESSION['token']==''){?>
	<?php }else{echo $message;}
?><iframe src="menu/menu.html" width="100%" height="800px" scrolling="no"></iframe>

</body>
</html>