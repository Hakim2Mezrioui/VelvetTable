<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./authentification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <?php
        include '../../../connection.php';    
    ?>
</head>
<body>
    <a class="goBack" href="../../home/home.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
    <div class="login-box">
    <h2>Login</h2>
    <form method="POST">
        <div class="user-box">
        <input type="text" name="email" required="">
        <label>email</label>
        </div>
        <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
        </div>
        <button type="submit" name="login" href="#">login</button>
    </form>
    </div>

    <?php

        if(isset($_POST['login'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];
            try {
    
                $query = "select * from member where email = :email and password = :password and status = 'admin'";
    
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $password);
    
                $stmt->execute();
                $member = $stmt->fetch();

                if($member) {
                    header("Location:../MealsList/mealsList.php");
                } else {
                    echo "
                    <script>
                        Swal.fire({
                            title: 'You\'re not an admin',
                            text: 'You can\'t login',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Ok',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '../../home/home.php';
                            }
                        })
                    </script>
                    ";
                }
    
                    // $cookieName = "userAdmin";
                    // $cookieValue = member    
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    ?>
</body>
</html>