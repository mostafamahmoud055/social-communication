<style>
#user {
	width:10%;
	float:left;
	display:block;
	background:#9F9;
	margin:10px;
	
	
}
</style>
<?php
include ('functions.php');
$my_id=$_COOKIE['id'];
$con=connect();



$sql="SELECT `id`,`ext`,`username` FROM `users`";
$result =mysqli_query($con,$sql);
while($row=mysqli_fetch_assoc($result)){
	if($my_id!=$row['id']){
	
//***************************************************************************************	
//***************************************************************************************	


$user_id=$row['id'];
$sqlx="SELECT `child_user` FROM `friends` WHERE `parent_user`='$my_id ' AND  `child_user`='$user_id'";
$resultx =mysqli_query($con,$sqlx);
$hide_userx=mysqli_num_rows($resultx);
if($hide_userx==0){
	
	
//***************************************************************************************	
//***************************************************************************************	
	
	
	
	
	
	$user=$row['username'];
	$pic='users-pic/'.$row['id'].'.'.$row['ext'];
?>
<div id="user">
    
<p styke=text-align:center><img src="<?php echo $pic; ?>" title="<?php echo $user; ?>" width="42" height="42"><br><?php echo $user; ?>

</p>
    </div><!--users-->
	<?php
}//end if

	}//end if -dont output current client
	}//end while

?>



<script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){

//-------------------------------------username-----------------------------------	
	var x_timer;    
    $("#username").keyup(function (e){
        clearTimeout(x_timer);
        var username = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(username);
        }, 300);
    }); 

function check_username_ajax(username){
    $("#user-result").html('<img src="ajax-loader.gif" />');
    $.post('x.php', {'username':username}, function(data) {
      $("#user-result").html(data);
    });
}
//----------------------------------------------------------------------------------
});
</script>
<div style="width:100%; clear:both">
<form action="" method="post">
<div id="registration-form">
  <label for="username">Enter Username :
  <input name="username" type="text" id="username" maxlength="15"> <span id="user-result"></span>
  </label>
  <input type="submit" name="submit" value="Send Friendship Requist" />
  </form>
</div>
</div>
<?php

if (isset($_POST['submit'])){
	$con=connect();
	$username=$_POST['username'];
	$sql="SELECT `id` FROM `users` WHERE `username`='$username'";	
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_assoc($result)){
		$frnd_id=$row['id'];
		$sql_ins="INSERT INTO  `pami`.`friends` 
		(`parent_user` ,`chiled_user`,`state`,`username`)VALUES 
		('$my_id',  '$frnd_id','0','$username')";
		
		$search="SELECT `id` FROM `friends` WHERE `chiled_user`='$frnd_id' AND `parent_user`='$my_id' ";
		$result_search=mysqli_query($con,$search);
		$x=mysqli_num_rows($result_search);
		if($x==0){
			mysqli_query($con,$sql_ins);
			header("Location:users.php");
		}else{
			echo "<p style='color:red'>You already have this person in your contacts</p>";
		}//end current friend
	}//end while	
}//end submit
mysqli_close($con);
?>
