<?PHP
/*
 * MyCred: User Registration and Authentication program.
 *         Change Password Form.  M.Button
 */

// Start session and obtain backend functions
session_start();
require "validate.php";
include "MyCred.php";
checkSession(); // Check for valid session

// Handle Post Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (array_key_exists("cancel", $_POST)) {
		header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/index.php");
	}

	if (formValidate(FORM_CHANGEPWD)) {
		chgPassword();
	}

}
?>

<!DOCTYPE html>
<html>
<!-- Change Password Form. -->
<head>
	<title>My Credentials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MyCred.css">
</head>
<body>
	<div class="heading">My Credentials</div>
	<div style="text-align: center; margin-bottom: 10px;">Change Your Password:</div>
	<div style="text-align: center; margin-bottom: 10px; color: red;"><?PHP global $formError; echo $formError['message'];?></div>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Please enter your current Password:<br>
		<input class="typedInput" type="password" name="oldPassword"><br>

		Please enter your new Password:<br>
		<input class="typedInput" type="password" name="password"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['password'];?></div>

		Please enter your new Password again:<br>
		<input class="typedInput" type="password" name="password2"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['password2'];?></div>

		<div style="width: 80%; margin: auto; margin-top: 40px;">
			<input class="formCancelBtn" type="submit" name="cancel" value="cancel">
			<input class="formSubmitBtn" type="submit" name="update" value="update">
		</div>
	</form>

	<div style="clear: both; height: 50px; border-bottom: 2px solid #0000dd;"></div>
</body>
</html>
