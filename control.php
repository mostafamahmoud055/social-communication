<style>
	fieldset { 
		width:40%; 
		display:inline-table;
		background:#FFC;
		font-weight:bolder;
		margin-left:4%;
	}
	#main-users{ 
		background:#eee; 
		margin:5px; 
		padding:10px; 
		border:2px solid #333; 
		border-radius:3px; 
		box-shadow:1px 2px 1px #666;
	}
</style>
<div id="main-users">

   <fieldset  style="background:#6F9">
    <legend>Friends</legend>
    <?php
		include ('functions.php');
		$my_id=$_COOKIE['id'];
		$con=connect();
		$sql="SELECT `id`,`ext`,`username` FROM `users`";
		$result =mysqli_query($con,$sql);
		while($row=mysqli_fetch_assoc($result)){
			$user_id=$row['id'];
			$user=$row['username'];
			$pic='users-pic/'.$row['id'].'.'.$row['ext'];
			if($my_id!=$user_id){
				$sqlx="SELECT `child_user` FROM `friends` WHERE 
							`parent_user`='$my_id ' AND  
							`child_user`='$user_id' AND 
							`state`='1'";
				$resultx =mysqli_query($con,$sqlx);
				$pending=mysqli_num_rows($resultx);
				if($pending!=0){
		?>
                    <div id="user" style="display:inline-table">
                        <p align="center"><img src="<?php echo $pic; ?>" title="<?php echo $user; ?>" width="42" height="42">
                            <br>
                            <?php echo $user; ?>
                        </p>
                     </div><!--users-->
		<?php
		}}}
		//--------------------Add  to frnd List if state=1 (Childe_user)------------------------------------------------
		$income_frnd="SELECT `id`,`parent_user` FROM friends WHERE
								`child_user`='$my_id' AND
								`state`='1'";
		$in_query=mysqli_query($con,$income_frnd);						
		while($frnd=mysqli_fetch_assoc($in_query)){
			$parent=$frnd['parent_user'];
			$req_id=$frnd['id'];
			$sql_disp="SELECT `id`,`ext`,`username` FROM `users` WHERE `id`='$parent'";
			$disp_query=mysqli_query($con,$sql_disp);
			while($disp_frnd=mysqli_fetch_assoc($disp_query)){
			/*echo "<pre>";
			print_r($disp_frnd);	
			echo "</pre>";*/
			 $disp_id=$disp_frnd ['id'] ;
    		$disp_ext=$disp_frnd['ext']; 
   			$disp_username=$disp_frnd ['username'];
			$pic='users-pic/'.$disp_id.'.'.$disp_ext;
			?>
                    <div id="user" style="display:inline-table">
                        <p align="center"><img src="<?php echo $pic; ?>" title="<?php echo $disp_username; ?>" width="42" height="42">
                            <br>
                            <?php echo $disp_username; ?>
                        </p>
                     </div><!--users-->
		<?php
			
			
			}//end while

		
		}//end while frnd						
								
								
								
								
								
								
		//--------------------------------------------------------------------------------------------------End of frnd list
		?>
    </fieldset>
    
<!---------------------------------end of Friends list--------------------------------------------->
       
    <fieldset>
     	<legend>Pending</legend>
    	<?php
		/*include ('functions.php');
		$my_id=$_COOKIE['id'];
		$con=connect();*/
		$sql="SELECT `id`,`ext`,`username` FROM `users`";
		$result =mysqli_query($con,$sql);
		while($row=mysqli_fetch_assoc($result)){
			$user_id=$row['id'];
			$user=$row['username'];
			$pic='users-pic/'.$row['id'].'.'.$row['ext'];
			if($my_id!=$user_id){
				$sqlx="SELECT `child_user` FROM `friends` WHERE
							`parent_user`='$my_id ' AND  
							`child_user`='$user_id' AND 
							`state`='0'";
				$resultx =mysqli_query($con,$sqlx);
				$pending=mysqli_num_rows($resultx);
				if($pending!=0){
		?>
                <div id="user" style="display:inline-table">        
                    <p stylr=text-align:center><img src="<?php echo $pic; ?>" title="<?php echo $user; ?>" width="42" height="42">
                    <br>
                    <?php echo $user; ?>    
                </p>
                </div><!--users-->
		<?php
		}}}
    	?>
    </fieldset>
<!---------------------------------end of pending list--------------------------------------------->
<fieldset style="background:#FAD3D9">
<legend>Incoming Friend Requests</legend>
<?php
$incom="SELECT `id`,`parent_user` FROM  `friends` WHERE `child_user`='$my_id'  AND `state`='0'";
$income_query=mysqli_query($con,$incom);
while ($requests=mysqli_fetch_assoc($income_query)){
	 $parent_user=$requests['parent_user'];
	 $frnd_record=$requests['id'];
	$display="SELECT `id`,`ext`,`username` FROM `users` WHERE `id`='$parent_user'";
	$display_query =mysqli_query($con,$display);
	while($display_row=mysqli_fetch_assoc($display_query)){
				 $user_id=$display_row['id'];
				 $user=$display_row['username'];
				$pic='users-pic/'.$display_row['id'].'.'.$display_row['ext'];
	
		   ?>
					<div id="user" style="display:inline-table">        
						<p align="center"><img src="<?php echo $pic; ?>" title="<?php echo $user; ?>" width="42" height="42">
						<br>
						<?php echo $user; ?>    
					</p>
                    <form action="" method="post">
                    <input type="submit" name="accept" value="Accept">
                    <input name="x" type="hidden" value="<?php echo $frnd_record;?>">
                    </form>
					</div><!--users-->
			<?php
	}//end while
}
if(isset($_POST['accept'])){	
	echo $rec_id= $_POST['x'];
	$sql="UPDATE `friends` SET `state`='1' WHERE `id`='$rec_id'";
	mysqli_query($con,$sql);
	mysqli_close($con);
	header('Location:control.php');
	}
?>
</fieldset>
</div>