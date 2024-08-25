<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php 
            include "../header/header.css";
            include "../footer/footer.css";
            include "./home.css";
        ?>
    </style>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <?php 
                $_SESSION["orders_link"] = "../orders/orders.php";
                $_SESSION["reservation_link"] = "../reservation/reservation.php";
                $_SESSION["menu_link"] = "../../src/menu/menu.php";        
                $_SESSION["home_link"] = $_SERVER["PHP_SELF"];
                $_SESSION["about_link"] = "../about/about.php";
                $_SESSION["login_signup_link"] = "../logIn&signUp/login&signup.php";
                $_SESSION["active_page"] = "home";
        
                $_SESSION["logo"] = "../../assets/logo.png";
                $_SESSION["menu_icon"] = "../../assets/menu(1).png";
                $_SESSION["facebook_icon"] = "../../assets/facebook.png";
                $_SESSION["instagram_icon"] = "../../assets/instagram.png";
    ?>
</head>
<body>
    <?php 
        include_once "../header/header.php";
    ?>

    <div>
        <?php 
            include "./slider/slider.php";
        ?>
    </div>
    
    <div class="features">
        <div class="card-features">
            <h3>Seafood risotto with saffron sauce</h3>
            <img height="450" src="../../assets/home_images/mainPlats/rissoto.jpg" data-aos="fade-right" data-aos-delay="50">
            <p>
                A refined and delicate dish, this risotto is prepared with a mixture of fresh seafood such as shrimp, 
                mussels and calamari. The rice is cooked slowly in an aromatic fish broth, 
                then it is embellished with a creamy saffron sauce, which gives it a beautiful golden yellow color
            </p>
            <a href="./mainPlatView/mainPlatView.php">Read More</a>
        </div>
        <div class="card-features">
            <h3>Filet Mignon with Red Wine Reduction</h3>
            <img height="450" src="../../assets/home_images/mainPlats/FiletMignon.jpg" data-aos="fade-in" data-aos-delay="50">
            <p>
                A succulent and juicy filet mignon steak cooked to perfection, 
                topped with a rich red wine reduction sauce. 
                Served with creamy mashed potatoes and sautéed garlic spinach.
            </p>
            <a href="./mainPlatView/mainPlatView.php">Read More</a>
        </div>
        <div class="card-features">
            <h3>Rack of lamb in herb crust with vegetables</h3>
            <img height="450" src="../../assets/home_images/mainPlats/agneau.jpeg" data-aos="fade-left" data-aos-delay="50">
            <p>
                Indulge in our exquisite Seafood Risotto at Velvet Table. 
                Combining fresh shrimp, mussels, and calamari, 
                this dish features slow-cooked rice in a fragrant fish broth. 
                Topped with a creamy saffron sauce, 
                it offers a delightful golden color and delicate flavors. 
                Experience the finest flavors of the sea in every bite.
            </p>
            <a href="./mainPlatView/mainPlatView.php">Read More</a>
        </div>
    </div>
    <span style="height: 0; display: flex; justify-content: center; color: white;">
        <h3>TEAM</h3>
    </span>
    <div class="equipe">
        <div class="presentationEquipe" data-aos="fade-in" data-aos-delay="50">
            <div class="employer">
                <img src="../../assets/home_images//equipe/chef_profile.jpg" alt="">
                <p>
                    A chef is a culinary professional who is highly skilled in the art of cooking and food preparation.
                    They are responsible for creating and executing recipes, designing.
                </p>
            </div> 
            <div class="employer">
                <img src="../../assets/home_images//equipe/chef2_profile.jpg" alt="">
                <p>
                    A chef is a culinary professional who is highly skilled in the art of cooking and food preparation.
                    They are responsible for creating and executing recipes, designing.
                </p>
            </div>
            <div class="employer">
                <img src="../../assets/home_images//equipe/employer_profile.jpg" alt="">
                <p>
                    A chef is a culinary professional who is highly skilled in the art of cooking and food preparation.
                    They are responsible for creating and executing recipes, designing.
                </p>
            </div> 
        </div>

        <div class="chefEquipe">
            <div class="presentationChefEquipe gap-5">
                <!-- <img class="wrapImage pb-3" src="../../assets/home_images/equipe/chef.jpg" alt=""> -->
                <p style="height: fit-content;">
                    <span class="d-flex align-items-center">

                        <img class="" src="../../assets/home_images/equipe/chef_2.jpg" alt="" data-aos="fade-right" data-aos-delay="50">
                        <span class="ps-5" data-aos="fade-left" data-aos-delay="50">
                            With a culinary career spanning over three decades,
                            Chef Pierre Dubois is a true maestro in the world of cuisine.
                            Renowned for his exceptional culinary skills and innovative creations,
                            Chef Dubois has delighted the palates of diners across the globe.

                            <br>
                            <br>
        
                            Born and raised in the picturesque countryside of France,
                            Chef Dubois developed a deep appreciation for fresh,
                            seasonal ingredients and traditional cooking techniques from an early age.
                            His passion for culinary arts led him to train under renowned chefs in Paris,
                            where he honed his skills and refined his unique culinary style.
                            
                            <br>
                            <br>
        
                            <!-- Chef Dubois' culinary philosophy revolves around the idea of combining
                            classic French techniques with global flavors and contemporary presentations. 
                            His dishes are a harmonious blend of bold flavors, exquisite textures,
                            and visually stunning presentations. 
                            With an unwavering commitment to using the finest ingredients, 
                            Chef Dubois creates dishes that not only tantalize the taste buds 
                            but also celebrate the beauty of nature's bounty. -->
                        </span>
                        
                    </span>

                    <span class="d-flex align-items-center" data-aos="fade-right">

                        <span class="pe-5">
                            
                            His meticulous attention to detail, dedication to culinary excellence, 
                            and artistic flair have earned him numerous accolades throughout his career. 
                            Chef Dubois has had the privilege of serving his culinary masterpieces 
                            at Michelin-starred restaurants, prestigious events, 
                            and even in the kitchens of esteemed dignitaries.
                            
                            <br>
                            <br>
                            
                            At Velvet Table, Chef Pierre Dubois brings his culinary prowess to create an 
                            extraordinary dining experience for our guests. Whether it's a delectable seafood extravaganza,
                            a perfectly cooked steak, or a mesmerizing dessert, 
                            Chef Dubois' creations are sure to transport you on a gastronomic journey like no other.
                            
                            <br>
                            <br>
                            
                            <!-- Prepare to indulge in a culinary symphony orchestrated by Chef Pierre Dubois, 
                            where every bite is a sensory delight and every dish tells a story. 
                            Join us at Velvet Table and experience the magic of Chef Dubois' culinary artistry firsthand. 
                            Bon appétit! -->
                            
                        </span>
                        <img class="" src="../../assets/home_images/equipe/chef_3.jpg" alt="" data-aos="fade-left">                        

                    </span>
                </p>
            </div>
        </div>
    </div>

    <?php 
        include_once "../footer/footer.php";
    ?>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>