<?php include('functions.php'); ?>
<style>
#frnd {
    width: 7%;
    display: block;
    float: right;
}
.user {
    display: block;
    background: #993;
    margin: 10px;
    border-radius: 90px;
    box-shadow: 1px 1px 1px #333;
    padding: 5px;
}
.user p img {
	border-radius: 90px;
    box-shadow: 1px 1px 1px #fff;	
}
</style>


<body>
<?php
if( isset($_COOKIE['id'])){
	//echo "Successfuly Signed In";
	 $id=$_COOKIE['id'];
	head();
	$con=connect();
	
	$sql="SELECT `child_user` FROM `friends` WHERE `parent_user`='$id' AND `state`='1'";
	
	$result=mysqli_query($con,$sql);
	echo "<div id='frnd'><br>";
	
	echo "<p align='center'>Friends List</p>";
	while($row=mysqli_fetch_assoc($result)){
		$child_id= $row['child_user'];	
		$sql_frnd="SELECT `id`,`ext`,`username` FROM `users` WHERE `id`='$child_id'";
		$frnd_result=mysqli_query($con,$sql_frnd);
		while($frnd_row=mysqli_fetch_assoc($frnd_result)){
			$pic='users-pic/'.$frnd_row['id'].'.'.$frnd_row['ext'];
			$username=$frnd_row['username'];
			?>
            <div class="user">
                <p style=text-align:center>
                    <img src="<?php echo $pic; ?>" title="<?php echo $username; ?>" width="42" height="42">
                    <br><?php echo $username; ?>
                </p>
    		</div><!--users-->
			<?php
		}//end  friend list loop
	}//end while row
	echo "</div>";//end of frnd diversion
	}else{
	echo "Protected Contents you have to signin...!";?>
	<a href="signin.php" title="Sign In">Sign In</a>	
	<span> OR...!</span>
	<a href="register.php" title="Sign In">Register</a>	
	<?php 
}
?>
</body>
</html>