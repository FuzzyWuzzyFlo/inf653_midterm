<?php 
class Database {
  private $host;
  private $dbname;
  private $username;
  private $password;
  private $conn;

  public function __construct() {
    $this->host = getenv('DB_HOST'); // Remove the localhost fallback
    $this->port = '5432';
    $this->dbname = getenv('DB_DATABASE');
    $this->username = getenv('DB_USERNAME');
    $this->password = getenv('DB_PASSWORD');
}


  public function connect() {
    $this->conn = null;

    try {
      $this->conn = new PDO(
        "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}",
        $this->username,
        $this->password
      );
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;
  }
}
