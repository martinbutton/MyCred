<?PHP
/*
 * MyCred: User Registration and Authentication program.
 * Frontend Callers.  M.Button
 */

include "dbControl.php";
$dbConnect=array("host"=>"localhost","database"=>"MyCred","user"=>"MyCredApp","password"=>"password");

/* Register a new user */
function regUser() {
	global $formData, $dbConnect;

	// Hash Users password ready for db storage
	$formData['password']=hashPass($formData['password']);

	// Connect to database
	$dbAccess=new dbControl($dbConnect['host'],$dbConnect['database'],$dbConnect['user'],$dbConnect['password']);
	if ($dbAccess->regUserDb()) { echo "DB Write Good!  "; }
	$dbAccess->closeDb();

	echo "Db write attempt made!";
}

/* Hash Users Password */
function hashPass($password) {
	return password_hash($password,PASSWORD_DEFAULT);
}
?>
