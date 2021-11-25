<?php include('functions.php');?>
<!DOCTYPE html >
		<html>
		<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signin</title>
</head>

<body>
<form action="" method="post">
User Or Email: <input type="text" name="user"  />
Password: <input type="password" name="password" />
<input type="checkbox" name="remember"> Remember Me
<input type="submit" name="signin" value="Sign In" />
</form>
<?php
if(isset($_POST['signin'])){
	$con=connect();
	$username=$_POST['user'];
	$password=$_POST['password'];
	$email=$_POST['user'];
	$sql="SELECT `id` FROM `users` WHERE (`username`='$username' OR `email`='$email') AND `password`='$password'";
	$result=mysqli_query($con,$sql);
	while ($row=mysqli_fetch_row($result)){
		$_SESSION['id']=$row[0];
		
		if ($_POST['remember']==true){
			//echo "Remember me";
			//$cookie_name = "id";
			$cookie_value = $row[0];
			setcookie('id', $cookie_value, time() + (86400 * 30*30), "/"); // 86400 = 1 month
		}//end remember me
		
		
	}//end while
	mysqli_free_result($result);
	mysqli_close($con);
header("Location:dashboard.php");
}//end signin
?>
</body>
</html>