<?PHP
/*
 * MyCred: User Registration and Authentication program.
 * Frontend Callers.  M.Button
 */

include "dbControl.php";
$dbConnect=array("host"=>"localhost","database"=>"MyCred","user"=>"MyCredApp","password"=>"password");

/* Register a new user */
function regUser() {
	global $formData, $formError, $dbConnect;

	// Hash Users password ready for db storage
	$formData['password']=hashPass($formData['password']);

	// Connect to database
	$dbAccess=new dbControl($dbConnect['host'],$dbConnect['database'],$dbConnect['user'],$dbConnect['password']);

	// Check if user account exists and if not, register user
	if (!$dbAccess->emailExists($formData['email'])) {
		// Attempt to register user
		if ($dbAccess->regUserDb()) {
			// Establish Session and login to Account Actions Menu
			$dbAccess->closeDb();
			$_SESSION['email']=$formData['email'];
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

/* Hash Users Password */
function hashPass($password) {
	return password_hash($password,PASSWORD_DEFAULT);
}
?>
