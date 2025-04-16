<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$config = require_once __DIR__ . '/../config/config.php';

$conn = new mysqli($config['host'], $config['user'], $config['password'], $config['database']);
$conn->set_charset("utf8mb4");

return $conn;