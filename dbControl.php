<?PHP
/*
 * MyCred: User Registration and Authentication program.
 * Database Routines.  M.Button
 */

class dbControl {
	// Object Field Variables
	private $server,$database,$username,$password;
	private $sqlconn;

	// Construct database connection
	public function __construct($server,$database,$username,$password) {
		$this->server=$server;
		$this->database=$database;
		$this->username=$username;
		$this->password=$password;
	
		// Attempt to establish connection
		try {
			$this->sqlconn=new PDO("mysql:host=" . $this->server . ";dbname=" . $this->database, $this->username, $this->password);
			$this->sqlconn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $this->sqlconn;
		}
		catch (PDOException $e) {
			return null;
		}
	}

	public function regUserDb(){
		global $formData;

		$email=$this->escQuotes($formData['email']);
		$password=$formData['password'];
		$name=$this->escQuotes($formData['name']);
		$secA=$this->escQuotes($formData['secA']);

		try {
			$sqlstm=$this->sqlconn->prepare("insert into accounts (email, password, name, secQ, secA)"
											. " values (:email, :password, :name, :secQ, :secA)");
			$sqlstm->bindParam(':email', $email);
			$sqlstm->bindParam(':password', $password);
			$sqlstm->bindParam(':name', $name);
			$sqlstm->bindParam(':secQ', $secQ);
			$sqlstm->bindParam(':secA', $secA);

			$sqlstm->execute();
			return true;
		}
		catch (PDOException $e) {
			return false;
		}
	}

	/* Close DB connection */
	public function closeDb() {
		$this->sqlconn=null;
	}

	public function escQuotes($data) {
		// Escape text for SQL storage by escaping single quote.
		return str_replace("'", "''", $data);
	}
}
?>
