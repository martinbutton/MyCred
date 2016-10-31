<?PHP
/*
 * MyCred: User Registration and Authentication program.
 * Frontend Callers.  M.Button
 */

include "dbControl.php";
$dbConnect=array("host"=>"localhost","database"=>"MyCred","user"=>"MyCredApp","password"=>"password");

$formData=Array("name"=>"",
	"email"=>"",
	"email2"=>"",
	"password"=>"",
	"password2"=>"",
	"secQ"=>0,
	"secA"=>"");

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
	$dbAccess=new dbControl($dbConnect['host'],$dbConnect['database'],$dbConnect['user'],$dbConnect['password']);

	// Check if user account exists and check password
	$sqlrecords=$dbAccess->checkPassword($formData['email']);
	if ($sqlrecords==null) {
		$formError['message']="Incorrect Username or Password!";
		$dbAccess->closeDb();
		return;
	}

	// Check user entry exists
	if (count($sqlrecords)==0) {
		return; // No email match found.
	}

	// Compare passwords
	foreach ($sqlrecords as $sqlvalue) {
		if (!password_verify($formData['password'],$sqlvalue['password'])) {
			$formError['message']="Incorrect Username or Password!";
			$dbAccess->closeDb();
			return;
		}
	}
	$dbAccess->closeDb();

	// Proceed to login page.
//	$_SESSION['email']=$formData['email'];
	$formError['message']=""; // Clear error message string
	echo "Proceeding to login!";
//	header("Location: http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/MyCred/index.php");
}

/* Hash Users Password */
function hashPass($password) {
	return password_hash($password,PASSWORD_DEFAULT);
}
?>
