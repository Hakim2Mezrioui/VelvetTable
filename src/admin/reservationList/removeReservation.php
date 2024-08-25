<?php 
    include "../../../connection.php";
    if(isset($_GET["id_reservation"])) {
        $id_reservation = json_decode($_GET["id_reservation"]);
        try {
            $query = "DELETE FROM reservation WHERE id_reservation = :id_reservation";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id_reservation", $id_reservation);
    
            $stmt->execute();
            
            header("Location:./reservationList.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
?>