<?PHP
/*
 * MyCred: User Registration and Authentication program.
 * Validate Form Fields.  M.Button
 */

/* Error Array */
$formError=array("name"=>"",
	"email"=>"",
	"email2"=>"",
	"password"=>"",
	"password2"=>"",
	"secQ"=>"",
	"secA"=>"",
	"message"=>"");

/* Clean user input to ensure it is safe to use */
function clean_input($value) {
	$value=trim($value);
	$value=stripslashes($value);
	$value=htmlspecialchars($value);
	return $value;
}

/* Check if a valid email address has been entered */
function validEmail($email) {
	global $formError;

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		return false;
  	}
  	return true;
}

/* Check if a valid name has been entered */
function validText($name) {
	if (!preg_match("/^[a-zA-Z '!,.-]*$/",$name) || strlen($name)<1) {
  		return false;
	}
	return true;
}

/* Check for valid password meets requirements
 * - May contain letter and numbers
 * - Must contain at least 1 number and 1 letter
 * - May contain any of these characters: !@#$%
 * - Must be 8-30 characters
 */
function validPassword($password) {
	if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,30}$/', $password)) {
		return false;
	}
	return true;
}

function formReturnData() {
	global $formData;
	$formData['name']=clean_input($_POST['name']);
	$formData['email']=clean_input($_POST['email']);
	$formData['email2']=clean_input($_POST['email2']);
	$formData['password']=clean_input($_POST['password']);
	$formData['password2']=clean_input($_POST['password2']);
	$formData['secQ']=clean_input($_POST['secQ']);
	$formData['secA']=clean_input($_POST['secA']);
	// TODO: Only grab fields that exist.  Set other to "" depending on what form is being validated.
}

/* Validate Users Registration Form */
function regFormValidate() {
	// TODO: Select what data to select and validate against depending on what form is being validated.
	global $formError, $formData;
	$validForm=true;
	formReturnData();

	// Obtain and Clean form data
	$name=$formData['name'];
	$email=$formData['email'];
	$email2=$formData['email2'];
	$password=$formData['password'];
	$password2=$formData['password2'];
	$secQ=$formData['secQ'];
	$secA=$formData['secA'];

	// Validate Name
	if (!validText($name)) {
		$validForm=false;
 		$formError['name']="*Error: Please enter a valid name!";
	}

	// Valid Email Address Fields
	if (!validEmail($email)) {
		$validForm=false;
		$formError['email']="*Error: Invalid email address!";
	}
	if (!validEmail($email2)) {
		$validForm=false;
		$formError['email2']="*Error: Invalid email address!";
	}

	// Check Email Addresses Match
	if (strcmp($email,$email2)!=0) {
		$validForm=false;
		$formError['email2']="*Error: Email address does not match the first Email address you provided!";
	}

	// Check security question and answer has been provided
	if ($secQ==0) {
		$validForm=false;
		$formError['secQ']="*Error: Please select a security question from the above pull down menu! ";
	}
	if (!validText($secA)) {
		$validForm=false;
		$formError['secA']="*Error: Please provide an answer to your security question!";
	}

	// Check passwords are valid and match
	if (!validPassword($password)) {
		$validForm=false;
		$formError['password']="*Error: Password must be between 8-30 characters and should contain atleast one character and one number and may include the following characters <i>&quot;!@#$%&quot;</i>, please re-enter!";
	}
	if (!validPassword($password2)) {
		$validForm=false;
		$formError['password2']="*Error: Password must be between 8-30 characters and should contain atleast one character and one number and may include the following characters <i>&quot;!@#$%&quot;</i>, please re-enter!";
	}
	if (strcmp($password,$password2)!=0) {
		$validForm=false;
		$formError['password']="*Error: Passwords do not match, please re-enter!";
		$formError['password2']="*Error: Passwords do not match, please re-enter!";
	}

	return $validForm;
}
?>
