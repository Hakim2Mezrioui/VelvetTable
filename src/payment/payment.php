<html lang="en">
  <head>
    <title>Bootstrap Stripe.js example form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body>
    <?php 
        include "../../connection.php";
        if(isset($_GET["id_member"])) {
          if(isset($_POST["payer"])) {
            try {
              $sql = "select * from cart where id_member = :id_member";
              $stm = $pdo->prepare($sql);
              $stm->bindParam(":id_member", $_GET["id_member"]);
              $stm->execute();
  
              while($row = $stm->fetch()) {
                  $query = "INSERT INTO orders(id_member, id_menu, special_request, quantite) VALUES (:id_member, :id_menu, :special_request, :quantite)";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(":id_member", $_GET["id_member"]);
                  $stmt->bindParam(":id_menu", $row['id_menu']);
                  $stmt->bindParam(":special_request", $row["special_request"]);
                  $stmt->bindParam(":quantite", $row["quantite"]);
                  $stmt->execute();
              }
  
              $query = "delete from cart where id_member = :id_member";
              $stmt = $pdo->prepare($query);
              $stmt->bindParam(":id_member", $_GET["id_member"]);
              $stmt->execute();
  
              $_SESSION["demands"] = 0;
              
              echo "
                  <script>
                      Swal.fire({
                          title: 'Your demand is registered',
                          text: 'Check your cart',
                          icon: 'success',
                          showCancelButton: false,
                          confirmButtonText: 'Ok',
                          cancelButtonText: 'Cancel'
                      }).then((result) => {
                          // Perform an action based on the user's choice
                          if (result.isConfirmed) {
                              // Code to execute if confirmed
                              window.location.href = '../orders/orders.php';
                          } else {
                              // Code to execute if cancelled
                          }
                      });
                  </script>                
              ";
          } catch (PDOException $e) {
              echo $e->getMessage();
          }
          }
        }
    ?>

      <div class="backImage"></div>
    <div class="container">
      <link rel="stylesheet" href="./payment.css">
      <script src="./payment.js"></script>
      <!-- Simple Bootstrap payment form starts here -->
      <!-- Use Jquery in this example -->
      <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
      <!-- Bootstrap JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
      <!-- Stripe.js to collect payment details -->
      <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
      <!-- Jquery payment library for nicer formatting -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.4.1/jquery.payment.js"></script>
      <div class="row" style="margin-top: 10vh;">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default">
            <div class="panel-body">
              <form action="" method="POST" id="payment-form">
                <div class="payment-errors"></div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Cardholder Name</label>
                      <input class="form-control input-lg" id="name" data-stripe="name" type="text" placeholder="Your Name" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Card Number</label>
                      <input class="form-control input-lg" id="number" type="tel" maxlength="16" size="20" data-stripe="number" placeholder="4242 4242 4242 4242" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-4">
                    <div class="form-group">
                      <label>Exp Month</label>
                      <input class="form-control input-lg" maxlength="2" id="exp_month" type="tel" size="2" data-stripe="exp-month" placeholder="01" required>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-4">
                    <div class="form-group">
                      <label>Exp Year</label>
                      <input class="form-control input-lg" maxlength="4" id="exp_year" type="tel" size="4" data-stripe="exp-year" placeholder="2020" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-3 col-xs-4">
                    <div class="form-group pull-right">
                      <label>CVC</label>
                      <input class="form-control input-lg" maxlength="3" id="cvc" type="tel" size="4" data-stripe="cvc" placeholder="555" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <button class="btn-succes" onclick="goBack()" type="button">Cancel</button>
                </div>
                <div class="col-md-8">
                    <button name="payer" class="btn-success btn btn-block submit" style="border:none; outline: 0; padding: 10px 16px" type="submit">Pay</button>
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Simple Bootstrap payment form ends here -->
    </div>
  </body>
</html>