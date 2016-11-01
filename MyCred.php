<?PHP
/*
 * MyCred: User Registration and Authentication program.
 *         Frontend Callers.  M.Button
 */

// Start session and obtain backend functions
session_start();
include "dbControl.php";

// CHANGE AS REQUIRED: DB Connection and Credentials
$dbConnect=array("host"=>"localhost","database"=>"MyCred","user"=>"MyCredApp","password"=>"password");

$formData=Array("name"=>"",
	"email"=>"",
	"email2"=>"",
	"password"=>"",
	"password2"=>"",
	"secQ"=>0,
	"secA"=>"");

/* Check if there is a valid session.  If not, return to login screen */
function checkSession() {
	// Check if session is valid.  If not, return to login screen
	if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
		header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/login.php");
	}
}

/* Register a new user */
function regUser() {
	global $formData, $formError, $dbConnect;

	// Hash Users password ready for db storage
	$formData['password']=hashPass($formData['password']);

	// Connect to database
	if (($dbAccess=new dbControl($dbConnect['host'],$dbConnect['database'],$dbConnect['user'],$dbConnect['password']))==null) {
		$formError['message']="Error connecting to database! Please try again.";
		return;
	}

	// Check if user account exists and if not, register user
	if (!$dbAccess->emailExists($formData['email'])) {
		// Attempt to login user
		if ($dbAccess->regUser()) {
			// Establish Session and login to Account Actions Menu
			$dbAccess->closeDb();
			$_SESSION['email']=$formData['email'];
			$_SESSION['name']=$formData['name'];
			$formError['message']=""; // Clear error message string
			header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/index.php");
		 }
		else {
			$formError['message']="Error creating new account! : Could not write to Database, please try again later.";
		}
	}
	else {
		$formError['message']="Account with the provide email address already exists!  Please try registering with a different email address.";
	}

	// Ensure db connection is closed.
	$dbAccess->closeDb();
}

/* Log a user in */
function loginUser() {
	global $formData, $formError, $dbConnect;

	// Check a valid allowed password has been entered
	$formData['password']=clean_input($_POST['password']);
	if (!validPassword($formData['password'])) {
		$formError['message']="Incorrect Username or Password!";
		return;
	}

	// Connect to database to check user exists and compare users password
	if (($dbAccess=new dbControl($dbConnect['host'],$dbConnect['database'],$dbConnect['user'],$dbConnect['password']))==null) {
		$formError['message']="Error connecting to database! Please try again.";
		return;
	}

	// Check if user account exists and check password
	$sqlrecords=$dbAccess->checkPassword($formData['email']);
	if ($sqlrecords==null) {
		$formError['message']="Incorrect Username or Password!";
		$dbAccess->closeDb();
		return;
	}

	// Check user entry exists
	if (count($sqlrecords)==0) {
		$formError['message']="Incorrect Username or Password!";
		$dbAccess->closeDb();
		return; // No email match found.
	}

	// Compare passwords
	if (!password_verify($formData['password'],$sqlrecords[0]['password'])) {
		$formError['message']="Incorrect Username or Password!";
		$dbAccess->closeDb();
		return;
	}

	// Proceed to login page.
	$dbAccess->closeDb();
	reset($sqlrecords);
	$_SESSION['email']=$sqlrecords[0]['email'];
	$_SESSION['name']=$sqlrecords[0]['name'];
	$formError['message']=""; // Clear error message string
	header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/index.php");
}

/* Change Users Password */
function chgPassword() {
	global $formData, $formError, $dbConnect;

	// Obtain old password value.
	$oldPassword=clean_input($_POST['oldPassword']);

	// Connect to database to check users old password is valid and to set the new password
	if (($dbAccess=new dbControl($dbConnect['host'],$dbConnect['database'],$dbConnect['user'],$dbConnect['password']))==null) {
		$formError['message']="Error connecting to database! Please try again.";
		return;
	}

	// Check if old password matches current password
	$sqlrecords=$dbAccess->checkPassword($_SESSION['email']);
	if ($sqlrecords==null) {
		$formError['message']="Error retrieving account details.  Please try again.";
		$dbAccess->closeDb();
		return;
	}

	// Check user entry exists
	if (count($sqlrecords)==0) {
		$formError['message']="Error retrieving account details.  Please try again.";
		$dbAccess->closeDb();
		return; // No email match found.
	}

	// Compare passwords
	reset($sqlrecords);
	if (!password_verify($oldPassword,$sqlrecords[0]['password'])) {
		$formError['message']="Your current password did not match the password stored on the server!";
		$dbAccess->closeDb();
		return;
	}

	// Hash the password
	$formData['password']=hashPass($formData['password']);

	// Change users password to their new password
	if (!$dbAccess->changePassword($_SESSION['email'], $formData['password'])) {
		$formError['message']="Error saving your new password on the server!  Please try again.";
		$dbAccess->closeDb();
		return;
	}

	$dbAccess->closeDb();
	header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/pwdConfirm.php");
}

/* Delete Account */
function delAccount() {
	global $dbConnect;

	// Connect to database so users account can be deleted from it
	if (($dbAccess=new dbControl($dbConnect['host'],$dbConnect['database'],$dbConnect['user'],$dbConnect['password']))==null) {
		$formError['message']="Error connecting to database! Please try again.";
		return;
	}

	// Delete user entry from database
	if (!$dbAccess->deleteUser($_SESSION['email'])) {
		$dbAccess->closeDb();
		header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/index.php");
	}
	else {
		// Account Successfully Deleted.  Destroy session and confirm account deletion
		$dbAccess->closeDb();
		session_unset();
		session_destroy();
		header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/delConfirm.php");
	}
}

/* Sign user out */
function signoutUser() {
	session_unset();
	session_destroy();
	header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/login.php");
}

/* Hash Users Password */
function hashPass($password) {
	return password_hash($password,PASSWORD_DEFAULT);
}
?>
