<?php
function registerUser() {
    try {
        $conn = require_once __DIR__ . '/src/database.php'; // returns mysqli object or dies on failure

        if (!$conn) {
            throw new Exception("Database connection failed.");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $full_name  = $_POST['full_name'] ?? '';
            $user_name  = $_POST['user_name'] ?? '';
            $email      = $_POST['email'] ?? '';
            $phone      = $_POST['phone'] ?? '';
            $whatsapp   = $_POST['whatsapp'] ?? '';
            $address    = $_POST['address'] ?? '';
            $password   = $_POST['password'] ?? '';
            $imageName  = 'testImage';

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare($conn, "INSERT INTO users 
                (full_name, user_name, email, phone, whatsapp, address, password, user_image) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Statement preparation failed: " . mysqli_error($conn));
            }
            mysqli_stmt_bind_param($stmt, "ssssssss", 
                $full_name, $user_name, $email, $phone, $whatsapp, $address, $hashedPassword, $imageName);

            mysqli_stmt_execute($stmt);

            setSessionMessage("✅ Registration successful!", "success");

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            redirect();
        }
    } catch (mysqli_sql_exception $e) {
        setSessionMessage("❌ Error: " . $e->getMessage(), "fail");
        redirect();
    }
}

function setSessionMessage($message, $status) {
    session_start();
    $_SESSION['message'] = $message;
    $_SESSION['status'] = $status;
}

function redirect() {
    header("Location: index.php");
    exit;
}
?>
