// JavaScript Document
$(document).ready(function() {
	
//------------------------------username-------------------------
/*chech is there any data in the field
		if yes append character of word- Complete - to msg var
		spilit msg into array
		count array elements ,if = 8 then all data completed
		show submit button
		*/
var msg="";
$("#user").on('change',function (){
	//removes spaces from username
		$(this).val($(this).val().replace(/\s/g, ''));		
		var user = $(this).val();
	if(user.length >2){
			msg =msg+"c";
			var x = msg.split("");
			var n=msg.length;
			if(n>=8){$( document.body).click(function() {
				document.getElementById("registerme").style.display="block" ;})
		  }//end if n=8 
		document.getElementById("1").style.background="blue"; 
		$("#1").fadeIn("fast");
	}else{	//textbox is empty	
		document.getElementById("1").style.background="red";
	}//end user 
});		
//-----------------------------------Password--------------------------
$("#pass").on('change',function (){
	var pass = $(this).val();
	if(pass.length >2){
	msg =msg+"o";
	var x = msg.split("");
	var n=msg.length;
	if(n>=8){
		$( document.body )
		.click(function() {
		document.getElementById("registerme").style.display="block" ;
		  })} 
		document.getElementById("2").style.backgroundColor="blue"; 
		$("#2").fadeIn("fast");
	}else{
		document.getElementById("2").style.background="red";   
	}
});
//-----------------------------------Re-Password--------------------------
$("#repass").on('change',function (){
	var pass=document.forms['register']['password'].value;
	var repass = $(this).val();
if(repass.length >2 && pass == repass){
	msg =msg+"m";
	var x = msg.split("");
	var n=msg.length;
	if(n>=8){
	$( document.body )
	.click(function() {
	document.getElementById("registerme").style.display="block" ;
	})} 
	$("#3").fadeIn("fast");
	document.getElementById("3").style.backgroundColor="blue"; 
}else{		
	document.getElementById("3").style.background="red";}			
 });
//-----------------------------------full-name--------------------------	
$("#name").on('change',function (){
	var name = $(this).val();
if(name.length >4 ){
	msg =msg+"p";
	var x = msg.split("");
	var n=msg.length;
	if(n>=8){
	$( document.body )
	.click(function() {
	document.getElementById("registerme").style.display="block" ;
	})} 
	$("#4").fadeIn("fast");
	document.getElementById("4").style.backgroundColor="blue"; 
}else{document.getElementById("4").style.background="red";}		
});
//-----------------------------------Email--------------------------
$("#email").on('change',function (){
	var email = $(this).val();
if(email.length >4 ){
	msg =msg+"l";
	var x = msg.split("");
	var n=msg.length;
	if(n>=8){
	$( document.body )
	.click(function() {
	document.getElementById("registerme").style.display="block" ;
	})} 
	$("#5").fadeIn("fast");
	document.getElementById("5").style.backgroundColor="blue"; 
}else{		
	document.getElementById("5").style.background="red";  
}
 });
 //--------------------------------------Gender----------------------
$("#gender").on('change', function() {
	var gender = $(this).val();
if(gender.length >2 ){
	msg =msg+"e";
	var x = msg.split("");
	var n=msg.length;
	if(n>=8){
	$( document.body )
	.click(function() {
	document.getElementById("registerme").style.display="block" ;
	})} 
	$("#6").fadeIn("fast");
	document.getElementById("6").style.backgroundColor="blue"; 
}else{		
	document.getElementById("6").style.background="red"; 
	}
});
//-------------------------------------------Birth-----------------------
$("#form_dob_year").on('change', function() {
	var year = $(this).val();
	if(year.length >2){
	msg =msg+"t";
	var x = msg.split("");
	var n=msg.length;
	if(n>=8){
	$( document.body )
	.click(function() {
	document.getElementById("registerme").style.display="block" ;
	  })} 
	$("#7").fadeIn("fast");
	document.getElementById("7").style.backgroundColor="blue"; 
}else{		
	document.getElementById("7").style.background="red"; 
}			
})
//-----------------------------------Rule---------------------------------
$("#rule").on('change', function() {
	var rule = $(this).val();
	if(rule.length !=0){
	msg =msg+"e";
	$("#8").fadeIn("fast");
		document.getElementById("8").style.backgroundColor="blue";
		var x = msg.split("");
		var n=msg.length;
		alert(n);
		if(n>=8){
			$( document.body )
			.click(function() {document.getElementById("registerme").style.display="block" ;})
		} 
}else{		
	document.getElementById("8").style.background="red";
}
 })
		
//---------------------------------email---------------------------	
	$("#email").keyup(function (e) {
		var email = $(this).val();
		if(email.length <4){$("#user-result").html('');return;}
		if(email.length >= 4){
			$("#user-result").html('<img src="imgs/ajax-loader.gif" />');
			$.post('process.php', {'email':email}, function(data) {
			  $("#user-result").html(data);
			});
		}
	
	  });	
});
