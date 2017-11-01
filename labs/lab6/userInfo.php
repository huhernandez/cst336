<?php

    include '../../dbConnection.php';
    $conn = getDatabaseConnection();
    
    
    function getUserInfo($userId) {
        global $conn;    
        $sql = "SELECT * 
                FROM tc_user
                WHERE userId = $userId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch();
        //print_r($record);
        return $record;
    }
    
    if (isset($_GET['updateUserForm'])) {
        
        $firstName = $_GET['firstName'];
        $lastName = $_GET['lastName'];
        $email    = $_GET['email'];
        $universityId = $_GET['universityId'];
        $phone    = $_GET['phone'];
        $gender   = $_GET['gender'];
        $role   = $_GET['role'];
        $deptId   = $_GET['deptId'];
        
        $sql = "UPDATE tc_user
                SET firstName = :fName,
                lastName = :lName
                email = :email,
                universityId = :universityId,
                gender = :gender,
                phone = :phone,
                role = :role,
                departmentId = :departmentId
			    WHERE userId = :userId";
                
        $namedParameters = array();
        $namedParameters[':fName'] =  $firstName;
        $namedParameters[':lName'] =  $lastName;
        $namedParameters[':email'] =  $email;
        $namedParameters[':universityId'] =  $universityId;
        $namedParameters[':gender'] = $gender;
        $namedParameters[':phone']  = $phone;
        $namedParameters[':role']   = $role;
        $namedParameters[':deptId'] = $deptId;
        
        
    	$namedParameters[":userId"] = $_GET['userId'];
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        
    }

    if (isset($_GET['userId'])) {
        
        $userInfo = getUserInfo($_GET['userId']);
        
        
    }
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> User Information </title>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <body>
        <?php
                echo "</br>&nbsp&nbsp&nbsp&nbsp First Name: " . $userInfo['firstName'] .  
                     "</br>&nbsp&nbsp&nbsp&nbsp Last Name: " . $userInfo['lastName'] .
                     "</br>&nbsp&nbsp&nbsp&nbsp User Id: " . $userInfo['userId'] .  
                     "</br>&nbsp&nbsp&nbsp&nbsp Email: " . $userInfo['email'] .  
                     "</br>&nbsp&nbsp&nbsp&nbsp University ID #: " . $userInfo['universityId']. 
                     "</br>&nbsp&nbsp&nbsp&nbsp Gender: " . $userInfo['gender'] .  
                     "</br>&nbsp&nbsp&nbsp&nbsp Phone #: " . $userInfo['phone'] . "</br>";

                 
        ?>
    </body>
</html>