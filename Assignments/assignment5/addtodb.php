<?php
    session_start();

    include 'dbconnection.php';
    $conn = getDatabaseConnection();
    
    
if (isset($_GET['addUserForm'])){
    //the administrator clicked on the "Add User" button
    $abv = $_GET['abv'];
    $food = $_GET['food'];
    
    
    //"INSERT INTO `tc_user` (`userId`, `firstName`, `lastName`, `email`, `universityId`, `gender`, `phone`, `role`, `deptId`) VALUES (NULL, 'a', 'a', 'a', '1', 'm', '1', '1', '1');
    
    $sql = "INSERT INTO bm
            (abv, food)
            VALUES
            (:abv, :food)";
    $namedParameters = array();
    $namedParameters[':abv'] =  $abv;
    $namedParameters[':food'] =  $food;
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    echo "User has been added successfully!";
            
}
    
 
?>

<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
    </body>
</html>