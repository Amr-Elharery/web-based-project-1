<?php
class Database {
  private static $connection = null;

  private function __construct() {
    $config = require_once __DIR__ . "/../../config/config.php";
    self::$connection = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);

    if (self::$connection->connect_error) {
      die("Connection failed: " . self::$connection->connect_error);
    }
  }

  public static function getInstance() {
    if (self::$connection === null) {
      new Database();
    }
    return self::$connection;
  }
}
?>
