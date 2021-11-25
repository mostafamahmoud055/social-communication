<!DOCTYPE html >
	<html>
	<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
if($_POST['submit']){
$directory=getcwd();
$file_name=$_FILES['upload']['name'];
$target_file=$directory.'/'.$file_name;
$ext = pathinfo($target_file,PATHINFO_EXTENSION);
echo $taget_file;
echo $ext;
}
?>

</form>
<pre>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$type = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    
	 $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
	print_r($check);
	    echo "File is an image - " . $check["mime"] . ".";
        
    } else {
}

	?>
</pre>
</body>
</html>