<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <style>
        <?php 
            include "./orders.css";
        ?>
        <?php
            include "../header/header.css";
        ?>
        <?php
            include "../footer/footer.css";
        ?>
    </style>
    <?php
        $_SESSION["orders_link"] = $_SERVER["PHP_SELF"];
        $_SESSION["reservation_link"] = "../reservation/reservation.php";
        $_SESSION["menu_link"] = "../menu/menu.php";
        $_SESSION["home_link"] = "../home/home.php";        
        $_SESSION["about_link"] = "../about/about.php";
        $_SESSION["login_signup_link"] = "../logIn&signUp/login&signup.php";
        $_SESSION["active_page"] = "orders";

        $_SESSION["logo"] = "../../assets/logo.png";
        $_SESSION["menu_icon"] = "../../assets/menu.png";
        $_SESSION["facebook_icon"] = "../../assets/facebook.png";
        $_SESSION["instagram_icon"] = "../../assets/instagram.png";
    ?>
</head>

<body class="bodyOrder">
    
    <?php 
        include "../../connection.php";
        class Member {
            public $name;
            public $email;
    
            public function __construct($name, $email) {
                $this->$name = $name;
                $this->$email = $email;
            }
        }

        $_SESSION["demands"] = 0;
        
        try {
            if(isset($_COOKIE["user"])) {
                include "../helpers/getUser.php";

                $query = "SELECT count(*) FROM cart where id_member = :id_member";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id_member", $GLOBALS["id_member"]);
                $stmt->execute();
                $demands = $stmt->fetch();

                $_SESSION["demands"] = $demands[0];

            } else {
                $_SESSION["demands"] = 0;
                echo "
                    <script>
                        Swal.fire({
                            title: 'you must register first',
                            text: 'to request our products',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Ok',
                            cancelButtonText: 'Not now'
                        }).then((result) => {
                            // Perform an action based on the user's choice
                            if (result.isConfirmed) {
                                // Code to execute if confirmed
                                window.location.href = '../logIn&signUp/login&signup.php';
                            } else {
                                // Code to execute if cancelled
                            }
                        });
                    </script>
                ";
            }
            
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
                  
        include "../helpers/getUser.php";

        if(isset($_POST["addToMyCommands"])) { 
            $specialRequest = $_POST["specialRequest"];
            $id_menu = $_POST["id_menu"];
            $quantite = $_POST["quantite"];

            if($GLOBALS["id_member"]) {
                try{
                    $query = "INSERT INTO cart(id_menu, special_request, quantite, id_member) VALUES(:id_menu, :special_request, :quantite, :id_member)";
            
                    $stmt = $pdo->prepare($query);

                    $stmt->bindParam(":quantite", $quantite);
                    $stmt->bindParam(":id_menu", $id_menu);
                    $stmt->bindParam(":special_request", $specialRequest);
                    $stmt->bindParam(":id_member", $GLOBALS["id_member"]);
            
                    $stmt->execute();
    
                    echo "
                        <script>
                            Swal.fire({
                                title: 'Your demand is registered',
                                text: 'Check your cart',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Ok',
                                cancelButtonText: 'Cancel'
                            }).then((result) => {
                                // Perform an action based on the user's choice
                                if (result.isConfirmed) {
                                    // Code to execute if confirmed
                                } else {
                                    // Code to execute if cancelled
                                }
                            });
                        </script>
                    ";

                    $_SESSION["demands"] += 1;
                } 
                catch(PDOException $e) {
                    echo $e->getMessage();
                    echo "
                    <script>
                        Swal.fire({
                            title: 'Your demand is registered',
                            text: 'Check your cart',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            // Perform an action based on the user's choice
                            if (result.isConfirmed) {
                                // Code to execute if confirmed
                            } else {
                                // Code to execute if cancelled
                            }
                        });
                    </script>
                ";
                }
            }

        } else {
        //     echo "
        //     <script>
        //         Swal.fire({
        //             title: 'you must register first',
        //             text: 'to request our products',
        //             icon: 'success',
        //             showCancelButton: true,
        //             confirmButtonText: 'Ok',
        //             cancelButtonText: 'Not now'
        //         }).then((result) => {
        //             // Perform an action based on the user's choice
        //             if (result.isConfirmed) {
        //                 // Code to execute if confirmed
        //                 window.location.href = '../logIn&signUp/login&signup.php';
        //             } else {
        //                 // Code to execute if cancelled
        //             }
        //         });
        //     </script>
        // ";
        }
    ?>
    <?php require_once "../header/header.php"; ?>
    
    <div id="yourCart" style="display: none;">
        <?php include_once "../cart/cart.php"; ?>
    </div>
    
    
    <div class="confirmation hideConfirmation">
        <form method="post">
            <button onclick="hideCommand()" type="button" style="border: none; background-color: rgb(176, 36, 52); color: white; position: absolute; top: -.7em; left: -0.7em">X</button>
            <div class="form-group">
                <h3 name="title" id="title">Title</h3>
                <p name="description">This is an item on your menu. Add a short description.</p>
                <p name="price">20</p>
                <input type="hidden" name="id_menu">
            </div>
            <div class="form-group">
                <label>Special Requests</label>
                <textarea required name="specialRequest" class="form-control"></textarea>
            </div>
            <div class="form-group d-flex justify-content-between">
                <span>
                    <button onclick="decrementQuantity()" type="button">-</button>
                        <input id="quantity" name="quantite" type="number" min="1" max="5" value="1">
                    <button onclick="incrementQuantity()" type="button">+</button>
                </span>
                <button type="submit" name="addToMyCommands" class="addbtn">Add to my commands</button>
            </div>
        </form>
    </div>

        <div>
            <span class="title">
                <h2>Make Your Order</h2>
            </span>

            <div class="imgCover"></div>

            <div class="platEntree">
                <div class="d-flex justify-content-between">
                    <div>
                        <a data-filter=".food-item" class="active" href="#">All</a>
                        <a data-filter=".appetizer" class="appetizer" href="#">Appetizer</a>
                        <a data-filter=".main-course" class="main-course" href="#">Main Course</a>
                        <a data-filter=".dessert" class="dessert" href="#">Dessert</a>
                        <a data-filter=".drinks" class="drinks" href="#">Drinks</a>
                    </div>
                    <div>
                        <button class="btn-cart" onclick="afficherCart('<?php echo json_encode(isset($_COOKIE['user'])) ?>')">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2-fill" viewBox="0 0 16 16">
                                    <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383L5.93 1.757zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1z"/>
                                </svg>
                            </span>
                            <span>Your Cart</span>
                            <span class="badge bg-danger"><?php echo $_SESSION["demands"] ?></span> 
                        </button>
                    </div>
                </div>
                <hr>
            </div>

            <div class="food-items food-container row justify-content-center">
                    <?php 
                        $query = "SELECT * FROM menu WHERE category = :category";
                        $category = "Appetizer";

                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":category", $category);
                        $stmt->execute();

                        if($stmt->rowCount() > 0) {
                            while($row = $stmt->fetch()) {
                                echo "<div class='appetizer food-item col-md-5'>";
                                    echo "<input type='hidden' value='". $row["id_menu"] ."'/>";
                                    echo "<img width='200' height='150' title='". $row["title"] ."' src='../../assets/MENU/". $category."/". $row["path_image"] . $row["ext_image"] ."' alt=''>";
                                    echo "<span>";
                                        echo "<h3 class='title' title='". $row["title"] ."'>". $row["title"] ."</h3>";
                                        echo "<h5 class='description'>". $row["description"] ."</h5>";
                                        echo "<h3> $". $row["price"] ."</h3>";
                                        echo "<ul class = 'rating'>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'far fa-star'></i></li>";
                                        echo "</ul>";
                                    echo "</span>";
                                    echo "<span class='d-flex direction-column'>";
                                    echo "<button onclick='commander(". json_encode($row["title"]) .", ". json_encode($row["description"]) .", ". json_encode($row["price"]) .", ". json_encode($row["id_menu"]) .", ". json_encode(isset($_COOKIE["user"])) .")' class='btn-cart' style='position: absolute; right: 1.5em; bottom: 1.5em;'><i class='fas fa-cart-plus'></i></button>";
                                    echo "</span>";
                                echo "</div>";
                            }
                        }
                    ?>
                    <?php 
                        $query = "SELECT * FROM menu WHERE category = :category";
                        $category = "Main course";

                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":category", $category);
                        $stmt->execute();

                        if($stmt->rowCount() > 0) {
                            while($row = $stmt->fetch()) {
                                echo "<div class='main-course food-item col-md-5 '>";
                                echo "<img width='200' height='150' title='". $row["title"] ."' src='../../assets/MENU/". $category."/". $row["path_image"] . $row["ext_image"] ."' alt=''>";
                                    echo "<span>";
                                        echo "<h3 class='title' title='". $row["title"] ."'>". $row["title"] ."</h3>";
                                        echo "<h5 class='description'>". $row["description"] ."</h5>";
                                        echo "<h3> $". $row["price"] ."</h3>";
                                        echo "<ul class = 'rating'>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'far fa-star'></i></li>";
                                        echo "</ul>";
                                    echo "</span>";
                                    echo "<span class='d-flex direction-column'>";
                                        echo "<button onclick='commander(". json_encode($row["title"]) .", ". json_encode($row["description"]) .", ". json_encode($row["price"]) .", ". json_encode($row["id_menu"]) .", ". json_encode(isset($_COOKIE["user"])) .")' class='btn-cart' style='position: absolute; right: 1.5em; bottom: 1.5em;'><i class='fas fa-cart-plus'></i></button>";
                                    echo "</span>";
                                echo "</div>";
                            }
                        }
                    ?>
                    <?php 
                        $query = "SELECT * FROM menu WHERE category = :category";
                        $category = "Dessert";

                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":category", $category);
                        $stmt->execute();

                        if($stmt->rowCount() > 0) {
                            while($row = $stmt->fetch()) {
                                echo "<div class='dessert food-item col-md-5'>";
                                echo "<img width='200' height='150' title='". $row["title"] ."' src='../../assets/MENU/". $category."/". $row["path_image"] . $row["ext_image"] ."' alt=''>";
                                    echo "<span>";
                                        echo "<h3 class='title' title='". $row["title"] ."'>". $row["title"] ."</h3>";
                                        echo "<h5 class='description'>". $row["description"] ."</h5>";
                                        echo "<h3> $". $row["price"] ."</h3>";
                                        echo "<ul class = 'rating'>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'far fa-star'></i></li>";
                                        echo "</ul>";
                                    echo "</span>";
                                    echo "<span class='d-flex direction-column'>";
                                        echo "<button onclick='commander(". json_encode($row["title"]) .", ". json_encode($row["description"]) .", ". json_encode($row["price"]) .", ". json_encode($row["id_menu"]) .", ". json_encode(isset($_COOKIE["user"])) .")' class='btn-cart' style='position: absolute; right: 1.5em; bottom: 1.5em;'><i class='fas fa-cart-plus'></i></button>";
                                    echo "</span>";
                                echo "</div>";
                            }
                        }
                    ?>
                    <?php 
                        $query = "SELECT * FROM menu WHERE category = :category";
                        $category = "Drinks";

                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":category", $category);
                        $stmt->execute();

                        if($stmt->rowCount() > 0) {
                            while($row = $stmt->fetch()) {
                                echo "<div class='drinks food-item col-md-5 '>";
                                echo "<img width='200' height='150' title='". $row["title"] ."' src='../../assets/MENU/". $category."/". $row["path_image"] . $row["ext_image"] ."' alt=''>";
                                    echo "<span>";
                                        echo "<h3 class='title' title='". $row["title"] ."'>". $row["title"] ."</h3>";
                                        echo "<h5 class='description'>". $row["description"] ."</h5>";
                                        echo "<h3> $". $row["price"] ."</h3>";
                                        echo "<ul class = 'rating'>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'fas fa-star'></i></li>";
                                            echo "<li><i class = 'far fa-star'></i></li>";
                                        echo "</ul>";
                                    echo "</span>";
                                    echo "<span class='d-flex direction-column'>";
                                        echo "<button onclick='commander(". json_encode($row["title"]) .", ". json_encode($row["description"]) .", ". json_encode($row["price"]) .", ". json_encode($row["id_menu"]) .", ". json_encode(isset($_COOKIE["user"])) .")' class='btn-cart' style='position: absolute; right: 1.5em; bottom: 1.5em;'><i class='fas fa-cart-plus'></i></button>";
                                    echo "</span>";
                                echo "</div>";
                            }
                        }
                    ?>

            <!-- <div class="items">

                <div class="item" onclick="commander(this)">
                    <img src="../../assets/order_images/Shrimp.jpg" >
                    <div>
                        <h5><b>Grilled Shrimp Skewers</b></h5>
                        <p>
                            Succulent shrimp marinated in a tangy citrus glaze.
                        </p>
                        <b>$8</b>
                        <p hidden>1</p>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/order_images/Rissoto.jpg" >
                    <div>
                        <h5><b>Seafood risotto with saffron sauce</b></h5>
                        <p>
                            the risotto made with mixture of seafood, and rice with safrron sauce.
                        </p>
                        <b>$10</b>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/order_images/dark chocolate.jpg" >
                    <div>
                        <h5><b>Dark chocolate soufflé with raspberry coulis</b></h5>
                        <p>
                            Dark chocolate soufflé, accompanied by a fresh raspberry coulis
                        </p>
                        <b>$7</b>
                    </div>
                </div>
                <div class="item">
                    <img src="../../assets/order_images/mango.jpg" >
                    <div>
                        <h5><b>Mango Lassi</b></h5>
                        <p>
                        Creamy drink with mango, yogurt, milk, a little sugar, and a sprinkling of cardamom
                        </p>
                        <b>$4</b>
                    </div>
                </div>

            </div>
        </div> -->


    <script src="./orders.js"></script>
    <?php include_once "../footer/footer.php" ?>
</body>

</html>