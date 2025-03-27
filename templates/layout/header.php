<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Navigation Bar</title>
        <link rel="stylesheet" href="../../public/css/global.css">
        <link rel="stylesheet" href="../../public/css/header.css">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav>
            <div class="container justify-center items-center">
                <a class="logo" href="#"><i class="fa-solid fa-a fa-2xl"></i></a>

                <button class="nav-toggle" onclick="toggleNav()">Menu</button>

                <ul class="nav-list-ul">
                    <li class="close-btn">
                        <button onclick="toggleNav()">Close</button>
                    </li>
                    <li class="nav p-10 nav-link">
                        <a href="#">Home</a>
                    </li>
                    <li class="nav p-10 nav-link">
                        <a href="#">-----</a>
                    </li>
                    <li class="nav p-10 nav-link">
                        <a href="#">-----</a>
                    </li>
                    <li class="nav p-10 nav-link">
                        <a href="#">------</a>
                    </li>
                    <li class="nav p-10 nav-link">
                        <a href="#">------</a>
                    </li>
                </ul>
            </div>
        </nav>

        <script src="../../public/js/header.js"></script>
    </body>
</html>