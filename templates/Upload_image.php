<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $targetDir = "uploads/"; // Folder where images will be stored
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ["jpg", "jpeg", "png", "gif", "webp"];
    $uploadSuccess = false;
    $message = "";

    // Check if the file is an allowed image type
    if (in_array($fileType, $allowedTypes)) {
        // Ensure uploads folder exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Move the uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $uploadSuccess = true;
            $message = "The file <strong>" . htmlspecialchars($fileName) . "</strong> has been uploaded successfully.";
        } else {
            $message = "Error: Failed to upload the file.";
        }
    } else {
        $message = "Error: Only JPG, JPEG, PNG, GIF, and WEBP files are allowed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="/Shawky/css/global.css">
    <link rel="stylesheet" href="/Shawky/css/upload_image.css">
    <link rel="stylesheet" href="/Shawky/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

    <div class="center-container">
        <h2>Upload an Image</h2>

        <!-- Display upload message -->
        <?php if (!empty($message)): ?>
            <p style="color: <?php echo $uploadSuccess ? 'green' : 'red'; ?>;">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>

        <!-- File Upload Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*" required>
            <button type="submit" name="submit">Upload</button>
        </form>

        <!-- Display uploaded image if successful -->
        <?php if (!empty($uploadSuccess)): ?>
            <h3>Uploaded Image:</h3>
            <img src="<?php echo $targetFilePath; ?>" alt="Uploaded Image">
        <?php endif; ?>
    </div>
    <!-- Footer -->
    <?php include __DIR__ . '/footer.php'; ?>    
</body>
</html>

