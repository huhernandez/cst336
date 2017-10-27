<?php

$host = 'localhost';    //cloud9
$dbname = 'tcp';
$username = "root";
$password = "";
//create database connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname",$username, $password);

//display db related errors
$dbConn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function usersWithAnA(){
    $sql = "SELECT firstName, lastName, email FROM tc_user WHERE firstName LIKE 'A%'";

    $stmt = $dbConn -> prepare ($sql);  //arrow to access object, used like dot.
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //print_r($records);

    foreach($records as $record){
        echo $record['firstName']. " ". $record['lastName'] ." ".$record['email'] ."<br/>";
    }
}

function devices3to1k(){
    $sql = "SELECT * FROM tc_device WHERE price > 300 AND price < 1000";
    
    
    $stmt = $dbConn -> prepare ($sql);  //arrow to access object, used like dot.
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //print_r($records);

    foreach($records as $record){
        echo $record['deviceName']. " ". $record['devicePrice'] ."<br/>";
    }
    
}


?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
   <h3> Users whomvst first name starts with an A:</h3>
   <?=usersWithAnA()?>;
   <br/>
   <h3>Devices between $300 & $1000</h3>
   <?=devices3to1k()?>;
   
    
</body>
</html>