<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<footer class="container-fluid bg-grey py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 ">
                        <div class="logo-part">
                            <?php                            
                                echo "<img alt='logo' src=" . $_SESSION["logo"] . " class='w-50 logo-footer'>";
                            ?>
                            <p>Experience the richness of flavor at The Velvet Table </p>
                            <p>456 Oakwood Boulvard, in the trendy uptown district</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 px-4">
                        <h6> Help us</h6>
                        <div class="row ">
                            <div class="col-md-6">
                                <ul>
                                    <li> <a href="#"> Home</a> </li>
                                    <li> <a href="#"> Menu</a> </li>
                                    <li> <a href="#"> Reservation</a> </li>
                                    <li> <a href="#"> Orders</a> </li>
                                    <li> <a href="#"> Contact Us</a> </li>
                                    <li> <a href="#"> About Us</a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="social">
                            <?php                            
                                echo "<a href='#'><img width='20' src=" . $_SESSION["facebook_icon"] . " aria-hidden='true'></a>";
                            ?>
                            <?php                            
                                echo "<a href='#'><img width='20' src=" . $_SESSION["instagram_icon"] . " aria-hidden='true'></a>";
                            ?>
                        </div>
                        <form class="form-footer my-3 d-flex">
                            <input type="text" placeholder="leave a message" name="POV">
                            <input type="button" value="Send">
                        </form>
                        <p>All rights are reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

</html>