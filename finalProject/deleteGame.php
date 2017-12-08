<?php

    include 'inc/dbconnection.php';
    $conn = getDatabaseConnection();
    $sql = "DELETE FROM vg_game 
            WHERE game_id = " . $_GET['game_id'];

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: admin.php");
    
?>