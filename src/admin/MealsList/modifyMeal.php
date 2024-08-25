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
        if(isset($_GET["id_menu"])) {
            $id_menu = json_decode($_GET["id_menu"]);
            try {
                $query = "SELECT * FROM menu where id_menu = :id_menu";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id_menu", $id_menu);
                $stmt->execute();
                $data = $stmt->fetch();
            } catch(PDOException $e) {

            }
        }

        
    ?>
    
    <?php
        $_SESSION["mealsList"] = "../MealsList/mealsList.php";
        $_SESSION["ordersList"] = "../orderList/orderList.php";
        $_SESSION["reservationsList"] = "../../reservationList/reservationList.php";
        $_SESSION["users"] = ".";
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
            $title = $_POST["title"];
            $description = $_POST["description"];
            $price = $_POST["price"];
            
            if($_FILES["image"]["name"]) {
                $image = $_FILES["image"]["name"];
            } else {
                $image = $data["path_image"];
            }

            
            try {

                $query = "update menu set title = :title, description = :description, path_image = :path_image, price = :price where id_menu = :id";
                $stmt = $pdo->prepare($query);

                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":description", $description);
                $stmt->bindParam(":path_image", $image);
                $stmt->bindParam(":price", $price);
                $stmt->bindParam(":id", $data['id_menu']);  

                $stmt->execute();
                
                $data["title"] = $_POST["title"];
                $data["description"] = $_POST["description"];
                $data["path_image"] = $_FILES["image"];
                $data["price"] = $_POST["price"];

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
                                window.location.href = './mealsList.php';
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
                <label class="form-label">title</label>
                <input required name="title" value="<?php echo $data["title"] ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea required name="description" class="form-control"><?php echo $data["description"] ?></textarea>
            </div>            
            <div class="form-group">
                <label class="form-label">Image</label>
                <input id="fileInput" class="custom-file-input form-control" type="file" name="image" accept="image/*">
                <p class="">
                    previous file <?php echo is_array($data["path_image"]) ? basename($data["path_image"]["name"]) : $data["path_image"] ?>
                </p>
            </div>
            <div class="form-group">
                <label class="form-label">Price</label>
                <input required name="price" value="<?php echo $data["price"] ?>"  type="number" class="form-control" />
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
                textarea.value = "";

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
                    window.location.href = "./mealsList.php";
                }
            })
        }
    </script>


</body>