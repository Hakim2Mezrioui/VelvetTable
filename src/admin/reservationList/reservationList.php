<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
        <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
        

        <!-- <link
            rel="stylesheet"
            type="text/css"
            href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"
        /> -->
        <?php
            $_SESSION["mealsList"] = "../MealsList/mealsList.php";
            $_SESSION["ordersList"] = "../orderList/orderList.php";
            $_SESSION["reservationsList"] = "./reservationList.php";
            $_SESSION["users"] = "../usersList/usersList.php";
        ?>
</head>
<body>
    <?php 
        include "../../../connection.php";

        if(isset($_POST["delete"])) {
            $id_reservation = $_POST["id_reservation"];
            
            echo "
                <script>
                    Swal.fire({
                        title: 'Are you sure',
                        text: 'The operation is completed',
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        // Perform an action based on the user's choice
                        if (result.isConfirmed) {
                            // Code to execute if confirmed
                            window.location.href = './removeReservation.php?id_reservation=$id_reservation';
                        } else {
                            // Code to execute if cancelled
                            console.log('Cancelled');
                        }
                    });
                </script>
            ";
        }

        if(isset($_POST["edit"])) {
            $id_reservation = $_POST["id_reservation"];
            header("Location:./modifyReservation.php?id_reservation=$id_reservation");
        }
    ?>
    <?php
        $_SESSION["header_path"] = "../header/header.css"; 
        include "../header/header.php";
    ?>

    <?php 

        $sql = "SELECT * from reservation AS r INNER JOIN member AS m on r.id_member = m.id_member";
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            echo "<div class='mt-5 m-auto container' style='width: fit-content'>";
                echo "<table id='reservationList' class='table table-striped table-bordered dt-responsive' style='width: 100%;'>";
                    echo "<thead>";
                        echo "<tr>";
                        echo "<th>Id_reservation</th>";
                        echo "<th>Email</th>";
                        echo "<th>Date of reservation</th>";
                        echo "<th>hour</th>";
                        echo "<th>Tail of Group</th>";
                        echo "<th>Action</th>"; // Added table header for the action column
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                        while ($row = $result->fetch()) {
                            echo "<tr>";
                                echo "<td>" . $row["id_reservation"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["dateRev"] . "</td>";
                                echo "<td>" . $row["hour"] . "</td>";
                                echo "<td>" . $row["tailOfGroup"] . "</td>";
                                echo "<td>";
                                    echo "<form method='POST' class='d-flex gap-1'>"; // Specify the action and method for the form
                                        echo "<input type='hidden' name='id_reservation' value='" . $row["id_reservation"] . "'>"; // Hidden input field to pass the ID
                                        echo "<button name='edit' class='btn btn-warning text-white'><i class='fas fa-edit'></i></button>"; // Button for deleting the reservation
                                        echo "<button class='btn btn-danger' type='submit' name='delete'><i class='fas fa-regular fa-trash'></i></button>"; // Button for deleting the reservation
                                    echo "</form>";
                                echo "</td>";
                            echo "</tr>";
                        }
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
        } else {
            echo "<h3>No reservations found.</h3>";
        }
        ?>
    
    <!-- <script
        type="text/javascript"
        charset="utf8"
        src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"
    ></script>
    <script
        type="text/javascript"
        charset="utf8"
        src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"
    ></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>  

    <script>
        $(document).ready(function () {
            $('#reservationList').DataTable();
        });
    </script>
</body>
</html>
