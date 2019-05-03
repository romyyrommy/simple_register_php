<?php 
require_once("../connect.php");
//Bu faylımızda qeydiyyat aparacıq və qeydiyyat skripti yazacıq

$data= $_POST;
if (isset($data['do_register'])) 
{
	$errors= array();

	$login= $data['username'];
	$username= $data['firstname'];
	$lstname= $data['lastname'];
	$email= $data['email'];
	$password= $data['password'];
	$psw_twice= $data['password_twice'];

	if (empty($login) || empty($username) || empty($lstname) || empty($email)  || empty($password)) 
	{
		$errors[]= "Please fill in inputs";
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
		$errors[]= "Please input valid email";
	}
	elseif (!preg_match("/^[a-zA-Z0-9]*$/", $login)) 
	{
		$errors[]= "Please input valid username";
	}
	elseif ($psw_twice != $password) 
	{
		$errors[]= "Passwords are not concodence";
	}

	else
	{
		$sql= "SELECT username FROM users WHERE username=?";

		$stmt= mysqli_stmt_init($con);
		if (!mysqli_stmt_prepare($stmt, $sql)) 
		{
			$errors[]= "Can not contect";
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "s", $login);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck= mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) 
			{
				$errors[]= "This user already exists";
			}
			else
			{
				$sql= "INSERT INTO users (username, ad, soyad, email, password) VALUES (?, ?, ?, ?, ?)";

				$stmt= mysqli_stmt_init($con);
				if (!mysqli_stmt_prepare($stmt, $sql)) 
				{
					$errors[]= "Can not contect";
				}
				else
				{
					$pswHash= password_hash($password, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "sssss", $login, $username, $lstname, $email, $pswHash);
					mysqli_stmt_execute($stmt);
					header("Location: succes.php");
				}
			}
		}
	}
mysqli_stmtm_close($stmt);
mysqli_close();

}

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
				<li><a href="../index.php">Logo</a></li>
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
				<?php if(!empty($errors)) {?>  <div style="color: red"><?php echo array_shift($errors); ?></div> <?php } ?>
				<input type="text" name="username" placeholder="Username" value="<?php echo @$data['username'] ?>">
				<input type="text" name="firstname" placeholder="First name" value="<?php echo @$data['firstname'] ?>">
				<input type="text" name="lastname" placeholder="Last name" value="<?php echo @$data['lastname'] ?>">
				<input type="email" name="email" placeholder="Email" value="<?php echo @$data['email'] ?>">
				<input type="password" name="password" placeholder="Password">
				<input type="password" name="password_twice" placeholder="Password also">
				<div class="doregit">
					<input type="submit" name="do_register" value="Register">
				</div>
			</form>
		</div>
	</section>
</body>
</html>