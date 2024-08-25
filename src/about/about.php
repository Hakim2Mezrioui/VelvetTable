<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Document</title>
    <style>
        <?php 
            include "../header/header.css";
            include "../footer/footer.css";
            include "./about.css";
        ?>
    </style>
    <?php         
        $_SESSION["header_link"] = "../header/header.php";
        $_SESSION["footer_link"] = "../footer/footer.php";
        $_SESSION["orders_link"] = "../orders/orders.php";
        $_SESSION["reservation_link"] = "../reservation/reservation.php";
        $_SESSION["menu_link"] = "../menu/menu.php";
        $_SESSION["home_link"] = "../home/home.php";
        $_SESSION["about_link"] = $_SERVER["PHP_SELF"];
        $_SESSION["login_signup_link"] = "../logIn&signUp/login&signup.php";
        $_SESSION["active_page"] = "about";

        $_SESSION["logo"] = "../../assets/logo.png";
        $_SESSION["menu_icon"] = "../../assets/menu.png";
        $_SESSION["facebook_icon"] = "../../assets/facebook.png";
        $_SESSION["instagram_icon"] = "../../assets/instagram.png";
    ?>
</head>
<body></body>
    <?php
        include "../header/header.php";
    ?>


    <div class="background">
        <div class="img1"></div>
        <div class="white"></div>
        <div class="img2"></div>

        <div style="min-width: 900px" class="white2 d-flex w-50 m-auto gap-5">
            <div class="w-50" >
                <img class="w-100 mt-5" src="../../assets/about_images/yelena_odintsova.jpg" alt="" data-aos="fade-right">
                <img class="w-100 mt-5" src="../../assets/about_images/dmitry.jpg" alt="" data-aos="fade-right">  
                <h3 class="mt-5" data-aos="fade-right">Finally</h3>
                <p data-aos="fade-right">
                    Whether you're seeking a romantic dinner for two, a celebratory gathering with friends, 
                    or a memorable dining experience for a special occasion, 
                    Velvet Table Restaurant is the perfect destination. 
                    Immerse yourself in the refined ambiance, 
                    savor the exquisite flavors, 
                    and create unforgettable memories at Velvet Table Restaurant.
                </p>              
            </div>
            <div class="w-50">
                <span>
                    <h3 class="mt-5" data-aos="fade-left">Dishes made with fresh products </h3>
                    <p class="" data-aos="fade-left">
                        Velvet Table Restaurant is a charming and elegant dining establishment
                        that offers a luxurious and sophisticated culinary experience.
                        Nestled in a cozy corner of the city, the restaurant is known for
                        its impeccable service, exquisite ambiance, and delectable cuisine.
                        <br>
                        <br>
                        Step into Velvet Table Restaurant and be greeted by a warm and inviting
                        atmosphere, adorned with plush velvet seating, soft lighting,
                        and tasteful decor. 
                        The restaurant's attention to detail creates a refined and intimate 
                        setting perfect for a romantic dinner, special celebration, 
                        or business gathering.
                        <br>
                        <br>
                        The menu at Velvet Table Restaurant showcases a fusion of 
                        contemporary and classic dishes, 
                        crafted with the finest ingredients and prepared by talented chefs. 
                        From succulent seafood and tender steaks to innovative vegetarian 
                        creations and indulgent desserts, 
                        each plate is a work of art that delights the palate.
                    </p>
                </span>
                <img class="w-100" src="../../assets/about_images/leeloo.jpg" alt="" data-aos="fade-left">
                <img class="w-100 mt-5" src="../../assets/about_images/the_lazy.jpg" alt="" data-aos="fade-left">
            </div>
        </div>

    </div>

    

    <div class="mainSection">
        <div>
            <h5>WELCOME TO VELVET TABLE</h5>
            <p>The Velvet Table restaurant opened its doors in the 90s;
                During all these years our staff works day and night for your comfort,
                because your comfort is our first objective; Our team tries
                throughout this period to provide you with all the news
                so that we can be up to date with you dear customers.
                Without forgetting, that in our restaurant we present
                animations which knows the presence of different artists.


                Welcome to our restaurant and we wish you a good time with us.</p>
        </div>
        <div>
            <img data-aos="fade-in" src="../../assets/about_images/banhMiSalad.jpg" alt="">
            <img data-aos="fade-in" src="../../assets/about_images/thaiRareBeefSalad.jpg" alt="">
            <img data-aos="fade-in" src="../../assets/about_images/freezerMeals.jpg" alt="">
        </div>
    </div>

    <?php
        include "../footer/footer.php";
    ?>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>