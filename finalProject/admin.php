<?php
    include 'inc/header.php';

?>

<?php
session_start();

    if (!isset($_SESSION['username'])) { //checks whether admin has logged in
        
        header("Location: index.php");
        exit();
        
    }

include 'inc/dbconnection.php';
$conn = getDatabaseConnection();


function displayGames() {
    global $conn;
    $sql = "SELECT * 
            FROM vg_game";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $games = $statement->fetchAll(PDO::FETCH_ASSOC);
    //print_r($users);
    return $games;
}




function displayAvg() {
    global $conn;
    $sql = "SELECT console_name, cast(avg(price)as decimal(10,2))
            as avpri
            FROM vg_game natural join vg_console 
            group by console_name";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo "Average Game Price by Console <br>";
    foreach ($records as $record) {
        echo $record['console_name']."  $".$record['avpri'] . " " . "</a><br>";
    }
    

    
}

function displayMax() {
    global $conn;
    $sql = "SELECT console_name, max(price) as maxprice
            FROM vg_game natural join vg_console
            group by console_name";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //return $records;
    echo "Maximum Game Price by Console <br>";
    foreach ($records as $record) {
        echo $record['console_name']." $".$record['maxprice'] . " " . "</a><br>";
    }
    
}



function displayCount(){
    global $conn;
    $sql = "SELECT console_name, count(game_id) 
            as counter
            FROM vg_game natural join vg_console 
            group by console_name";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records= $statement->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Number of Titles by Console <br>";
    foreach ($records as $record) {
        echo $record['console_name']."  $".$record['counter'] . " " . "</a><br>";
    }

}

// if (isset($_GET['report'])){
//      if (!empty($_GET['theReport']) && $_GET['theReport']!= "Select One") {
  
//             if ($_GET['theReport'] == "maxP"){
//                 displayMax();
//             }
//          }
    
// }



?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page </title>
        <script>
            
            function confirmDelete(game_name) {
                
                
                return confirm("Are you sure you want to delete " + game_name + "?");
                
            }
            
            
        </script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">         
    </head>
    <body>

        <h1> GamesGalore Admin Page </h1>
        <h2> Welcome <?=$_SESSION['adminFullName']?>! </h2>
        
        <hr>
        
        <form action="addGame.php">
            
            <input type="submit" value="Add new Game" />
            
        </form>
        
          <form action="logout.php">
            
            <input type="submit" value="Logout" />
            
        </form>
        
        
        <br /><br />
        <div class="container">
        <div class="row">
        
        <div id="gamecol" class="col">
        
        <?php
        
        $games =displayGames();
        
        foreach($games as $item) {
            
            // echo $game['game_id'] . '  ' . $game['game_name'] . "  " . $game['genre'];
            echo $item['game_id']." ".$item['game_name'] . " " . $item['console_name']."<br>Genre: ".$item['genre'] . "<br>Release: " . $item['game_release']."</a><br>";
            // echo "[<a href='updateGame.php?game_id=".$item['game_id']."'> Update </a> ]";
            //echo "[<a href='updateGame.php?game_id=5'> Update </a> ]";
            echo "<form action='updateGame.php' style='display:inline' >
                     <input type='hidden' name='game_id' value='".$item['game_id']."' />
                     <input type='submit' value='Update'>
                  </form>
                ";
            echo "<form action='deleteGame.php' style='display:inline' onsubmit='return confirmDelete(\"".$item['game_name']."\")'>
                     <input type='hidden' name='game_id' value='".$item['game_id']."' />
                     <input type='submit' value='Delete'>
                  </form>
                ";
            
            //xxxxxxxxxxxxxxxxxxxecho "[<a href='deleteUser.php?userId=".$user['userId']."'> Delete </a> ]";  xxxxxxxxxxxxxxx
            
            // echo "<form action='deleteUser.php' style='display:inline' onsubmit='return confirmDelete(\"".$user['firstName']."\")'>
            //          <input type='hidden' name='userId' value='".$user['userId']."' />
            //          <input type='submit' value='Delete'>
            //       </form>
            //     ";
            
            echo "<br />";
            
        }
        
        
        
        ?>
        
        </div>
        
        <div id="reports" class="col"> 
        
        <form method="get">
             
                Price and Inventory Reports:<select id="rType" name="theReport">
                <option value="x">Select One</option>
                <option value="maxP">Maximum Prices</option>
            	<option value="avP">Average Prices</option>
            	<option value="cnt">Count</option>
            	</select><br />
            
            <input type="submit" name="report" value="Generate Report"/>
            
            
        </form>
        <?php
        if (isset($_GET['report'])){
            if (!empty($_GET['theReport']) && $_GET['theReport']!= "Select One") {
  
                if ($_GET['theReport'] == "maxP"){
                    displayMax();
                }
                if ($_GET['theReport'] == "avP"){
                    displayAvg();
                }
                if ($_GET['theReport'] == "cnt"){
                    displayCount();
                }
                if ($_GET['theReport'] == "x"){
                    echo "";
                }
            }
    
        }
        ?>
        
        </div>
        </div>
        </div>
        
    
        
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>     
</html>