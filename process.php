<?php
include('functions.php');
$con=connect();
if(isset($_POST['username'])){
	$username=$_POST['username'];
	$sql ="SELECT `username` FROM `users` WHERE `username`='$username'";
	$result=mysqli_query($con,$sql);	
	//echo
	 $x=mysqli_num_rows($result);
	if($x==0){
		echo("<img src='imgs/available.png'>");	
			
		}else if ($x==1){
			echo("<img src='imgs/not-available.png'>");
			}
	
}
if(isset($_POST['email'])){
	$email=$_POST['email'];
	$sql ="SELECT `email` FROM `users` WHERE `email`='$email'";
	$result=mysqli_query($con,$sql);	
	//echo
	 $x=mysqli_num_rows($result);
	if($x==0){
		echo("<img src='imgs/available.png'>");	
			
		}else if ($x==1){
			echo("<img src='imgs/not-available.png'>");
			}
	
}
mysqli_close($con);

?>