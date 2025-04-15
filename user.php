<?php
function registerUser() {
    session_start();

    // Database configuration
    $host = "localhost";
    $dbname = "my_project";
    $username = "root";
    $password = "";

    try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = new mysqli($host, $username, $password, $dbname);
        $conn->set_charset("utf8mb4");

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Collect and sanitize inputs using real_escape_string
            $full_name  = $_POST['full_name'] ;
            $user_name  = $_POST['user_name'] ;
            $email      = $_POST['email'] ;
            $phone      = $_POST['phone'] ;
            $whatsapp   = $_POST['whatsapp'] ;
            $address    = $_POST['address'] ;
            $password   = $_POST['password'] ;
            // $confirmPassword = $_POST['confirm_password'] ;


            // File upload handling
            $imageName = 'testImage';
        

            // Insert data
            $stmt = $conn->prepare("INSERT INTO users (full_name, user_name, email, phone, whatsapp, address, password, user_image)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $full_name, $user_name, $email, $phone, $whatsapp, $address,$password, $imageName);
            $executeResult = $stmt->execute();

            // Check if execution was successful
            if ($executeResult) {
                setSessionMessage('✅ Registration successful!', 'success');
            } else {
                setSessionMessage('❌ Registration failed. Error: ' . $stmt->error, 'fail');
            }

            $stmt->close();
            $conn->close();
            redirect();
        }

    } catch (mysqli_sql_exception $e) {
        setSessionMessage('❌ Error: ' . $e->getMessage(), 'fail');
        redirect();
    }
}

function setSessionMessage($message, $status) {
    $_SESSION['message'] = $message;
    $_SESSION['status'] = $status;
}

function redirect() {
    header("Location: index.php");
    exit;
}
?>
