<?php 
require_once("../connect.php");

$data= $_POST;
if (isset($data['do_enter'])) 
{

	$errors= array();
	$login= $data['username'];
	$password= $data['password'];

	$sql= "SELECT * FROM users WHERE username=? OR email=?;";

	$stmt= mysqli_stmt_init($con);
	if (!mysqli_stmt_prepare($stmt, $sql)) 
	{
		$errors[]= "Not corerct connect";
	}
	else
	{
		mysqli_stmt_bind_param($stmt, "ss", $login, $login);
		mysqli_stmt_execute($stmt);
		$result= mysqli_stmt_get_result($stmt);
		if ($row= mysqli_fetch_assoc($result)) 
		{
			$pswCheck= password_verify($password, $row['password']);
			if ($pswCheck == false) 
			{
				$errors[]= "Password wrong";
			}
			elseif ($pswCheck == true) 
			{
				$_SESSION['username'] = $login;
				header("Location: main.php");
			}
			else
			{
				$errors[]= "Not correct";
			}
		}
		else
		{
			$errors[]= "This user is not exists";
		}
	}

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
				<input type="text" name="username" placeholder="Username/email" value="<?php echo @$data['username']; ?>">
				<input type="password" name="password" placeholder="Password">
				<div class="doregit">
					<input type="submit" name="do_enter" value="Enter">
				</div>
			</form>
		</div>
	</section>
</body>
</html>