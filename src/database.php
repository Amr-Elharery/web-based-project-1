<?php

  $config = require_once __DIR__ . '/../config/config.php';
  
  try{
    $connection = mysqli_connect($config['host'], $config['user'], $config['password']);
  }
  catch(Exception $e){
    die("Connection failed: " . $e->getMessage());
  }

?>