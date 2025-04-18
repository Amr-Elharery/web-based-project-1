<?php
require_once __DIR__ . "/../database/database.php";

class User {
  private $conn;

  public function __construct() {
    $this->conn = Database::getInstance();
  }

  public function register($full_name, $user_name, $email, $phone, $whatsapp, $address, $password, $user_image) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
  
    $stmt = $this->conn->prepare("
      INSERT INTO users (full_name, user_name, email, phone, whatsapp_number, address, password, user_image)
      VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
  
    if (!$stmt) return false;
  
    $stmt->bind_param("ssssssss", $full_name, $user_name, $email, $phone, $whatsapp, $address, $hashedPassword, $user_image);
  
    $stmt->execute();
    return true;
  }
  

  public function login($email, $password) {
    $stmt = $this->conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    if (!$stmt) return false;

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        return [
          'id' => $user['id'],
          'full_name' => $user['full_name'],
          'email' => $email
        ];
      }
    }

    return false;
  }
  
  public function checkUserName($username) {
    $query = "SELECT user_name FROM users WHERE user_name = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    // print_r($result);
    if ($result->num_rows === 1) {
      return true;
    }
    return false;
  }
}
?>
