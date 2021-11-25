<?php
function connect(){
	$host='localhost';
	$username='root';
	$password='';
	$database='pami';
	$con=mysqli_connect($host,$username,$password,$database);
	if($con){
		//echo "Successfully Connected";
		return $con;
	}else{
		echo "Error Number: ".mysqli_connect_errno();
	}
}
//-------------------------------------------------------head function-----------------------------------------
function head(){
?>
	<!DOCTYPE html >
		<html>
		<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Pami | <?php echo ucfirst(ltrim(rtrim($_SERVER['PHP_SELF'],'.php'),'/'))?></title>
    <!--the following conditional comment is telling the browser that the enclosed markup should only appear to users viewing the page with Internet Explorer prior to version 9:   
HTML5 includes a number of new elements, such as article and section...!
Version 9, IE prevented unrecognized elements from receiving styling. These mystery elements were seen by the rendering engine as “unknown elements,” so you were unable to change the way they looked or behaved. This includes not only our imagined elements, but also any elements that had yet to be defined at the time those browser versions were developed. That means (you guessed it) the new HTML5 elements.--> 
<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<style>

*{ 
	margin:0; 
	padding:0}
nav { 
	box-shadow:0px 3px 1px #ccc;
	border-bottom:3px solid #FF0;
	background:#111; 
	font-size:1em;}
nav ul{
	padding: 0px 10px 12px}
/*The padding and margin properties specify top right bottom left.
If left is omitted, it will default to right.
Thus, padding: a b c is equivalent to padding: a b c b*/
nav ul li{ 
	display:inline;  
	padding:10px;}
nav ul li a{ 
	text-shadow:1px 1px 1px #900;
	position:relative; 
	text-decoration:none; 
	color:#FF0;
	top:-13px }
nav ul li a:hover{  
	color:#F7F; 
	border-radius:20px;}
nav ul li a:active{ 
	text-shadow:1px 10px 1px #FF0;}
.avatar { 
	cursor:pointer; 
	border:2px solid #FF0 ; 
	border-radius:30px; 
	box-shadow:1px 1px 1px #000 ; 
	float:left !important; }
nav ul li a::after { 
	content: "|"; 
	color:#FF0 !important
}
#key{ 
	display:none}
#menu{display:block}
	


@media only screen and (max-width: 815px) {
	nav { 
		box-shadow:0px 1px 1px #ccc; 
		border-bottom:3px solid #FF0; 
		background:#111; 
		font-size:0.85em;}
}
@media only screen and (min-width: 650px) {	
	#menu{display:block !important}
		}	


@media only screen and (max-width: 650px) {
	nav ul li a {
		display:block;
		border-bottom:1px solid #FF0;}
	.avatar {
		float:none !important}
	nav ul li{  
		padding:0 5px;}
	#key{
		margin:0 auto; 
		font-size:30px; 
		margin:-10px; 
		font-weight:bolder; 
		color:#FF0; 
		display:block}
	nav ul li a:active{ 
		text-shadow:100px 1px 1px #FF0; 
		color:#FF0;top:-13px }	
	nav ul li a::after { 
		content: ""
	}
	.avatar p img{ 
		text-align:center}
	#menu{ 
		display:none}
		}
</style>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#key").click(function(){
        $("#menu").toggle(500);
    });
    
});
</script>
</head>

<body>
<?php

if(isset($_COOKIE['id'])){
	$con=connect();
	$id=$_COOKIE['id'];
	$sql="SELECT `id`,`ext` FROM `users` WHERE `id`='$id'";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$pic_name=$row['id'];
		$pic_ext=$row['ext'];
		$pic='users-pic/'.$pic_name.".".$pic_ext;	
	}//end while		
}//end validation block
else{
	echo "Protected Contents you have to sign in first";
	echo "<a href='signin.php' titile='Sign In'>Sign In </a>";
}//not signed in?>
<nav>
    <ul>
        <li><p style=text-align:center ><img   class="avatar" src="<?php echo $pic ?>" title="Pami-hero" width="42"></p></li>
        <div id="key" style=text-align:center>&Congruent;</div><!--key-->

        <div id="menu">
                <li><a href="dashboard.php" title="Dashboard">&#x2635; Dashboard &nbsp;&nbsp; </a> </li>  
                <li><a href="profile.php" title="Profile">&#x2600; Profile &nbsp;&nbsp; </a> </li>  
                <li><a href="blog.php" title="Blog"> &#x270E;  Blog &nbsp;&nbsp; </a> </li>  
                <li><a href="signout.php" title="Signout"> &#x2639; Signout &nbsp;&nbsp; </a></li>
            
        </div><!--menu-->
    </ul>
</nav>
<?php

}//end head function

//-----------------------------rename dublicated files--------------------------------------
function fileNewName($path, $filename){
	if($pos=strrpos($filename,'.')){
	/*	$name=substr($filename,0,$pos);
		$ext=substr($filename,$pos);	*/
		$parts=explode('.',$filename);
		/*echo "<pre>";  x[0] x[1]
		print_r($parts);
		echo "</pre>";*/
		$parts_no=count($parts);
		$ext=$parts[$parts_no-1];
		$name='';
		for($i=0;$i<=$parts_no-2;$i++){
			
			$name=$name.$parts[$i].'.';
		}//end loop		
		$name=rtrim($name,'.');
		
		}//end extension
	else{
		$name=$filename;
		$ext='';
	}
	$newpath=$path.$filename;
	$newname=$filename;
	$counter=1;
	while(file_exists($newpath)){
		$newname=$name.'_'.$counter.'.'.$ext;
		$newpath=$path.$newname;
		$counter++;
	}//end rename
	return $newname;
}//end function
//-------------------------------------------------------------------------------------------------
?>


