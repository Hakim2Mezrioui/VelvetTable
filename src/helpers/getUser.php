<?php 
    $userEmail = $_COOKIE["user"];
    $query = "select id_member from member where email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $userEmail);
    $stmt->execute();
    $GLOBALS["id_member"] = $stmt->fetchColumn();
?>