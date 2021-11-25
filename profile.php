<!DOCTYPE html >
		<html>
		<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
</head>

<body>
<?php
if(isset($_COOKIE['id'])){
	echo "User Profile<br><hr>";
	 $pic_path=getcwd()."/users-pic/".$_COOKIE['id'].'.jpg';
	echo "<img src='$pic_path' alt='User Pic'>";
}//end validation block

?>
</body>
</html>