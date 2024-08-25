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
        if(isset($_GET["id_reservation"])) {
            $id_reservation = json_decode($_GET["id_reservation"]);
            try {
                $query = "SELECT * FROM reservation AS r INNER JOIN  member AS m WHERE id_reservation = :id_reservation";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":id_reservation", $id_reservation);
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
            $hour = $_POST["hour"];
            $dateRev = $_POST["dateRev"];
            $tailOfGroup = $_POST["tailOfGroup"];
            $id_reservation = $data["id_reservation"];
            
            try {

                $query = "UPDATE reservation SET hour = :hour, dateRev = :dateRev, tailOfGroup = :tailOfGroup WHERE id_reservation = :id";
                $stmt = $pdo->prepare($query);

                $stmt->bindParam(":hour", $hour);
                $stmt->bindParam(":dateRev", $dateRev);
                $stmt->bindParam(":tailOfGroup", $tailOfGroup);
                $stmt->bindParam(":id", $id_reservation);  

                $stmt->execute();
                
                $data["tailOfGroup"] = $_POST["tailOfGroup"];
                $data["hour"] = $_POST["hour"];
                $data["dateRev"] = $_POST["dateRev"];

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
                                window.location.href = './reservationList.php';
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
                <label class="form-label">Tail Of Group</label>
                <input required type="number" min="1" max="6" name="tailOfGroup" value="<?php echo $data["tailOfGroup"] ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label class="form-label">Date</label>
                <input required type="date" name="dateRev" value="<?php echo $data["dateRev"] ?>" class="form-control" />
            </div>
            <div class="form-group">
                <label class="form-label">Hour</label>
                <input required type="time" name="hour" value="<?php echo $data["hour"] ?>"  type="number" class="form-control" />
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