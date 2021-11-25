<script src="js/jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function(){
	function validate(){
	
	$.post('call.php',function(data){
		$('#result').html(data)
	
		
		})}
	})
</script>
