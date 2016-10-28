<!DOCTYPE html>
<html>
<head>
	<title>My Credentials</title>
	<link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="MyCred.css">
</head>
<body>
	<div class="heading">My Credentials</div>
	<div style="text-align: center; margin-bottom: 20px;">Please complete ALL fields of the registration for below:</div>
	
	<form>
		Your Name:<br>
		<input class="typedInput" type="text" name="fullName"><br>
		<div class="errorMsg"></div>

		Email Address:<br>
		<input class="typedInput" type="email" name="email"><br>
		<div class="errorMsg"></div>

		Please enter your Email Address again:<br>
		<input class="typedInput" type="email" name="email2"><br>
		<div class="errorMsg"></div>

		Password:<br>
		<input class="typedInput" type="password" name="password"><br>
		<div class="errorMsg"></div>

		Please enter your Password again:<br>
		<input class="typedInput" type="password" name="password2"><br>
		<div class="errorMsg"></div>

		Please select a security Question:<br>
		<select name="secQ">
			<option value="0">Please select</option>
			<option value="1">What is your mother maiden mame?</option>
			<option value="2">What is the name of your first pet?</option>
			<option value="3">What town were you born in?</option>
			<option value="4">What is your favorite film?</option>
		</select><br>
		<div class="errorMsg"></div>

		Please enter in an short answer to your security question:<br>
		<input class="typedInput" type="text" name="secA"><br>
		<div class="errorMsg"></div>

		<div style="width: 80%; margin: auto; margin-top: 20px;">
			<input class="formCancelBtn" type="button" name="cancel" value="cancel">
			<input class="formSubmitBtn" type="submit" name="submit" value="register">
		</div>
	</form>

	<div style="height: 70px; border-bottom: 2px solid #0000dd;"></div>
</body>
</html>
