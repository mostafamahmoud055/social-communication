<?php session_start();
$my_id=$_COOKIE['id'];
$pic_url='';
 ?>
<style>
#box{ display:none}
@import url(https://fonts.googleapis.com/css?family=Ubuntu);
#box { display:none }
fieldset{ 
	width:60%; 
	background:#FF9;
	box-shadow:2px 1px 1px #FF0; 
	padding:20px; 
	margin:20px; 
	font-family:Ubuntu Arial, Helvetica; 
	 font-size:22px}
input  {
	font-size:20px;
	padding:10px;}
input[type="submit"]  {
	background:#333;
	color:yellow;
	width:20%}
input[type="checkbox"]  {
    display:inline-block;
    width:30px;
    height:39px;
    vertical-align:middle;
    cursor:pointer;
	margin:20px;}
table { 
	background:#FF6; 
	color:#000; 
	margin:20px; 
	padding:20px }
#art_img{
	right:15px;
	opacity:0.7; 
	top:100px; 
	position:fixed;
	border:5px solid yellow}
	@media screen and (max-width: 680px) {
#art_img{ position:relative; float:right; width:80px}
input[type="submit"]  {
	width:50%;}
}
</style>
<?php include 'functions.php';
head();

 ?>

<!-------------------------Upload--------------------------------------->
<form action="" method="post" enctype="multipart/form-data">
    <fieldset >
    <legend>Upload Article Image</legend>
    <input type="file" name="pic" id="file" />
    <input  type="submit" name="upload" id="upload" />
    </fieldset>
</form>
<?php
if(!empty( $_FILES['pic'])) 
{
	$upload_path="images/";
/*	echo "success";
echo "<pre>";
print_r($_FILES);
echo "</pre>";
*/$filename=fileNewName($upload_path,$_FILES['pic']['name']);
move_uploaded_file($_FILES['pic']['tmp_name'],$upload_path.$filename);

		$_SESSION['pic_url']=$_FILES['pic']['name'];

		$pic_url='images/'.$_SESSION['pic_url'];
		echo "<img id='art_img' src='".$upload_path.$_FILES['pic']['name']."' width='200'>";
// --------Display second form---------------------------------------------------------
echo "<style>
#box{ display:block}
</style>";
}//end upload
?>
<!--------------------------Article Data---------------------------------->
<div id="box">
<form action="" method="post">
    <fieldset >  
        <legend>Title</legend>
        <input type="text" name="title" style="width :85%;font-size:30px" />
    </fieldset><br>
    <fieldset >  
        <legend>Contents</legend>
        <textarea name="contents" style="width:90%; height:300px;font-size:22px"></textarea>
    </fieldset><br>
    <fieldset>  
    	<legend>Tags</legend>
    	<textarea name="tags" style="width:70%; height:100px;font-size:18px"></textarea>
    </fieldset><br>
    <fieldset>
    	<legend>Categories</legend>
    	<input type="text" name="category" style="width:70%; height:100px;font-size:18px"><br>
    </fieldset>
<table width="30%" style="left:right">
    <tr>
    	<td>Background</td>
    	<td><input type="text" name="background"></td>
    </tr>
    <tr>
    	<td>Foreground</td>
    	<td><input type="text" name="foreground"></td>
    </tr>
    <tr>
    	<td>Border</td>
    	<td><input type="text" name="border"></td>
    </tr>
    <tr>
    	<td>Shadow</td>
    	<td><input type="text" name="shadow"></td>
    </tr>
</table>
<h2><input type="checkbox" name="comments" value="1">Allow Comments</h2><br>
<input type="submit" name="submit">
</form>
</div><!--box-->
<?php 

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
if(isset($_POST['submit'])){
//echo "Success";
	$title=$_POST['title'];
	$contents=$_POST['contents'];
	$tags=$_POST['tags'];
	if(isset($_POST['comments']))
			{$comments=$_POST['comments'];}
	else  {$comments=0;}
	$background=$_POST['background'];
	$date=date("d/m/y");
	$state=1 ;//published
	$category=$_POST['category'];
	$foreground=$_POST['foreground'];
	$border=$_POST['border'];
	$shadow=$_POST['shadow'];
	$tags=$_POST['tags'];	
	$sql = "INSERT INTO `pami`.`articles` (
	`art_id`, 
	`art_title`, 
	`art_contents`, 
	`category`, 
	`tags`, 
	`date`, 
	`art_pic`, 
	`background`, 
	`foreground`,
	`border`,
	`box-shadow`,
	`author_id`,
	`comments`, 
	`state`) VALUES (
	  NULL,
	 '$title',
	 '$contents', 
	 '$category', 
	 '$tags', 
	 '$date',
	 '$pic_url', 
	 '$background', 
	 '$foreground', 
	 '$border',
	 '$shadow',
	 '$my_id',
	 '$comments',
	 '$state');";
	$con=connect();
	 mysqli_query($con,$sql);
	 session_destroy();
}//end submit sec form
?>