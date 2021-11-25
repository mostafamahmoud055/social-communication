<?php setcookie('id', 'id', time() + (86400 * -30*30), "/"); // 86400 = 1 month
if (!isset($_COOKIE['id'])){
	echo "Successfully signed out";
	}?>
</body>
</html>