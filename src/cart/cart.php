<link rel="stylesheet" href="../cart/cart.css">

<?php
    include_once "../helpers/backgroundDarker.php";
    // include "../../connection.php";

    if(isset($_POST['delete'])) {
        $id_cart = $_POST["id_cart"];
    
        try {
            $query = "DELETE FROM cart WHERE id_cart = :id_cart";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id_cart", $id_cart);
            $stmt->execute();

            echo "
                <script>
                    Swal.fire({
                        title: 'this item is deleted',
                        text: '',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'Not now'
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
            
            $_SESSION["demands"] -= 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    
    if (isset($_POST['confirm'])) {
        if(isset($_COOKIE["user"])) {
            include "../helpers/getUser.php";
            echo "<script>
                        window.location.href = '../payment/payment.php?id_member=" . $GLOBALS['id_member'] . "';
                </script>";
        
        };
    }

    if(isset($_POST["update"])) {
        $quantite = $_POST["quantite"];
        $id_cart = $_POST["id_cart"];
        try {
            $query = "UPDATE cart set quantite = :quantite where id_cart = :id_cart";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":quantite", $quantite);
            $stmt->bindParam(":id_cart", $id_cart);
            $stmt->execute();
            echo "
                <script>
                    Swal.fire({
                        title: 'It's updated ',
                        text: '',
                        icon: 'success',
                        showCancelButton: false,
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
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    if(isset($_COOKIE["user"])) {
        try {
            $sql = "SELECT * FROM cart 
                    INNER JOIN menu ON cart.id_menu = menu.id_menu 
                    INNER JOIN member ON cart.id_member = member.id_member where member.id_member = :id_member";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id_member", $GLOBALS["id_member"]);
            $stmt->execute();

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
?>

<section class="cart">
    <?php 
    if(isset($_COOKIE["user"])) {
        if($stmt->rowCount() > 0) {
            while($row = $stmt->fetch()) {
                echo "<div class='itemCart mb-3'>";
                    echo "<span class='w-75'>";
                        echo "<h3 class='m-0 title'><b>" . $row["title"] ."</b></h3>";
                        echo "<p class='desc m-0 description'>". $row["description"] ."</p>";
                        echo "<p class='price m-0'><b>$". $row["price"] ."</b></p>";
                        echo "<input type='hidden' name='id_cart' value='". $row["id_cart"] ."' />";
                        echo "<input type='hidden' name='id_member' value='". $row["id_member"] ."' />";
                    echo "</span>";
                    echo "<span>";
                        echo "<div>";
                            echo "<form method='POST' style='display: inline-block;'>";
                                echo "<input name='quantite' class='form-control d-block mb-1 ' type='number' min='0' max='5' value='". $row["quantite"] ."'>";
                                echo "<span class='mt-2'>";
                                    echo "<button name='update' class='btn btn-outline-success'>";
                                        echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2' viewBox='0 0 16 16'>";
                                        echo "<path d='M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z'/>";
                                        echo "</svg>";
                                    echo "</button> | ";                                
                                    echo "<input type='hidden' name='id_cart' value='". $row["id_cart"] ."' />";
                                    echo "<button name='delete' class='btn btn-outline-danger'>";
                                        echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>";
                                        echo "<path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z'/>";
                                        echo "</svg>";
                                    echo "</button>";
                                echo "</form>";
                            echo "</span>";
                        echo "</div>";
                    echo "<span>";
                echo "</div>";
                echo "</hr>";
            }
        }
        echo "<form method='post'>";
            // echo "<input type='hidden' name='id_member' value='1'/>";
            echo "<button name='confirm' type='submit' class='btn btn-outline-success'>Confirm</button> | ";
            echo "<button type='button' class='btn btn-danger' onclick='hideCart()'>Cancel</button>";
        echo "</form>";
    }
    ?>
</section>
