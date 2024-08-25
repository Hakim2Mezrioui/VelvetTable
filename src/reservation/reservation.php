<!DOCTYPE html>
<html lang="en"></html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./orders.css">
    <title>Orders</title>
    <style>
        <?php
            include "../header/header.css";
            include "../footer/footer.css";
            include "./reservation.css";
            
            $showFirstForm = true;
            $showSecondForm = false;

            $date = "";
            $hour = "";        
            $fname = "";
            $lname = "";
            $phone = "";
            $email = "";
        ?>
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
        $_SESSION["orders_link"] = "../orders/orders.php";
        $_SESSION["reservation_link"] = "../reservation/reservation.php";
        $_SESSION["menu_link"] = "../../src/menu/menu.php";        
        $_SESSION["home_link"] = "../home/home.php";        
        $_SESSION["about_link"] = "../about/about.php";
        $_SESSION["login_signup_link"] = "../logIn&signUp/login&signup.php";
        $_SESSION["active_page"] = "reservation";

        $_SESSION["logo"] = "../../assets/logo.png";
        $_SESSION["menu_icon"] = "../../assets/menu.png";
        $_SESSION["facebook_icon"] = "../../assets/facebook.png";
        $_SESSION["instagram_icon"] = "../../assets/instagram.png";
    ?>
</head>

<body class="bodyReservation">

    <?php 
        include "../../connection.php";

        if(isset($_POST["reserve"])) {
            $tailOfGroup = $_POST["tailOfGroup"];
            $Date = $_POST["date"];
            $hour = $_POST["hour"];

            $dateObj = DateTime::createFromFormat('Y-m-d', $Date);
            $date = "" . $dateObj->format('Y-m-d');

            $query = "SELECT COUNT(*) FROM reservation WHERE dateRev = :date AND hour = :hour";
            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":date", $date);
            $stmt->bindParam(":hour", $hour);

            $stmt->execute();

            $count = $stmt->fetchColumn();
            if (!isset($_COOKIE["user"])) {
                echo "
                <script>
                    Swal.fire({
                        title: 'You have to register first',
                        text: 'For making the reservation',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'Not now'
                    }).then((result) => {
                        // Perform an action based on the user's choice
                        if (result.isConfirmed) {
                            // Code to execute if confirmed
                            window.location.href = 'http://localhost/hakim&salma/Hakim&Salma/src/logIn&signUp/login&signup.php';
                        } else {
                            // Code to execute if cancelled
                            console.log('Cancelled');
                        }
                    });
                </script>
                ";
            }
            else if($count > 0) {
                echo "
                <script>
                    Swal.fire({
                        title: 'A reservation with the same time and date already exists.',
                        text: 'choose other time',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        // Perform an action based on the user's choice
                        if (result.isConfirmed) {
                            // Code to execute if confirmed
                            window.location.href = 'http://localhost/hakim&salma/Hakim&Salma/src/reservation/reservation.php';
                        } else {
                            // Code to execute if cancelled
                            console.log('Cancelled');
                        }
                    });
                </script>
                ";
            } else {
                
                include "../helpers/getUser.php";

                try {
                    $query = "INSERT INTO reservation (hour, tailOfGroup, dateRev, id_member) VALUES (:hour, :tailOfGroup, :dateRev, :id_member)";

                    $stmt = $pdo->prepare($query);
                    
                    $stmt->bindParam(":hour", $hour);
                    $stmt->bindParam(":tailOfGroup", $tailOfGroup);
                    $stmt->bindParam(":dateRev", $date);
                    $stmt->bindParam(":id_member", $GLOBALS["id_member"]);

                    $stmt->execute();

                    echo "
                        <script>
                            Swal.fire({
                                title: 'Good your reservation is completed',
                                text: '',
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

            // echo "
            //     <script>
            //         window.location.href = './storage.php?date=' + ". json_encode($date) ." + '&hour=' +".json_encode($hour)." + '&tailOfGroup=' +".json_encode($tailOfGroup).";
            //     </script>
            // ";
            // header("Location:./storage.php?data=". $date);

            // $data = new Data($hour, $date, $tailOfGroup);
            
            // header("Location:./storage.php?data=" . $data);
            
                }
            }
        }

        // if(isset($_POST["makeYourReservation"])) {
            // $fname = $_POST["fname"];
            // $lname = $_POST["lname"];
            // $phone = $_POST["phone"];
            // $email = $_POST["email"];

            // try{
                // $query = "INSERT INTO reservation (email, phone, dateRev, hour, fname, lname, tailOfGroup) VALUES(:email, :phone, :date, :hour, :fname, :lname, :tailOfGroup)";
                // $stmt = $pdo->prepare($query);
    
                // $stmt->bindParam(":email", $email);
                // $stmt->bindParam(":phone", $phone);
                // $stmt->bindParam(":date", $date);
                // $stmt->bindParam(":hour", $hour);
                // $stmt->bindParam(":fname", $fname);
                // $stmt->bindParam(":lname", $lname);
                // $stmt->bindParam(":tailOfGroup", $tailOfGroup);
    
                // $stmt->execute();
    
                // echo "
                //     <script>
                //         Swal.fire({
                //             title: 'Confirmation',
                //             text: 'The operation is completed',
                //             icon: 'success',
                //             showCancelButton: false,
                //             confirmButtonText: 'Ok',
                //             cancelButtonText: 'Cancel'
                //         }).then((result) => {
                //             // Perform an action based on the user's choice
                //             if (result.isConfirmed) {
                //                 // Code to execute if confirmed
                //                 window.reload();
                //             } else {
                //                 // Code to execute if cancelled
                //                 console.log('Cancelled');
                //             }
                //         });
                //     </script>
                // ";
            // } catch (PDOException $e) {
            //     echo $e->getMessage();
                // echo "                    
                //     <script>
                //         Swal.fire({
                //         title: ". json_encode($e) .",
                //         text: '',
                //         icon: 'error',
                //         showCancelButton: false,
                //         confirmButtonText: 'Ok',
                //         cancelButtonText: 'Cancel'
                //         }).then((result) => {
                //         // Perform an action based on the user's choice
                //         if (result.isConfirmed) {
                //             // Code to execute if confirmed
                //             window.location.href = './reservation.php';

                //         } else {
                //             // Code to execute if cancelled
                //             console.log('Cancelled');
                //         }
                //         });
                //     </script>
                // ";
            // }

            // }
            


        // $showFirstForm = true;
        // $showSecondForm = false; 
            
    ?>

    <?php require_once "../header/header.php"; ?>
    <div class="halfBack"></div>

        <h2 class="title">Make Your Resevation</h2>


        <form method="POST" class="form-reservation">
            <div class="d-flex justify-content-center gap-3">
                <div>
                    <label>Taille du group</label>
                    <select required name="tailOfGroup" class="">
                        <option value="1">1 personne</option>
                        <option value="2">2 personnes</option>
                        <option value="3">3 personnes</option>
                        <option value="4">4 personnes</option>
                        <option value="5">5 personnes</option>
                        <option value="6">6 personnes</option>
                    </select>
                </div>
                <div>
                    <label for="">Date</label>
                    <input required name="date" class="" type="date" name="" id="">
                    <!-- <input required name="date" type="text" placeholder="YYYY/--/--"> -->
                </div>
                <div>
                    <label for="">Hour</label>
                    <input required name="hour" class="" type="time" name="" id="">
                </div>
            </div>
            <div class="text-center">
                <button name="reserve" class="btn-reserve" type="submit">Reserve</button>
            </div>
        </form>

        <!-- <form method="POST" class="form-confirmation <?php //echo $showSecondForm ? 'show' : 'hide' ?>">
            <div class="d-flex gap-3 my-2">
                <div>
                    <label>First name</label>
                    <input required name="fname" type="text" minlength="4" maxlength="15" />
                </div>
                <div>
                    <label>Last name</label>
                    <input required name="lname" type="text" minlength="4" maxlength="15" />
                </div>
            </div>
            <div class="d-flex gap-3 my-1">
                <div>
                    <label>Phone</label>
                    <input required name="phone" type="text" pattern="^\d{10}$" minlength="10" maxlength="10" />
                </div>
                <div>
                    <label>Email</label>
                    <input required name="email" type="email" />
                </div>
            </div>
            <div>
                <button name="makeYourReservation" class="btn-reserve w-100 m-0">Make Your Reservation</button>
            </div>
        </form> -->

        <script src="./reservation.js"></script></script>

    <?php include_once "../footer/footer.php" ?>
</body>

</html>