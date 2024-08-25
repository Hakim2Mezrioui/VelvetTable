<?php 
    include "../../../connection.php";
    if(isset($_GET["id_menu"])) {
        $id_menu = json_decode($_GET["id_menu"]);
        try {
            $query = "DELETE FROM menu WHERE id_menu = :id_menu";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id_menu", $id_menu);
    
            $stmt->execute();
            
            header("Location:./mealsList.php");
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
?>