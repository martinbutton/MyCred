<?PHP
/* MyCred: User Registration and Authentication program.
 *	       User Login Form.  M.Button
 */

// Start session and obtain backend functions
session_start();
require "validate.php";
include "MyCred.php";
global $formData;

	// Handle Post Requests
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (array_key_exists("register", $_POST)) {
			header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/register.php");
		}

		if (array_key_exists("login", $_POST)) {
			if (formValidate(FORM_LOGIN)) {
				loginUser();
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<!-- Login Screen -->
<head>
	<title>My Credentials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MyCred.css">
</head>
<body>
	<?PHP
	?>

	<div class="heading">My Credentials</div>
	<div style="text-align: center; margin-bottom: 10px;">Please Login:</div>
	<div style="text-align: center; margin-bottom: 10px;"><?PHP global $formError; echo $formError['message'];?></div>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Email Address:<br>
		<input class="typedInput" type="email" name="email"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['email'];?></div>

		Password:<br>
		<input class="typedInput" type="password" name="password"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['password'];?></div>

		<div style="padding-top: 10px; text-align: center; font-size: 14px;">
			Demo Authentication Program
		</div>

		<div style="width: 80%; margin: auto; margin-top: 20px;">
			<input class="formCancelBtn" type="submit" name="register" value="register">
			<input class="formSubmitBtn" type="submit" name="login" value="login">
		</div>
	</form>

	<div style="clear: both; height: 30px; border-bottom: 2px solid #0000dd;"></div>
</body>
</html>
