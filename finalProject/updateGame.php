<?php
    session_start();
    
    if (!isset($_SESSION['username'])) { // Validates that the admin is logged in
        header("Location: index.php");
    }
    
    include 'inc/dbconnection.php';
    $conn = getDatabaseConnection();
    
    function getConsoleInfo(){
        global $conn;
        
        $sql = "SELECT console_name, console_id 
                FROM vg_console 
                ORDER BY console_name 
                ASC";
                    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll();
        print_r($records);        
        return $records;
    }
    
    function getDevInfo(){
        global $conn;
        
        $sql = "SELECT developer_name, developer_id 
                FROM vg_developer 
                ORDER BY developer_name 
                ASC";
                    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll();
        print_r($records);        
        return $records;
    }
    
    function getGameInfo($game_id) {
        global $conn;    
        $sql = "SELECT * 
                FROM vg_game
                WHERE game_id = $game_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $record = $stmt->fetch();

        return $record;
    }
    
    if (isset($_GET['updateGameForm'])) {
        $sql = "UPDATE vg_game
                SET game_name = :game_name,
                game_release = :game_release,
                genre = :genre,
                console_id = :console_id,
                price = :price,
                developer_id = :developer_id
			    WHERE game_id = :game_id;";
        
        $namedParameters = array();
        $namedParameters[':game_name'] =  $_GET['game_name'];
        $namedParameters[':game_release'] =  $_GET['game_release'];
        $namedParameters[':genre'] =  $_GET['genre'];
        $namedParameters[':console_id'] =  $_GET['console_id'];
        $namedParameters[':price'] = $_GET['price'];
        $namedParameters[':developer_id']  = $_GET['developer_id'];
        $namedParameters[':game_id'] = $_GET['game_id'];

        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
       
        
        echo "Game has been updated successfully!";
    }

    if (isset($_GET['game_id'])) {
        
        $userInfo = getGameInfo($_GET['game_id']);

    }


?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin: Updating User </title>
        
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">         

    </head>
    <body>
        <h1> Admin Section </h1>
        <h2> Updating User Info </h2>
        
        <fieldset>
            <legend> Updating User </legend>
            
            <form>
                Game Name: <input type="text" name="game_name" required value="<?=$userInfo['game_name']?>"/> 
                </br>
                Game Release: <input type="text" name="game_release" required value="<?=$userInfo['game_release']?>"/> 
                </br>
                Genre: <input type="text" name="genre" required value="<?=$userInfo['genre']?>"/>
                </br>
                Price: <input type="text" name="price" required value="<?=$userInfo['price']?>"/>
                </br>
                
                Developer: <select name="developer_id">
                                <option value=""> Select One </option>
                                <?php
                                    $records = getDevInfo();
                                   
                                    foreach ($records as $record) {
                                        
                                        echo  "<option value='" . $record['developer_id'] . "' ";
                                        
                                        
                                        if ($userInfo['developer_id'] == $record['developer_id'])
                                            echo "selected='selected'";
                                            
                                        echo ">" . $record['developer_name'] . "</option>";
                                    }
                                    
                                ?>
                            </select>
                </br>
                
                Console: <select name="console_id">
                                <option value=""> Select One </option>
                                <?php
                                    $records = getConsoleInfo();
                                   
                                    foreach ($records as $record) {
                                        
                                        echo  "<option value='" . $record['console_id'] . "' ";
                                        
                                        
                                        if ($userInfo['console_id'] == $record['console_id'])
                                            echo "selected='selected'";
                                            
                                        echo ">" . $record['console_name'] . "</option>";
                                    }
                                    
                                ?>
                            </select>
                </br>
                
                
                
                <input type="hidden" name="game_id" required value="<?=$userInfo['game_id']?>"/>
                
                
                
               
                <input type="submit" name="updateGameForm" value="Update Game!"/>
                
                
                
            </form>
        </fieldset>
        
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        
    </body>
</html>

