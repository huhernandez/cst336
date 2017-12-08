<?php
    include 'inc/header.php';

?>

<?php
session_start();

if (!isset($_SESSION['username'])) { //validates that admin has indeed logged in
    
    header("Location: index.php");
    
}

include 'inc/dbconnection.php';
$conn = getDatabaseConnection();

function getConsoleList(){
    global $conn;        
    $sql = "SELECT *
            FROM vg_console";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    return $records;
    
}

function getDevList(){
    global $conn;        
    $sql = "SELECT *
            FROM vg_developer";
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    return $records;
    
}


if (isset($_GET['addGameForm'])){
    //the administrator clicked on the "Add User" button
    $game_name = $_GET['game_name'];
    $game_release = $_GET['game_release'];
    $genre    = $_GET['genre'];
    $console_id = $_GET['console_id'];
    $price    = $_GET['price'];
    $developer_id   = $_GET['developer_id'];
    
    
    //"INSERT INTO `tc_user` (`userId`, `firstName`, `lastName`, `email`, `universityId`, `gender`, `phone`, `role`, `deptId`) VALUES (NULL, 'a', 'a', 'a', '1', 'm', '1', '1', '1');
    
    $sql = "INSERT INTO vg_game
            (game_name, game_release, genre, console_id, price, developer_id)
            VALUES
            (:game_name, :game_release, :genre, :console_id, :price, :developer_id)";
    $namedParameters = array();
    $namedParameters[':game_name'] =  $game_name;
    $namedParameters[':game_release'] =  $game_release;
    $namedParameters[':genre'] =  $genre;
    $namedParameters[':console_id'] =  $console_id;
    $namedParameters[':price'] = $price;
    $namedParameters[':developer_id']  = $developer_id;

    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    echo "User has been added successfully!";
            
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin: Adding New Game </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">         
    </head>
    <body>

    <h1> Admin Section </h1>
    <h2> Adding New Game </h2>

    <fieldset>
        
        <legend> Add New Game </legend>
        
        <form>
            
            Game Name: <input type="text" name="game_name" required /> <br>
            Game Release: <input type="text" name="game_release" required/> <br>
            Genre: <input type="text" name="genre"/> <br>
            Price: <input type="text" name="price"/> <br>
            Developer: <select name="developer_id">
                            <option value=""> Select One </option>
                            <?php
                                $devs = getDevList();
                                foreach ($devs as $record) {
                                    echo "<option value='$record[developer_id]'>$record[developer_name]</option>";
                                }
                            ?>
                            
                        </select>
                        <br>
            Console: <select name="console_id">
                            <option value=""> Select One </option>
                            <?php
                                $consoles = getConsoleList();
                                foreach ($consoles as $record) {
                                    echo "<option value='$record[console_id]'>$record[console_name]</option>";
                                }
                            ?>
                            
                        </select>
                        <br />
                <input type="submit" name="addGameForm" value="Add Game!"/>
        </form>
        
    </fieldset>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>