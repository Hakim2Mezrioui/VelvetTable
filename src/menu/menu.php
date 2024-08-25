<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php 
            include "../header/header.css";
            include "../footer/footer.css";
            include "./menu.css";
        ?>
    </style>
    <?php        
        $_SESSION["orders_link"] = "../orders/orders.php";
        $_SESSION["reservation_link"] = "../reservation/reservation.php";
        $_SESSION["menu_link"] = $_SERVER["PHP_SELF"];
        $_SESSION["home_link"] = "../home/home.php";
        $_SESSION["about_link"] = "../about/about.php";
        $_SESSION["login_signup_link"] = "../logIn&signUp/login&signup.php";
        $_SESSION["active_page"] = "menu";

        $_SESSION['logo'] = "../../assets/logo.png";
        $_SESSION["menu_icon"] = "../../assets/menu.png";
        $_SESSION["facebook_icon"] = "../../assets/facebook.png";
        $_SESSION["instagram_icon"] = "../../assets/instagram.png";
    ?>
</head>
<body>
  <?php
    include "../../connection.php";
    include "../header/header.php";
  ?>

<div class="imgBackground"></div>

<section id="menu-list" class="section-padding">
  <div class="container">
  <div class="row">
<div class="col-md-12 text-center  marb-35">
  <h1 class="header-h">Our Menu</h1>


    </div>
    <div class="col-md-12 text-center" id="menu-filters">
      <ul>
        <li><a class="filter active" data-filter=".menu-restaurant">All</a></li>
         <li><a class="filter " data-filter=".appetizer">Appetizer</a></li>
         <li><a class="filter" data-filter=".main-course">Main Course</a></li>
         <li><a class="filter" data-filter=".dessert">Dessert</a></li>
         <li><a class="filter" data-filter=".drinks">Drinks</a></li>    
      </ul>
    </div>
    <div id="menu-wrapper">
      <?php 
        try {
          $query = "SELECT * FROM menu WHERE category = :category";
          $stmt = $pdo->prepare($query);
          $category = "Appetizer";
          $stmt->bindParam(":category", $category);
          $stmt->execute();

          while($row = $stmt->fetch()) {
              echo "<div class='appetizer menu-restaurant'>";
                echo "<span class='clearfix'>";
                  echo "<a class='menu-title' href='../meal/meal.php?id_menu=". json_encode($row["id_menu"]) ."' data-meal-img='.jpg'>". $row["title"] ."</a>";
                  echo "<span style='left:166px;right:44px;' class='menu-line'></span>";
                  echo "<span class='menu-price'>$". $row["price"] ."</span>";
                echo "</span>";
                echo "<span class='menu-subtitle'>". $row["description"] ."</span>";
              echo "</div>";
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      ?>

      <?php 
        try {
          $query = "SELECT * FROM menu WHERE category = :category";
          $stmt = $pdo->prepare($query);
          $category = "Main course";
          $stmt->bindParam(":category", $category);
          $stmt->execute();

          while($row = $stmt->fetch()) {
            echo "<div class='main-course menu-restaurant'>";
              echo "<span class='clearfix'>";
                echo "<a class='menu-title' href='../meal/meal.php?id_menu=". json_encode($row["id_menu"]) ."' data-meal-img='.jpg'>". $row["title"] ."</a>";
                echo "<span style='left:166px;right:44px;' class='menu-line'></span>";
                echo "<span class='menu-price'>$". $row["price"] ."</span>";
              echo "</span>";
              echo "<span class='menu-subtitle'>". $row["description"] ."</span>";
            echo "</div>";
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      ?>

      <?php 
        try {
          $query = "SELECT * FROM menu WHERE category = :category";
          $stmt = $pdo->prepare($query);
          $category = "Dessert";
          $stmt->bindParam(":category", $category);
          $stmt->execute();

          while($row = $stmt->fetch()) {
            echo "<div class='dessert menu-restaurant'>";
              echo "<span class='clearfix'>";
                echo "<a class='menu-title' href='../meal/meal.php?id_menu=". json_encode($row["id_menu"]) ."' data-meal-img='.jpg'>". $row["title"] ."</a>";
                echo "<span style='left:166px;right:44px;' class='menu-line'></span>";
                echo "<span class='menu-price'>$". $row["price"] ."</span>";
              echo "</span>";
              echo "<span class='menu-subtitle'>". $row["description"] ."</span>";
            echo "</div>";
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      ?>

      <?php 
        try {
          $query = "SELECT * FROM menu WHERE category = :category";
          $stmt = $pdo->prepare($query);
          $category = "Drinks";
          $stmt->bindParam(":category", $category);
          $stmt->execute();

          while($row = $stmt->fetch()) {
            echo "<div class='drinks menu-restaurant'>";
              echo "<span class='clearfix'>";
                echo "<a class='menu-title' href='../meal/meal.php?id_menu=". json_encode($row["id_menu"]) ."' data-meal-img='.jpg'>". $row["title"] ."</a>";
                echo "<span style='left:166px;right:44px;' class='menu-line'></span>";
                echo "<span class='menu-price'>$". $row["price"] ."</span>";
              echo "</span>";
              echo "<span class='menu-subtitle'>". $row["description"] ."</span>";
            echo "</div>";
          }
        } catch(PDOException $e) {
          echo "Error: " . $e->getMessage();
        }
      ?>      
      </div>
    </div>
     </div>

</section>
<script src="../../jquery/jquery.min.js"></script>
<script src="./menu.js"></script>

    <?php 
        include "../footer/footer.php";
    ?>
</body>
</html>