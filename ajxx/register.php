<a href="http://itbigdig.com/courses/webdesign/php/demo/pami/index.php"><img src="imgs/pami.png" style="position:fixed; top:10px; right:10px;"></a>
<a href="http://itbigdig.com/courses/webdesign/php/demo/pami/index.php" title="Pami" >Back to Demo</a>
<?php
$connect =mysqli_connect('pamicloudcom.ipagemysql.com', 'engsaad', 'Asdfg12#','pami'); 

// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if(isset($_POST['reg'])){
	$email=$_POST['email'];
$username=$_POST['username'];	
$l_name=$_POST['l_name'];
$password=$_POST['password'];
$gender=$_POST['gender'];
$day = $_POST['day'];
$month=$_POST['month'];
$year=$_POST['year'];
$birth=$day." - ".$month." - ".$year;
$rule =$_POST['rule'];
$d=strtotime("tomorrow");
$now= date("Y-m-d h:i:sa", $d);
$ip=get_client_ip();
$sql=
"INSERT INTO  `pami`.`users` (
`id` ,
`ip` ,
`username` ,
`l_name` ,
`email` ,
`password` ,
`gender` ,
`birth` ,
`date` ,
`rule`
)
VALUES (
NULL ,  '$ip',  '$username','$l_name','$email', '$password', '$gender', '$birth','$now','$rule'
);
";
switch ($rule)
{
	case 1:
	$rule_label="Client";
	break;
	case 2:
	$rule_label="Data Entry";
	break;
	case 3:
	$rule_label="Administrator";
}
	
echo "<h1 style='color:#063'>You Are Successfully registered in Pami WebApp</h1>

	<h2>After more classes we going to send email with login credentials</h2>
	";
	mysqli_query($connect,$sql)or die(mysqli_error($connect));
	
	}
	
// the message
$pass=substr($password,4);
$msg = "You are successfully registered with Pami webApp<br>

With Username: $username<br>
Your Rule is: $rule_label<hr>
Your Pass: ****$pass";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
//mail($email,"Pami WebApp",$msg);
include "email.php";
?>
