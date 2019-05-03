<?php 
require_once("../connect.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/fonts.css">
</head>
<body>
	<header>		
		<ul>
			<div class="log">
				
			</div>
			<div class="singbut">
				<li><a href="logaut.php">Exit</a></li>
			</div>
		</ul>	
	</header>
	<section>
		<div class="profile">
			<div class="img">
				<img src="../img/Trustees.jpg" alt="#">
			</div>
			<div class="info">
				<?php 


if (isset($_SESSION['username'])) 
{
	$login= $_SESSION['username'];
	echo "Hello ".$login;
}

 ?>
			</div>
		</div>
	</section>
</body>
</html>