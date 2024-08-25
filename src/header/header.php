<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <header class="gap-5">
        <div class="d-flex">
            <?php
                echo "<a href='http://localhost/hakim&salma/Hakim&Salma/src/home/home.php'><img class='me-5 logo' height='100' width='80' src=" . $_SESSION["logo"] . " /></a>";
            ?>
            <ul class="list">
                <li>
                    <a class="item-link <?php echo ($_SESSION["active_page"] === "home") ? "linkActive" : null ?>" href="<?php echo $_SESSION["home_link"] ?>">Home</a>
                </li>
                <li>
                    <a class="item-link <?php echo ($_SESSION["active_page"] === "menu") ? "linkActive" : null ?>" href="<?php echo $_SESSION["menu_link"] ?>">Menu</a>
                </li>
                <li>
                    <a class="item-link <?php echo ($_SESSION["active_page"] === "reservation") ? "linkActive" : null ?>" href="<?php echo $_SESSION["reservation_link"] ?>">Reservation</a>
                </li>
                <li>
                    <a class="item-link <?php echo ($_SESSION["active_page"] === "orders") ? "linkActive" : null ?>" href="<?php echo $_SESSION["orders_link"] ?>">Online Order</a>
                </li>
                <li>
                    <a class="item-link <?php echo ($_SESSION["active_page"] === "about") ? "linkActive" : null ?>" href="<?php echo $_SESSION["about_link"] ?>">About</a>
                </li>
            </ul>
            <button class="btn-menu">
                <?php
                    echo "<img src=" . $_SESSION["menu_icon"] . " width='50'/>";                
                ?>
            </button>
        </div>
        <div>
        <!-- <span class=""> -->
                <?php
                    if(isset($_COOKIE["user"])) {
                        echo "<button class='btn-signup' title='show your profil'>";
                            echo "<a style='text-decoration: none; color: black' href='http://localhost/hakim&salma/Hakim&Salma/src/profile/profile.php'>";
                                echo "<img class='profil' src='../../assets/user.png' width='30' alt=''>";
                            echo "</a>";
                        echo "</button>";
                        // echo "<button style='border: none; background: transparent;'>";
                        //     echo "Logout";
                        // echo "</button>";
                    } else {
                        echo "<a class='me-2 btn-cart' style='text-decoration: none; padding: .8em 2em; color: white' href='$_SESSION[login_signup_link]'>Login";
                            echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-box-arrow-in-left' viewBox='0 0 16 16'>";
                            echo "<path fill-rule='evenodd' d='M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z'/>";
                            echo "<path fill-rule='evenodd' d='M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z'/>";
                        echo "</a>";
                    }
                ?>
                <?php 
                ?>
        <!-- </span> -->
            
            
            
</svg>
        </div>
    </header>
</body>

</html>