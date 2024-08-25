<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login&signup.css">
	<?php 
		include "../../connection.php";
	?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!--
		This was created based on the Dribble shot by Deepak Yadav that you can find at https://goo.gl/XRALsw
		I'm @hk95 on GitHub. Feel free to message me anytime.
	-->

<button style="position: absolute; top: 3em; left: 3em; width: fit-content; font-size: 1.5em; padding: .7em .8em;" onclick="history.back()">X</button>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="" method="post">
			<h1>Create Account</h1>
			<div class="social-container">
                <a href="#" class="social"><img width="20" src="../../assets/f.png" class="fab fa-facebook-f"/></a>
                <a href="#" class="social"><img width="20" src="../../assets/google.png" class="fab fa-google-plus-g"/></a>
                <a href="#" class="social"><img width="20" src="../../assets/linkedin.png" class="fab fa-linkedin-in"/></a>
			</div>
			<span>or use your email for registration</span>
			<input name="name" type="text" placeholder="Name" required />
			<input name="email" type="email" placeholder="Email" required />
			<input name="password" type="password" placeholder="Password" required />
			<button name="signUp">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="#" method="post">
			<h1>Sign in</h1>
			<div class="social-container">
                <a href="#" class="social"><img width="20" src="../../assets/f.png" class="fab fa-facebook-f"/></a>
                <a href="#" class="social"><img width="20" src="../../assets/google.png" class="fab fa-google-plus-g"/></a>
                <a href="#" class="social"><img width="20" src="../../assets/linkedin.png" class="fab fa-linkedin-in"/></a>
			</div>
			<span>or use your account</span>
			<input name="email" type="email" placeholder="Email" required />
			<input name="password" type="password" placeholder="Password" required />
			<a href="#">Forgot your password?</a>
			<button name="signIn">Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>  

<script src="./login&signup.js"></script>

<?php 
	class Member {
		public $name;
		public $email;

		public function __construct($name, $email) {
			$this->$name = $name;
			$this->$email = $email;
		}
	}

	if(isset($_POST["signUp"])) {
		try {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
	
			$query = "insert into member (name, email, password) values (?, ?, ?)";
			$prepare = $pdo->prepare(($query));
			$prepare->execute([$name, $email, $password]);
	
			$cookieName = 'user';
			$cookieValue = $_POST['email'];
			$expirationTime = time() + (86400 * 30);
			setcookie($cookieName, $cookieValue, $expirationTime, "/");
			header("Location:../orders/orders.php");
			exit();
		} catch(PDOException $e) {
			echo "
                    <script>
                        Swal.fire({
                            title: 'This account already exist',
                            text: 'You should just sign in',
                            icon: 'info',
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
		}

	}

	if(isset($_POST["signIn"])) {
		try {
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$query = "select * from member where email = :email and password = :password";
			
			$stmt = $pdo->prepare($query);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":password", $password);
			
			$stmt->execute();
			
			$member = $stmt->fetch();
			if($member) {
				// $memberObj = new Member($member['name'], $member['email']);
				$cookieName = 'user';
				$cookieValue = $member['email'];
				// $cookieValue = serialize($memberObj);
				$expirationTime = time() + (86400 * 30); // 30 days
				
				setcookie($cookieName, $cookieValue, $expirationTime, "/");
				header("location:../home/home.php");
			}
		} catch (PDOException $e) {

		}
		
	}
?>

</body>
</html>