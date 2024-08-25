<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/header/header.css">
    <link rel="stylesheet" href="./src/footer/footer.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <title>Document</title>
    <?php
        $_SESSION["header_link"] = "./src/header/header.php";
        $_SESSION["footer_link"] = "./src/footer/footer.php";
        $_SESSION["orders_link"] = "./src/orders/orders.php";
        $_SESSION["reservation_link"] = "./src/reservation/reservation.php";
        $_SESSION["menu_link"] = "./src/menu/menu.php";        
        $_SESSION["home_link"] = "./src/home/home.php";
        $_SESSION["about_link"] = "./src/about/about.php";        
        $_SESSION["login_signup_link"] = "./src/logIn&signUp/login&signup.php";
        $_SESSION["active_page"] = "home";

        $_SESSION["logo"] = "./assets/logo.png";
        $_SESSION["menu_icon"] = "./assets/menu.png";
        $_SESSION["facebook_icon"] = "./assets/facebook.png";
        $_SESSION["instagram_icon"] = "./assets/instagram.png";
    ?>
</head>

<body>
    <?php
        include_once ($_SESSION["header_link"]);

        header("location:./src/home/home.php");

        require_once($_SESSION["footer_link"]);
    ?>
</body>

</html>