<?php 
    include "../../../connection.php";
    if(isset($_GET["id_orders"])) {
        $id_orders = json_decode($_GET["id_orders"]);
        try {
            $query = "DELETE FROM orders WHERE id_orders = :id_orders";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id_orders", $id_orders);
    
            $stmt->execute();
            
            header("Location:./orderList.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
?>