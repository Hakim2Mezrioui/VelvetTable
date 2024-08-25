<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./authentification.css">
</head>
<body>
    <div class="login-box">
    <h2>Login</h2>
    <form method="post">
        <div class="user-box">
        <input type="text" name="username" required="">
        <label>Username</label>
        </div>
        <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
        </div>
        <button name="login" href="#">login</button>
    </form>
    </div>

    <?php
        if(isset($_POST['login'])) {
            $userName = $_POST['username'];
            $password = $_POST['password'];

            header("Location:../orderList/orderList.php");
        }
    ?>
</body>
</html>