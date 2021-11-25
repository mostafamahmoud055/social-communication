<html>
<head>
<script src="js/jquery-1.12.4.min.js"></script>

</head>
<body onLoad="validate()">
<?php 

include ('functions.php');
$con=connect();
$sql="SELECT * FROM `users` WHERE `id`='1'";
$result=mysqli_query($con,$sql);
while ($row=mysqli_fetch_assoc($result)){

	echo $user=$row['username'];

	//print_r($row);

?>
<script type="text/javascript">
    var x = "<?php echo $user; ?>";
$("#result").html(x);
</script>

<?php	}
?>
<div id="result" style="color:red">
</div>
</body>
</html>