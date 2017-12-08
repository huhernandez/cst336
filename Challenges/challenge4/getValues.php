<?php

    include '../../../dbConnection2.php';
    $dbConn = getDatabaseConnection("survey");    
    $sql = "SELECT * 
            FROM votes";
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute();
    $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultSet);
        
?>