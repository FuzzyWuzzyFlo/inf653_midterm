<?php 
class Database {
  private $host;
  private $port;
  private $dbname;
  private $username;
  private $password;
  private $conn;

  public function __construct() {
    $this->host = getenv('DB_HOST') ?: 'localhost';
    $this->port = getenv('DB_PORT') ?: '5432';
    $this->dbname = getenv('DB_DATABASE') ?: 'quotesdb';
    $this->username = getenv('DB_USERNAME') ?: 'postgres';
    $this->password = getenv('DB_PASSWORD') ?: 'Bbldrizzy17!';
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
