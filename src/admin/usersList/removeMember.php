<?php 
    include "../../../connection.php";
    if(isset($_GET["id_member"])) {
        $id_member = json_decode($_GET["id_member"]);
        
        try {
            $query = "DELETE FROM member WHERE id_member = :id_member";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id_member", $id_member); 
    
            $stmt->execute();
            
            header("Location: ./usersList.php"); 
        } catch (PDOException $e) {
            echo $e->getMessage(); 
        }
    }   
?>
