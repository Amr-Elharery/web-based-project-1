<?php
require_once __DIR__ . '/../models/User.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $userName = trim($_POST['user_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $whatsapp = trim($_POST['whatsapp'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $userImage = $_FILES['user_image'] ?? null;

    validateForm($fullName, $userName, $email, $phone, $whatsapp, $address, $password, $confirmPassword, $userImage, $errors);

    if (empty($errors)) {
        $uploadDir = __DIR__ . '/../../public/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageFileName = uniqid() . '_' . basename($userImage['name']);
        $imagePath = $uploadDir . $imageFileName;

        if (!move_uploaded_file($userImage['tmp_name'], $imagePath)) {
            $errors[] = 'Failed to upload image.';
        } else {
            $userModel = new User();

            $relativeImagePath = '/uploads/' . $imageFileName;

            if ($userModel->register($fullName, $userName, $email, $phone, $whatsapp, $address, $password, $relativeImagePath)) {
                echo "success";
                exit;
            } else {
                $errors[] = 'Failed to register. Please try again.';
            }
        }
    }

    if (!empty($errors)) {
        echo implode("<br>", $errors);
    }

} else {
    echo "Error: Invalid request method.";
}


function validateForm($fullName, $userName, $email, $phone, $whatsapp, $address, $password, $confirmPassword, $userImage, &$errors) {
    if (empty($fullName)) {
        $errors[] = 'Full Name is required.';
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $fullName)) {
        $errors[] = 'Full Name should contain only letters and spaces.';
    }

    if (empty($userName)) {
        $errors[] = 'Username is required.';
    } elseif (strlen($userName) < 4 || strlen($userName) > 20) {
        $errors[] = 'Username must be between 4 and 20 characters.';
    }

    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($phone)) {
        $errors[] = 'Phone number is required.';
    } elseif (!preg_match('/^01[0-2]\d{1,8}$/', $phone)) {
        $errors[] = 'Phone number must be between 10 and 15 digits.';
    }

    if (empty($whatsapp)) {
        $errors[] = 'WhatsApp number is required.';
    } elseif (!preg_match('/^01[0-2]\d{1,8}$/', $whatsapp)) {
        $errors[] = 'WhatsApp number must be between 10 and 15 digits.';
    }

    if (empty($address)) {
        $errors[] = 'Address is required.';
    }

    if (empty($password)) {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 8 || !preg_match('/[0-9]/', $password) || !preg_match('/[\W]/', $password)) {
        $errors[] = 'Password must be at least 8 characters long and contain at least one number and one special character.';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match.';
    }

    if ($userImage && $userImage['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!in_array($userImage['type'], $allowedTypes)) {
            $errors[] = 'Profile picture must be a valid image (JPEG, PNG, GIF).';
        }
    } else {
        $errors[] = 'Profile picture is required.';
    }
}
?>
