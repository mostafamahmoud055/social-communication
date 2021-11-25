<!DOCTYPE html >
		<html>
		<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#email').keyup(function(e){
		$(this).val($(this).val().replace(/\s/g, ''));
		var email = $(this).val();
		if(email.length <6){
			$("#user-email").html('<img src="imgs/not-available.png" />');}
		else
		{$("#user-email").html('<img src="imgs/ajax-loader.gif" />');}
		})
//-------------------------------------username-----------------------------------	
	var x_timer;    
    $("#username").keyup(function (e){
        clearTimeout(x_timer);
        var username = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(username);
        }, 1000);
    }); 

function check_username_ajax(username){
    $("#user-result").html('<img src="ajax-loader.gif" />');
    $.post('process.php', {'username':username}, function(data) {
      $("#user-result").html(data);
    });
}
//----------------------------------------------------------------------------------

//-------------------------------------email-----------------------------------	
	var timer;    
    $("#email").keyup(function (e){
        clearTimeout(timer);
        var email = $(this).val();
        timer = setTimeout(function(){
            check_email_ajax(email);
        }, 1000);
    }); 

function check_email_ajax(email){
    $("#user-email").html('<img src="ajax-loader.gif" />');
    $.post('process.php', {'email':email}, function(data) {
      $("#user-email").html(data);
    });
}
//----------------------------------------------------------------------------------





	});
</script>


</head>

<body>
<?php 
include('functions.php');
if(!isset($_COOKIE['id'])){
?>

<form action="" method="post">





<div id="registration-form">
  Enter Username :
  <input name="username" type="text" id="username"> <span id="user-result"></span>
</div>



Password: <input type="password" name="password" id="password"><br>
Cofirm Password: <input type="password" name="conf-password" id="conf-password"><br>
Email: <input type="text" name="email" id="email"><span id="user-email"></span><br>
Confirm Email: <input type="text" name="conf-email" id="conf-email"><br>
<input type="submit" name="regiter" value="Register">
</form>
<?php
}//end validation block
//connect to pami
$con=connect();
if($con){
	echo "Connected";
	if(isset($_POST['register'])){
		//store input data in php variables
		$username=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		$sql="INSERT INTO `users` (`username`,`password`,`email`)VALUES('$username','$password','$email')";
		mysqli_query($con,$sql);
		mysqli_close($con);
	}//isset block
}else{
	die("Connection Error:".mysqli_connect_error());
}//connection block	
?>
</body>
</html>