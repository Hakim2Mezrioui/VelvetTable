<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <script src="./meal.js"></script>
    <script src="../../jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php 
        $_SESSION["orders_link"] = "../orders/orders.php";
        $_SESSION["reservation_link"] = "../reservation/reservation.php";
        $_SESSION["menu_link"] = "../../src/menu/menu.php";        
        $_SESSION["home_link"] = "../home/home.php";        
        $_SESSION["about_link"] = "../about/about.php";
        $_SESSION["login_signup_link"] = "../logIn&signUp/login&signup.php";
        $_SESSION["active_page"] = "reservation";
        
        $_SESSION["logo"] = "../../assets/logo.png";
        $_SESSION["menu_icon"] = "../../assets/menu.png";
        $_SESSION["facebook_icon"] = "../../assets/facebook.png";
        $_SESSION["instagram_icon"] = "../../assets/instagram.png";
    ?>
    <style>
        <?php include "./meal.css" ?>
        <?php include "../header/header.css" ?>
        <?php include "../footer/footer.css" ?>
    </style>
</head>
<body>
    <?php
        include "../../connection.php";
        include "../helpers/getUser.php";

        if (isset($_GET["id_menu"])) {
            $GLOBALS["id_menu"] = json_decode($_GET["id_menu"]);

            $query = "SELECT * FROM ingredients WHERE id_menu = :id_menu";
            $stmtIngredient = $pdo->prepare($query);
            $stmtIngredient->bindParam(":id_menu", $GLOBALS["id_menu"]);
            $stmtIngredient->execute();

            $query = "SELECT * FROM menu WHERE id_menu = :id_menu";
            $stmtMenu = $pdo->prepare($query);
            $stmtMenu->bindParam(":id_menu", $GLOBALS["id_menu"]);
            $stmtMenu->execute();

            $menu = $stmtMenu->fetch();

        } else {
            echo "No 'id_menu' parameter provided.";
        }

        if(isset($_POST["addToMyCommands"])) { 
            $specialRequest = $_POST["specialRequest"];
            $quantite = $_POST["quantite"];

            if($GLOBALS["id_member"]) {
                try{
                    $query = "INSERT INTO cart(id_menu, special_request, quantite, id_member) VALUES(:id_menu, :special_request, :quantite, :id_member)";
            
                    $stmt = $pdo->prepare($query);

                    $stmt->bindParam(":quantite", $quantite);
                    $stmt->bindParam(":id_menu", $GLOBALS["id_menu"]);
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

                    // $_SESSION["demands"] += 1;
                } 
                catch(PDOException $e) {
                    echo $e->getMessage();
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
                }
            } else {
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

        }
    ?>

    <?php include "../header/header.php" ?>




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




    <div class="container row m-auto justify-content-center align-items-center meal my-5 py-5">
        <div class="col-md-5">
            <img title="<?php echo $menu["title"] ?>" class="meal-img" src="<?php echo "../../assets/MENU/" . $menu["category"] ."/". $menu["path_image"] . $menu["ext_image"] ?>" alt="">
        </div>
        <div class="col-md-5">
            <h4 class="meal-title"><?php echo $menu["title"] ?></h4>
            <h6 class="text-warning"><b>ingredients</b></h6>
            <ul class="ingrediets list-group ps-3 my-3">
                <?php 
                    if($stmtIngredient->rowCount() > 0) {
                        while($row = $stmtIngredient->fetch()) {
                            echo "<li class='meal-ingredient'>". $row["name"] ."</li>";
                        }
                    }
                ?>
            </ul>
            <h6 class="text-warning"><b>Description</b></h6>
            <p class="meal-description ps-3">
                <?php echo $menu["description"] ?>
            </p>
            <span>
                <?php 
                    echo "<button onclick='commander(". json_encode($menu["title"]).",".json_encode($menu["description"]).",".json_encode($menu["price"]).",".json_encode($menu["id_menu"]).",".json_encode($GLOBALS["id_member"]).")' class='btn-cart my-5'><i class='fas fa-cart-plus'></i>Order Now</button>";
                ?>
            </span>
        </div>
    </div>

    <?php include "../footer/footer.php" ?>
</body>
</html>