<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'user_registration');


define('UPLOAD_DIR', 'assets/images/uploads/');
define('MAX_FILE_SIZE', 2 * 1024 * 1024); // 2MB
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);


define('WHATSAPP_API_URL', 'https://whatsapp-number-validator3.p.rapidapi.com/check');
define('WHATSAPP_API_KEY', 'your-rapidapi-key'); // Replace with the actual one


session_start();
?>
