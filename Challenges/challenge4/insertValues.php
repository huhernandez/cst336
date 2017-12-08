<?php

    include '../../../dbConnection2.php';
    $dbConn = getDatabaseConnection("survey");    
    $sql = "Insert into (yes, maybe, no) 
            values(:yes, :maybe, :no)
            WHERE id = :id";
    $namedParameters = array();
    $namedParameters[':yes'] =  $;
    $namedParameters[':lName'] =  $lastName;
    $namedParameters[':email'] =  $email;
    
    $stmt = $dbConn -> prepare($sql);
    $stmt -> execute(array("id"=>$_GET['id']));
    $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultSet);
        
?>