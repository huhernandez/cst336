<?php

function displayCheckoutHistory() {
    include'../../dbConnection.php';
    $conn = getDatabaseConnection();   
    
    $sql = "select * from tc_checkout
            natural join tc_user
            natural join tc_device
            where deviceId = :deviceId";
            
    $namedParam = array(":deviceId"=>$_GET['deviceId']);
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParam);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record){
        
        echo $record['firstName'] . " " . $record['lastName'] . "   Checkout date: " . $record['checkoutDate'] . " Due Date: " . $record['dueDate'] ."<br />"; //display all info ie checkout date TO DO TO DO TO DO
    }
    
}



// function getDeviceTypes(){
//     global $conn;
//     $sql = "SELECT DISTINCT(deviceType)
//             FROM `tc_device` NATURAL JOIN 'tc_checkout'
//             ORDER BY deviceType";
    
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
//     foreach ($records as $record) {
        
//         echo "<option> "  . $record['deviceType'] . "</option>";
        
//     }
// }

// function displayDevices(){
//     global $conn;
    
//     $sql = "SELECT * FROM tc_device WHERE 1 ";
    
    
//     if (isset($_GET['submit'])){
        
//         $namedParameters = array();
        
        
//         if (!empty($_GET['deviceName'])) {
            
//             //The following query allows SQL injection due to the single quotes
//             //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
//             $sql .= " AND deviceName LIKE :deviceName"; //using named parameters
//             $namedParameters[':deviceName'] = "%" . $_GET['deviceName'] . "%";

//          }
        
//          if (!empty($_GET['deviceType'])) {
            
//             //The following query allows SQL injection due to the single quotes
//             //$sql .= " AND deviceName LIKE '%" . $_GET['deviceName'] . "%'";
  
//             $sql .= " AND deviceType LIKE :deviceType"; //using named parameters
//             $namedParameters[':dType'] = "%" . $_GET['deviceType'] . "%";

//          }
         
//          if(isset($_GET['available'])){
             
//          }
        
        
//     }//endIf (isset)
    
//     //If user types a deviceName
//      //   "AND deviceName LIKE '%$_GET['deviceName']%'";
//     //if user selects device type
//       //  "AND deviceType = '$_GET['deviceType']";
    
    
//     $stmt = $conn->prepare($sql);
//     $stmt->execute($namedParameters);
//     $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
//      foreach ($records as $record) {
        
//         echo  $record['deviceName'] . " " . $record['deviceType'] . " " .
//               $record['price'] .  "  " . $record['status'] . 
//               "<a href='checkoutHistory.php?deviceId=".$record['deviceId']."> Checkout History </a> <br />";
        
//     }
// }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Checkout History </title>
    </head>
    <body>
        
        <h2> Checkout History </h2>
        
        <?=displayCheckoutHistory()?>

    </body>
</html>