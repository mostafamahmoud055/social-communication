<?php
include('functions.php');
$con=connect();
if(isset($_POST['username'])){
	$username=$_POST['username'];
	$sql ="SELECT * FROM `users` WHERE `username`='$username'";
	$result=mysqli_query($con,$sql);	
	//echo
	 $x=mysqli_num_rows($result);
	 
	if($x==0){
		echo('Not Found <img src="imgs/not-available.png">');	
	}else if ($x==1){
			echo(' Found  <img src="imgs/available.png">');
			while($row=mysqli_fetch_assoc($result)){
				$pic='users-pic/'.$row['id'].'.'.$row['ext'];
				echo "<pre>";
				echo "<img src='$pic' width='42' title='$username'>";
				print_r($row);
				echo "</pre>";	
			}//end while
		
			}
	
}