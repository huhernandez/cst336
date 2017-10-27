<!DOCTYPE html>

<?php

$host = 'localhost';
$dbname = 'tcp';
$username = 'root';
$password = '';
    
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

function getUsersAndDepartments(){
    global $dbConn;
    
    $sql= "SELECT firstName, lastName, deptName FROM `tc_user`
            INNER JOIN tc_department
            ON tc_user.deptId = tc_department.departmentId";
            
    $stmt= $dbConn ->prepare($sql);
    $stmt->execute();
    $records= $stmt->fetchAll(PDO::FETCH_ASSOC);
    
   // print_r($records);
    foreach ($records as $record) {
        
        echo$record['firstName'].' '.$record['lastName'].' '.$record['deptName']. "<br/>";
        
    }
    
}
    
    
    function usersWithTablets(){
        global $dbConn;
        
        $sql="SELECT firstName,lastName FROM 
        tc_user natural JOIN tc_checkout natural join tc_device

        where deviceType='Tablet'";
        
        $stmt= $dbConn ->prepare($sql);
        $stmt->execute();
        $records= $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($records as $record) {
        
        echo$record['firstName'].' '.$record['lastName']. "<br/>";
    
    }
    
}






?>


<html>
    <head>
        <title>SQL Joins </title>
    </head>
    <body>
        
        <h2> Users and their corresponding deprtments (order by last name)</h2>
        
        <?=getUsersAndDepartments()?>
        
        <h2>Users that have checked out tablets:</h2>
        
        <?=usersWithTablets()?>

    </body>
</html>