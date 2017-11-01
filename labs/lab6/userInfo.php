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
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">         
        <title> User Information </title>
        
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
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>