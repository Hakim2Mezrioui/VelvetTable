<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php 
        include "../../../connection.php";
        if(isset($_GET["id_orders"])) {
            $id_orders = json_decode($_GET["id_orders"]);
            try {
                $query = "SELECT * FROM orders INNER JOIN  member ON orders.id_member = member.id_member INNER JOIN menu on orders.id_menu = menu.id_menu WHERE id_orders = :id_orders";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id_orders", $id_orders);
                $stmt->execute();
                $data = $stmt->fetch();
                // print_r($data);
            } catch(PDOException $e) {

            }
        }

        
    ?>
    
    <?php
        $_SESSION["mealsList"] = "../MealsList/mealsList.php";
        $_SESSION["ordersList"] = "../orderList/orderList.php";
        $_SESSION["reservationsList"] = "../reservationList/reservationList.php";        
        $_SESSION["users"] = "";
    ?>

    <?php 
        $_SESSION["errorIcon"] = "../../../assets/icon_alert/error.png";
        $_SESSION["warningIcon"] = "../../../assets/icon_alert/warning.png";
        $_SESSION["successIcon"] = "../../../assets/icon_alert/success.png";
        $_SESSION["backgroundDarker"] = "../../helpers/backgroundDarker.php";
        include "../../helpers/alert.php";
    ?>
</head>
<body>
    <?php 
        include "../../../connection.php";
        
        if(isset($_POST["confirm"])) {
            $quantite = $_POST["quantite"];
            $special_request = $_POST["special_request"];
            $id_orders = $data["id_orders"];
            
            try {

                $query = "UPDATE orders SET quantite = :quantite, special_request = :special_request WHERE id_orders = :id";
                $stmt = $pdo->prepare($query);

                $stmt->bindParam(":quantite", $quantite);
                $stmt->bindParam(":special_request", $special_request);
                $stmt->bindParam(":id", $id_orders);

                $stmt->execute();
                
                $data["quantite"] = $_POST["quantite"];
                $data["special_request"] = $_POST["special_request"];

                echo"
                    <script>
                        Swal.fire({
                            title: 'The operation is completed',
                            text: '',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = './orderList.php';
                            }
                        })
                    </script>
                ";
                

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    ?>

    <?php
        $_SESSION["header_path"] = "../../header/header.css";
        include_once "../header/header.php";
        include "../../../connection.php";
    ?>

    
    <div class="container">
        <form method="POST" class="p-5" enctype="multipart/form-data">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input required type="email" disabled name="email" value="<?php echo $data["email"] ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label class="form-label">Title</label>
                <input required type="text" disabled name="title" value="<?php echo $data["title"] ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label class="form-label">Quantite</label>
                <input required type="number" name="quantite" value="<?php echo $data["quantite"] ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label class="form-label">Special Request</label>
                <input type="text" name="special_request" value="<?php echo $data["special_request"] ?>"  type="text" class="form-control" />
            </div>
            <div class="mt-2">
                <button name="confirm" class="me-1 btn btn-success">Confirm</button>
                <button type="button" onclick="onReset()" class="me-1 btn btn-warning">Reset</button>
                <button type="button" onclick="onCancel()" class="me-1 btn btn-danger">Cancel</button>
            </div>
        </form>
    </div>   

    
    
    <script>
        function onReset() {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, reset it!'

            }).then((result) => {
            if (result.isConfirmed) {

                let inputs =document.getElementsByTagName("input");
                let textarea = document.getElementsByTagName("textarea")[0];
                inputs[0].value = "";
                inputs[1].value = "";
                inputs[2].value = "";
                inputs[3].value = "";

                Swal.fire(
                'clear it!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        }
        function onCancel() {
            Swal.fire({
                title: 'Are you sure',
                text: "",
                icon: 'warning',
                showCancelButton: false,
                confirmButtonText: 'Ok',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./reservationList.php";
                }
            })
        }
    </script>


</body>