<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./public/css/global.css">
  <link rel="stylesheet" href="./public/css/header.css">
  <link rel="stylesheet" href="./public/css/sign-up.css">
  <link rel="stylesheet" href="./public/css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
  <title>Signup</title>
</head>
<body>
    <?php require __DIR__ . '/src/database/database.php';
      $connection = Database::getInstance();
      echo "<script>console.log('Connected successfully to DB server')</script>"; // Test connection
    ?>
  <?php include __DIR__ . '/templates/layout/header.php'; ?>
  <?php include __DIR__ . '/templates/sign-up.php'; ?>
  <?php include __DIR__ . '/templates/layout/footer.php'; ?>

  <script src="./public/js/header.js"></script>
  <script src="./public/js/validate.js" type="module"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
