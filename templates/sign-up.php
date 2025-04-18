<?php


require __DIR__ . '/../src/database.php'; 

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
    } elseif (!preg_match('/^[0-9]{10,15}$/', $phone)) {
        $errors[] = 'Phone number must be between 10 and 15 digits.';
    }

    if (empty($whatsapp)) {
        $errors[] = 'WhatsApp number is required.';
    } elseif (!preg_match('/^[0-9]{10,15}$/', $whatsapp)) {
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
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($userImage['type'], $allowedTypes)) {
            $errors[] = 'Profile picture must be a valid image (JPEG, PNG, GIF).';
        }
    } else {
        $errors[] = 'Profile picture is required.';
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $imagePath = '/uploads/' . basename($userImage['name']);
        move_uploaded_file($userImage['tmp_name'], __DIR__ . '/../public' . $imagePath);

        $stmt = $pdo->prepare('INSERT INTO users (full_name, user_name, email, phone, whatsapp, address, password, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        if ($stmt->execute([$fullName, $userName, $email, $phone, $whatsapp, $address, $hashedPassword, $imagePath])) {
            $successMessage = 'Registration successful!';
        } else {
            $errors[] = 'Failed to register. Please try again.';
        }
    }
}
?>

<div class="container">
    <form id="registrationForm" class="signup-form shadow rad-6" action="" method="POST" enctype="multipart/form-data">
        <h1>Create Account</h1>

        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li style="color: red;"><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php elseif (!empty($successMessage)): ?>
            <p style="color: green;"><?php echo htmlspecialchars($successMessage); ?></p>
        <?php endif; ?>
    
        <div class="flex flex-col-mobile">
            <div class="form-group flex-1">
                <label for="full_name">Full Name<span class="c-red fs-14">*</span> : </label>
                <input class="form-control" type="text" id="full_name" name="full_name" placeholder="Enter your full name" title="Full name should contain only letters and spaces">
                <span class="error-message fs-14" id="full_name_error"></span>
            </div>

            <div class="form-group flex-1">
                <label for="user_name">Username<span class="c-red fs-14">*</span> : </label>
                <input class="form-control" type="text" id="user_name" name="user_name" placeholder="Enter your username" minlength="4" maxlength="20">
                <span class="error-message fs-14" id="user_name_error"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email<span class="c-red fs-14">*</span> : </label>
            <input class="form-control" type="email" id="email" name="email" placeholder="Enter your email">
            <span class="error-message fs-14" id="user_name_error"></span>
        </div>

        <div class="flex flex-col-mobile">
            <div class="form-group flex-1">
                <label for="phone">Phone Number<span class="c-red fs-14">*</span> : </label>
                <input class="form-control" type="tel" id="phone" name="phone" placeholder="Enter your phone number" pattern="[0-9]{10,15}">
                <span class="error-message fs-14" id="phone_error"></span>
            </div>

            <div class="form-group flex-1">
                <label for="whatsapp">WhatsApp Number<span class="c-red fs-14">*</span> : </label>
                <input class="form-control" type="tel" id="whatsapp" name="whatsapp" placeholder="Enter your WhatsApp number" pattern="[0-9]{10,15}">
                <span class="error-message fs-14" id="whatsapp_error"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="address">Address<span class="c-red fs-14">*</span> : </label>
            <textarea class="form-control" id="address" name="address" placeholder="Enter your full address" rows="5"></textarea>
            <span class="error-message fs-14" id="address_error"></span>
        </div>

        <div class="form-group">
            <label for="password">Password<span class="c-red fs-14">*</span> : </label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Enter your password" title="Must contain at least 8 characters, one number, and one special character">
            <div class="password-requirements fs-14 c-grey">
                Password must be at least 8 characters long and contain at least one number and one special character
            </div>
            <span class="error-message fs-14" id="password_error"></span>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password<span class="c-red fs-14">*</span> : </label>
            <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
            <span class="error-message fs-14" id="confirm_password_error"></span>
        </div>

        <div class="form-group">
            <div class="flex items-center">
                <label for="user_image">Profile Picture<span class="c-red fs-14">*</span> : </label>
                <label for="user_image" class="btn btn-effect c-white w-fit">Choose File</label>
            </div>
            <span class="error-message fs-14" id="user_image_error"></span>
            <input class="form-control" type="file" id="user_image" name="user_image" accept="image/*" hidden>
        </div>

        <div class="form-group">
            <button class="btn btn-effect c-white w-full fs-22" type="submit">Register</button>
        </div>
    </form>
</div>