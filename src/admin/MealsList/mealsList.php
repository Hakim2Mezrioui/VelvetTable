<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./mealsList.css">
        

        <!-- <link
            rel="stylesheet"
            type="text/css"
            href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"
        /> -->
        <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />


        <?php
            $_SESSION["mealsList"] = "./mealsList.php";
            $_SESSION["ordersList"] = "../orderList/orderList.php";
            $_SESSION["reservationsList"] = "../reservationList/reservationList.php";
            $_SESSION["users"] = "../usersList/usersList.php";
        ?>
        
</head>
<body>
    <?php     
        include "../../../connection.php";

        if(isset($_POST["confirm"])) {                    
            // $id = $_POST["id"];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['path_image']['name'];
            $path_image = pathinfo($image, PATHINFO_FILENAME);
            $ext_image = "." . pathinfo($image, PATHINFO_EXTENSION);
            $price = $_POST['price'];
            $category = $_POST['category'];
            
            
            try{
                $query = "INSERT INTO menu (title, description, price, category, path_image, ext_image) VALUES (:title, :description, :price, :category, :path_image, :ext_image)";
                
                $stmt = $pdo->prepare($query);
                
                // $stmt->bindParam(":id", $id);
                $stmt->bindParam(":title", $title);
                $stmt->bindParam(":description", $description);
                $stmt->bindParam(":price", $price);
                $stmt->bindParam(":category", $category);
                $stmt->bindParam(":path_image", $path_image);
                $stmt->bindParam(":ext_image", $ext_image);
                
                $stmt->execute();
                echo "
                    <script>
                        Swal.fire({
                            title: 'Confirmation',
                            text: 'The operation is completed',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            // Perform an action based on the user's choice
                            if (result.isConfirmed) {
                                // Code to execute if confirmed
                                console.log('Confirmed');
                            } else {
                                // Code to execute if cancelled
                                console.log('Cancelled');
                            }
                        });
                    </script>
                ";

            } catch(PDOException $e) {
                echo $e->getMessage();

                echo "
                    <script>
                        Swal.fire({
                            title: 'Confirmation',
                            text: ". json_encode($e->getMessage()) .",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            // Perform an action based on the user's choice
                            if (result.isConfirmed) {
                                // Code to execute if confirmed
                                console.log('Confirmed');
                            } else {
                                // Code to execute if cancelled
                                console.log('Cancelled');
                            }
                        });
                    </script>
                ";
            }               
        }

        if(isset($_POST["delete"])) {
            $id_menu = $_POST["id_menu"];
            
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
                            window.location.href = './removeMeal.php?id_menu=$id_menu';
                        } else {
                            // Code to execute if cancelled
                            console.log('Cancelled');
                        }
                    });
                </script>
            ";
        }

        if(isset($_POST["edit"])) {
            $id_menu = $_POST["id_menu"];
            header("Location:./modifyMeal.php?id_menu=$id_menu");
        }
    ?>

    <?php
        $_SESSION["header_path"] = "../header/header.css"; 
        include "../header/header.php";
    ?>

    <?php 

        try{
            $sql = "SELECT * FROM menu";  
            $result = $pdo->query($sql);

            if($result->rowCount() > 0){
                echo "<div class='mt-5 container m-auto' style='margin-inline: 4em;'>";
                    echo "<table id='mealsList' class='table table-striped table-bordered dt-responsive' style='width: 100%'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>Image</th>";
                                echo "<th>Title</th>";
                                echo "<th>Description</th>";
                                echo "<th>Price</th>";
                                echo "<th>Category</th>";
                                echo "<th><button id='addMeal' class='btn btn-success'><i class='fas fa-plus'></i></button></th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "</tbody>";

                    while($row = $result->fetch()){
                        echo "<tr>";
                            echo "<td><img class='ms-1' width='50' height='50' src='../../../assets/MENU/". $row["category"] ."/". $row['path_image'] . $row["ext_image"]."' /></td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['description'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            // echo "<td>" . $row['id_menu'] . "</td>";
                            echo "<td>" . $row['category'] . "</td>";
                            echo "<td>";
                                echo "<form method='post' class='d-flex gap-2'>";
                                    echo "<input type='hidden' name='id_menu' value='".$row['id_menu']."' />";
                                    echo"<button name='edit' class='btn btn-warning text-white'><i class='fas fa-edit'></i></button>";
                                    echo"<button name='delete' class='btn btn-danger'><i class='fas fa-trash'></i></button>";
                                echo "</form>";
                            echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                echo "</div>";
                // Free result set
                unset($result);
            } else{
                echo "No records matching your query were found.";
            }
        } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
    ?>

    <section class="section-addMeal">
        <?php include "../../helpers/backgroundDarker.php" ?>
        <form method="POST" id="add-meal" action="" class="p-5" enctype="multipart/form-data">
            <!-- <div class="form-group">
                <label class="form-label">Identification</label>
                <input name="id" class="form-control" required />
            </div> -->
            <div class="form-group">
                <label class="form-label">Title</label>
                <input name="title" class="form-control" required />
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea required name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Image</label>
                <input name="path_image" class="form-control" type="file" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label class="form-label">Price</label>
                <input name="price" type="number" class="form-control" required />
            </div>
            <div class="form-group">
                <!-- <label class="form-label">Price</label>
                <input name="price" type="number" class="form-control" /> -->
                <label class="form-label" for="">Categories</label>
                <select class="form-control" name="category" id="">
                    <option value="Main Course">Main Course</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Appetizer">Appetizer</option>
                    <option value="Drinks">Drinks</option>
                    <option value="special menus">Special Menus</option>
                </select>
            </div>
            <div class="mt-2">
                <button name="confirm" type="submit" class="me-1 btn btn-success">Confirm</button>
                <button type="button" id="reset" class="me-1 btn btn-warning">Reset</button>
                <button type="button" id="cancel" class="me-1 btn btn-danger">Cancel</button>
            </div>
        </form>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>    
    <script>
       $(document).ready(function () {
            $('#mealsList').DataTable();
        });
    </script>
    <script src="./mealsList.js"></script>
    
</body>
</html>
