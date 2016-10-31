<?PHP
include "MyCred.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (array_key_exists("okay", $_POST)) {
		header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/login.php");
	}
}
?>

<!DOCTYPE html>
<html>
<!-- MyCred: User Registration and Authentication program.
	         Account Successfully Deleted.  M.Button             -->
<head>
	<title>My Credentials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MyCred.css">
</head>
<body>
	<div class="heading">My Credentials</div>
	<div style="text-align: center; margin-bottom: 10px;">
		<h3>Your account has been delete.</h3>
		Your have been logged out.<br>
		Please click continue to return to the login screen.<br>
	</div>

	<form method="GET" action="login.php">
		<div style="width: 80%; margin: auto;">
			<input type="submit" class="formSubmitBtn" style="float: none; display: block; margin: auto; margin-top: 30px;" name="okay" value="continue">
		</div>
	</form>

	<div style="height: 50px; border-bottom: 2px solid #0000dd;"></div>
</body>
</html>
