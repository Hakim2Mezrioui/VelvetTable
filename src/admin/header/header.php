<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $_SESSION["header_path"] ?>">
</head>
<body>
    <?php 
        include "../../helpers/getUser.php";
        include "../../../connection.php";
        
        $query = "select * from member where id_member = :id_member";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":id_member", $GLOBALS["id_member"]);
        $stmt->execute();
        $user = $stmt->fetch();
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $_SESSION["mealsList"] ?>">Meals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?php echo $_SESSION["ordersList"] ?>">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION["reservationsList"] ?>">Reservations</a>
            </li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $_SESSION["users"] ?>">users</a>
            </li>
        </ul>
        </div>
    </div>
    <p class="pt-3 me-5">
            Welcome <b><?php echo $user ? ucfirst($user['name'][0]) . substr($user['name'], 1) : "Mezrioui" ?></b>
    </p>
    </nav>
</body>
</html>