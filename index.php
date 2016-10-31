<?PHP
session_start();
require "MyCred.php";

// Check if session is valid.  If not, return to login screen
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
	header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/login.php");
}
?>

<!DOCTYPE html>
<html>
<!-- MyCred: User Registration and Authentication program.
	         User Registration Form.  M.Button             -->
<head>
	<title>My Credentials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MyCred.css">
</head>
<body>
	<?PHP
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (array_key_exists("signout", $_POST)) {
			signoutUser();
		}
	}
	?>

	<div class="heading">My Credentials</div>
	<div style="text-align: center; font-size: 24px; color: blue;">Welcome<br>
		<span style="font-size: 18px;"><?PHP echo $_SESSION['name'];?></span>
	</div>

	<div style="text-align: center; margin-bottom: 10px; margin-top: 20px;">Accounts Action Menu</div>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div style="margin: auto; width: 80%;">
			<input class="accountMenuBtn" type="submit" name="chgdetails" value="Change Details">
			<input class="accountMenuBtn" type="submit" name="chgpassword" value="Change Password">
			<input class="accountMenuBtn" type="submit" name="delaccount" value="Delete Account">
			<input class="accountMenuBtn" type="submit" name="signout" value="Signout">
		</div>
	</form>

	<div style="height: 50px; border-bottom: 2px solid #0000dd;"></div>
</body>
</html>
