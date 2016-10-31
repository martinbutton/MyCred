<?PHP
session_start();
require "validate.php";
include "MyCred.php";
checkSession(); // Check for valid session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (array_key_exists("cancel", $_POST)) {
		header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/index.php");
	}
	if (array_key_exists("delete", $_POST)) {
		delAccount();
	}
}
?>

<!DOCTYPE html>
<html>
<!-- MyCred: User Registration and Authentication program.
	         Confirm Account Deletion.  M.Button             -->
<head>
	<title>My Credentials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MyCred.css">
</head>
<body>
	<div class="heading">My Credentials</div>
	<div style="text-align: center; margin-bottom: 10px;">
		<h3>Are you sure you wish to delete your account?</h3>
		This operation cannot be undone!<br>
		When you delete your account you will also be automatically logged out.<br>
		Do you wish to continue?<br>
	</div>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div style="width: 80%; margin: auto; margin-top: 20px;">
			<input class="formCancelBtn" type="submit" name="cancel" value="cancel">
			<input class="formSubmitBtn" type="submit" name="delete" value="continue">
		</div>
	</form>

	<div style="clear: both; height: 50px; border-bottom: 2px solid #0000dd;"></div>
</body>
</html>
