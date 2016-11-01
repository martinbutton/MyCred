<?PHP
/*
 * MyCred: User Registration and Authentication program.
 *         Change Password Completion Page  M.Button
 */

// Start session and obtain backend functions
session_start();
require "validate.php";
include "MyCred.php";
checkSession(); // Check for valid session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (array_key_exists("okay", $_POST)) {
		header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/index.php");
	}
}
?>

<!DOCTYPE html>
<html>
<!-- Change Password Completion Page -->
<head>
	<title>My Credentials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MyCred.css">
</head>
<body>
	<div class="heading">My Credentials</div>
	<div style="text-align: center; margin-bottom: 10px;">
		<h3>Your password has been sucessfully change!</h3>
		When you next login, please use your new password.
	</div>

	<form method="GET" action="index.php">
		<div style="width: 80%; margin: auto;">
			<input type="submit" class="formSubmitBtn" style="float: none; display: block; margin: auto; margin-top: 30px;" name="okay" value="continue">
		</div>
	</form>

	<div style="height: 50px; border-bottom: 2px solid #0000dd;"></div>
</body>
</html>
