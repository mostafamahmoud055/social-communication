<style>
body { background-color:#033; color:#FF0; font-family:"Times New Roman", Times, serif}
</style><?php 
$to = 	"$email";
$subject = 	"Registration Confirmation: PamiCloud";
$bound_text =  "<span style='font-family:Zentaiges, Helvetica, sans-serif'>  (Good Day $name) <a href='http://pamicloud.com'>PamiCloud</a> Accounts<hr></span>";
$bound = 	"--".$bound_text."\r\n";
$bound_last = 	"--".$bound_text."--\r\n";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\r\n"
  	."Content-Transfer-Encoding: 7bit\r\n\r\n";

// Additional headers
$headers .= "To:  <$email>, <Accounts@pamicloud.com>\r\n";
$headers .= 'From:  <Accounts@pamicloud.com>' . "\r\n";
$headers .= 'Cc: itbigdig@gmail.com' . "\r\n";
$headers .= 'Bcc: itbigdig@gmail.com' . "\r\n";


$message .= "<img src='http://pamicloud.com/img/pami.jpg' width='300'>
		<table style='background-color:#E4E1DB' >
		<tr> 
		<td><h1>Your Registration Confirmation:<h1><h4>Thank you for registering to  
		<span style='font-family:Zentaiges, Helvetica, sans-serif'><a href='http://pamicloud.com'>PamiCloud</a>.
		 
 </h4>
 <h1><a href='http://pamicloud.com/logged.php?confirm=$date'> Confirm Your Registration</a></h1>
 </td>
		</tr>
		 <tr>
		 <td>
		 <h3 style='font-size:14px; font-weight:bold'>
		 We received a request from $email  to create account on  
		 <hr></span>
		 
		 </h3>
		 </td>
		 <td>
		 <b> </b>
		 </td>
		 </tr>
		 <tr>
		<td>
			<i>Account: ".$email."</i> \r\n\r\n 
			</td>
			<td> 
			</td> 
			</tr> \r\n"
."<tr><td> <b>Your Password: $pass</b></td> 
<td></td>
</tr>\r\n\r\n"
." <tr> <td><h4><b>If you have any questions please contact\r\n\r\n</b></h4></td> <td> </td></tr>"
." <tr> <td><a href='http://pamicloud.com'>PamiCloud </a> Support@pamicloud.com"."\r\n\r\n</td> <td></td></tr> 
<tr><td>"
  	.$bound."</td> <td> </td></tr>
		</table>
		";
  	 
$file = 	file_get_contents("http://reviewabandb.co.uk/reviewabandb/wp-content/uploads/2014/05/Reviewa-Logo-footer-t.png");
  	 
$message .=$bound_last;
mail($to, $subject, $message, $headers);

	?>
