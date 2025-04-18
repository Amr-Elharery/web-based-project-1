<?php 
  require_once __DIR__ ."/../models/User.php";
  
  $userModel = new User();
  if (isset($_GET['username'])){
    $username = $_GET['username'];
  }
  
  if($userModel->checkUserName($username)){
    echo "invalid";
  }
  else{
    echo "valid";
  }
?>