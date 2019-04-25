<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/fonts.css">
</head>
<body>
	<header>		
		<ul>
			<div class="log">
				<li><a href="index.php">Logo</a></li>
			</div>
			<div class="singbut">
				<li><a href="login.php">Log in</a></li>
				<li><a href="register.php">Sing up</a></li>
			</div>
		</ul>	
	</header>
	<section>
		<div class="centersing">
			<form action="" method="POST">
				<input type="text" name="username" placeholder="Username">
				<input type="text" name="firstname" placeholder="First name">
				<input type="text" name="lastname" placeholder="Last name">
				<input type="email" name="email" placeholder="Email">
				<input type="password" name="password" placeholder="Password">
				<input type="password" name="password_twice" placeholder="Password also">
				<div class="doregit">
					<input type="button" name="do_register" value="Register">
				</div>
			</form>
		</div>
	</section>
</body>
</html>