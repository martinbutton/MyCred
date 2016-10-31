<?PHP
/*
 * MyCred: User Registration and Authentication program.
 * Validate Form Fields.  M.Button
 */

/* Constants used to select what type of validation occurs */
define("FORM_LOGIN",0);
define("FORM_REGISTER",1);
define("FORM_CHGDETAILS",2);
define("FORM_CHANGEPWD",3);
define("FORM_RESETPWD",4);

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

function cleanFormData() {
	global $formData;
	$formData['name']="";
	$formData['email']="";
	$formData['email2']="";
	$formData['password']="";
	$formData['password2']="";
	$formData['secQ']="";
	$formData['secA']="";
}

/* Validate Users Registration Form */
function formValidate($formType) {
	// TODO: Select what data to select and validate against depending on what form is being validated.
	global $formError, $formData;
	$validForm=true;

	// Clean form data buffer
	cleanFormData();

	// Validate Name
	if ($formType===FORM_REGISTER || $formType===FORM_CHGDETAILS) {
		$formData['name']=clean_input($_POST['name']);
		
		if (!validText($formData['name'])) {
			$validForm=false;
 			$formError['name']="*Error: Please enter a valid name!";
		}
	}

	// Valid Email Address Field
	if ($formType===FORM_LOGIN || $formType===FORM_REGISTER || $formType===FORM_RESETPWD) {
		$formData['email']=clean_input($_POST['email']);

		if (!validEmail($formData['email'])) {
			$validForm=false;
			$formError['email']="*Error: Invalid email address!";
		}
	}

	// Validate Secondary Confirmation Email Address Field
	if ($formType===FORM_REGISTER || $formType===FORM_RESETPWD) {
		$formData['email2']=clean_input($_POST['email2']);

		if (!validEmail($formData['email2'])) {
			$validForm=false;
			$formError['email2']="*Error: Invalid email address!";
		}

		// Check Email Addresses Match
		if (strcmp($formData['email'],$formData['email2'])!=0) {
			$validForm=false;
			$formError['email2']="*Error: Email address does not match the first Email address you provided!";
		}
	}

	// Check security question and answer has been provided
	if ($formType===FORM_REGISTER || $formType===FORM_CHGDETAILS) {
		$formData['secQ']=(int)clean_input($_POST['secQ']);

		if ($formData['secQ']==0) {
			$validForm=false;
			$formError['secQ']="*Error: Please select a security question from the above pull down menu! ";
		}
	}

	if ($formType===FORM_REGISTER || $formType===FORM_CHGDETAILS || $formType===FORM_RESETPWD) {
		$formData['secA']=clean_input($_POST['secA']);

		if (!validText($formData['secA'])) {
			$validForm=false;
			$formError['secA']="*Error: Please provide an answer to your security question!";
		}
	}

	// Check passwords are valid and match
	if ($formType===FORM_REGISTER || $formType===FORM_CHANGEPWD || $formType===FORM_RESETPWD) {
		$formData['password']=clean_input($_POST['password']);
		$formData['password2']=clean_input($_POST['password2']);

		if (!validPassword($formData['password'])) {
			$validForm=false;
			$formError['password']="*Error: Password must be between 8-30 characters and should contain atleast one character and one number and may include the following characters <i>&quot;!@#$%&quot;</i>, please re-enter!";
		}
		if (!validPassword($formData['password2'])) {
			$validForm=false;
			$formError['password2']="*Error: Password must be between 8-30 characters and should contain atleast one character and one number and may include the following characters <i>&quot;!@#$%&quot;</i>, please re-enter!";
		}
		if (strcmp($formData['password'],$formData['password2'])!=0) {
			$validForm=false;
			$formError['password']="*Error: Passwords do not match, please re-enter!";
			$formError['password2']="*Error: Passwords do not match, please re-enter!";
		}
	}

	return $validForm;
}
?>
