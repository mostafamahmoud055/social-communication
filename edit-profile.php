<?php
include('functions.php');
?><form action="" method="post" enctype="multipart/form-data">
Upload Your Pic: <input type="file" name="user-pic">
<input type="submit" name="upload" value="Upload">
</form>
<h2> - Allowed File Types ( jpg - png - gif - bmp - jpeg )</h2>
<hr> 
<?php
if(isset($_COOKIE['id'])){
	head();
	if(isset($_POST['upload'])){
		$current_path=getcwd();
		$path=$current_path."/users-pic/";
		echo "<pre>";
		$fpath=$path.$_FILES['user-pic']['name'];	
		$path_parts=pathinfo($fpath);	
		$ext=$path_parts['extension'];
		$allowed_ext=array('jpg','JPG','png','PNG','gif','GIF','bmp','BMP','jpeg','JPEG');	
		if(in_array($ext,$allowed_ext)){
		
			$_FILES['user-pic']['name']=$_COOKIE['id'].".".$ext;
			
			//-------------save pic extension to users table----------------
			$id=$_COOKIE['id'];
			$con=connect();
			$sql="UPDATE `users` SET `ext`='$ext' WHERE `id`='$id'";
			mysqli_query($con,$sql);
			mysqli_close($con);
			//---------------------------------------------------------------
			
			move_uploaded_file($_FILES['user-pic']['tmp_name'],$path.$_FILES['user-pic']['name']);
		}else{
			echo "File type Not allowed";
		}//end file type detection	
	}//end upload
}//end validation block
?>

<?php
$con=connect();
$id=$_COOKIE['id'];
$sql ="SELECT * FROM `users` WHERE `id`='$id'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($result)){
	echo "<pre>";
	print_r($row);
	echo "</pre>";
	$pic='users-pic/'.$row['id'].'.'.$row['ext'];
	$password=$row['password'];
	$dispaly_pass='***'.substr($password,3);
	echo "Display password".$dispaly_pass."<br>";
	?>
    <form action="" method="post">
    User Picture: <img src="<?php echo $pic;?>" width="42"><br>
    UserName: <input type="text" name="username" value="<?php echo $row['username']; ?>"><br>
     Password: <?php echo $dispaly_pass; ?> 
    <input type="password" name="password" value="<?php echo $row['password']; ?>"><br>
    Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
    
    <?php
	$gender=$row['gender'];
	$gm='';
	$gf='';
	if($gender=='Male'){
	$gm='checked';
	$gf='';
	}elseif($gender=='Female'){
	$gm='';
	$gf='checked';
	}//end gender block
	?>
    
    <input type="radio" name="gender" value="Male" <?php echo $gm; ?>> Male <br>
    <input type="radio" name="gender" value="Female" <?php echo $gf; ?>>Female <br>
    
    
    
    
    Birthdate: <input type="date" name="birthdate" value="<?php echo $row['birthdate']; ?>"><br>
    <input type="submit" name="update" value="Update">
    </form>
    
    
    <?php
	if(isset($_POST['update'])){
		$username=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		$gender=$_POST['gender'];
		$birthdate=$_POST['birthdate'];
		$sql="UPDATE  `pami`.`users` SET  
		`username` =  '$username' ,
		`password`='$password',
		`email`='$email',
		`gender`='$gender',
		`birthdate`='$birthdate'
		WHERE  `users`.`id` ='$id'";
		mysqli_query($con,$sql);
		header("Location:edit-profile.php");
	}//end upload
	
	
}//end while
?>
</body>
</html>