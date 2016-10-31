<!DOCTYPE html>
<html>
<!-- MyCred: User Registration and Authentication program.
	         User Registration Form.  M.Button             -->
<head>
	<title>My Credentials</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MyCred.css">
	<?PHP require "validate.php"; include "MyCred.php";?>
</head>
<body>
	<?PHP
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (array_key_exists("cancel", $_POST)) {
			header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/login.php");
		}

		if (formValidate(FORM_REGISTER)) {
			regUser();
		}
	}

	/* Re-selects the choosen security question when form is reloaded */
	function optChecked($opt) {
		global $formData;

		if ($opt==$formData['secQ']) {
			echo "selected";
		}
	}
	?>

	<div class="heading">My Credentials</div>
	<div style="text-align: center; margin-bottom: 10px;">Please complete ALL fields of the registration for below:</div>
	<div style="text-align: center; margin-bottom: 10px;"><?PHP global $formError; echo $formError['message'];?></div>
	
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		Your Name:<br>
		<input class="typedInput" type="text" name="name" value="<?PHP echo $formData['name'];?>"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['name'];?></div>

		Email Address:<br>
		<input class="typedInput" type="email" name="email" value="<?PHP echo $formData['email'];?>"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['email'];?></div>

		Please enter your Email Address again:<br>
		<input class="typedInput" type="email" name="email2" value="<?PHP echo $formData['email2'];?>"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['email2'];?></div>

		Password:<br>
		<input class="typedInput" type="password" name="password"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['password'];?></div>

		Please enter your Password again:<br>
		<input class="typedInput" type="password" name="password2"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['password2'];?></div>

		Please select a security Question:<br>
		<select name="secQ">
			<option value="0" <?PHP optChecked(0);?>>Please select</option>
			<option value="1" <?PHP optChecked(1);?>>What is your mother maiden mame?</option>
			<option value="2" <?PHP optChecked(2);?>>What is the name of your first pet?</option>
			<option value="3" <?PHP optChecked(3);?>>What town were you born in?</option>
			<option value="4" <?PHP optChecked(4);?>>What is your favorite film?</option>
		</select><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['secQ'];?></div>

		Please enter in a short answer to your security question:<br>
		<input class="typedInput" type="text" name="secA" value="<?PHP echo $formData['secA'];?>"><br>
		<div class="errorMsg"><?PHP global $formError; echo $formError['secA'];?></div>

		<div style="width: 80%; margin: auto; margin-top: 20px;">
			<input class="formCancelBtn" type="submit" name="cancel" value="cancel">
			<input class="formSubmitBtn" type="submit" name="register" value="register">
		</div>
	</form>

	<div style="height: 70px; border-bottom: 2px solid #0000dd;"></div>
</body>
</html>
