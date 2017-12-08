<?php
    include 'inc/header.php';

?>

<?php
    
    
    session_start();
    
    include 'inc/dbconnection.php';
    $conn = getDatabaseConnection();
    
    //Display the items
    function getItems() {
        global $conn;
        $sql = "SELECT * 
                FROM vg_game
                NATURAL JOIN vg_console
                WHERE 1";

    if (isset($_GET['search'])){
        
        
        
        $namedParameters = array();
        
        
        if (!empty($_GET['gameName'])) {
            //echo $_GET['deviceName'];
    //The following query allows SQL injection due to the single quotes
            $sql .= " AND game_name LIKE '%" . $_GET['gameName'] . "%'";


         }
        if (!empty($_GET['genre']) && $_GET['genre']!= "Select One") {
            
            $sql .= " AND genre = :gType"; //using named parameters
            $namedParameters[':gType'] =   $_GET['genre'];
         }  
         if (!empty($_GET['console']) && $_GET['console']!= "Select One") {
  
            $sql .= " AND console_name = :cType"; //using named parameters
            $namedParameters[':cType'] =   $_GET['console'];
         }
         
         
            
         $selected_radio = $_GET['orderBy'];
        
        if (isset($_GET['orderBy']) && $selected_radio == 'name') {
            
        $sql .=" ORDER BY game_name ";
        
        }
        
        if (isset($_GET['orderBy']) && $selected_radio == 'price') {
        
        $sql .= " ORDER BY price ";
        
        }
        
        //  if(!empty($_GET['orderby']) && $_GET['orderby'] == 'gname')     {
        //           $sql .= " ORDER BY game_name DESC";
        // } 
        //  else if(!empty($_GET['orderby']) && $_GET['orderby'] == 'price'){
        //           $sql .= " ORDER BY price ASC";
        // }
        
        
        
         
    }//endIf (isset)
    
    else {
        
        $sql .= " ORDER BY game_name ASC";
    }
    
    
       
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        showItems($games);
    }
    
    function display($items){
         foreach($items as $item) {
            echo $item['game_id']." ".$item['game_name'] . " " . $item['console_name']."<br>Genre: ".$item['genre'] . "<br>Release: " . $item['game_release']."</a><br>";
            
            // echo "<form action='addtocart.php' style='display:inline'>";
            // echo "<input type='hidden' name='itemId' value='".$item['game_id']."'>";
            // echo '<button class="add" value="'.$item['game_name'].'"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Add to cart</button>';
          
            echo "<br />";
        }
    }
    
   
    function showItems($items){
        foreach($items as $item) {
            echo "<tr><td><a href='viewitem.php?itemId=".$item['game_id']."'>".$item['game_name'] . "</a></td>" . "<td>".$item['console_name'] . "</td><td>$" . $item['price']."";
            
            // echo "</td><td><form action='addtocart.php' style='display:inline'>";
            // echo "<input type='hidden' name='itemId' value='".$item['game_id']."'>";
            // echo '<button class="btn btn-info btn-sm" value="'.$item['game_name'].'"><span class="glyphicon glyphicon-ok-sign"></span>  &nbsp;&nbsp;&nbsp;Add to cart</button>';
            echo "</form>";
            echo "</td></tr>";
        }
    }
    
     if(isset($_GET['add']) && $_GET['add'] == 'Add to Cart') {
        echo "<h4>Game has been added to cart</h4>";
    }
    function getConsole() {
    global $conn;
    $sql = "SELECT DISTINCT(console_name)
            FROM `vg_console` 
            ORDER BY console_name";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['console_name'] . "</option>";
        
    }
}
function getGenre() {
    global $conn;
    $sql = "SELECT DISTINCT(genre)
            FROM `vg_game` 
            ORDER BY genre";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['genre'] . "</option>";
        
    }
}
    if(!isset($_SESSION['ids']) || empty($_SESSION['ids'])){
        $_SESSION['ids']=array();
    }
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>

        function randomIntFromInterval(min, max) {
             return Math.floor(Math.random() * (max - min + 1) + min);
        };

// A more specific number between 0 and the number of poke on database
        function randPokemon() {
          return randomIntFromInterval(1, 718).toString();
        }

// Fetch a random pokemon name
        function generateName() {
          var generateurl = "https://pokeapi.co/api/v2/pokemon/" + randPokemon();
        
          $.ajax({
            type: "GET",
            url: generateurl,
            // Set the data to fetch as jsonp to avoid same-origin policy
            dataType: "json",
            success: function(data) {
              // If the ajax call is successfull, add the name to the "name" span
              console.log(data.name);
              console.log(data.image);
              
              $("#pokeName").html(data.name);
              document.getElementById("b1").src= data.sprites.front_default;
              //var href = "http://pokeapi.co" + data.image;
            }
          });
        }
    //getAbv();
    
    $(document).ready(function(){
                   
                        generateName();
                   
                });
                
                
                

    
</script>

            

             <img id= "b1" height="150"><br>

            <span id="pokeName"></span> will be helping you today!!!<br>
            

        </div>
        
        
       
        <hr>
        <h3>Game Stock</h3>
        
        
        <form method="get">
             Game Name: <input type="text" name="gameName" placeholder="Game Name"/>
             
                Genre:<select name="genre">
                <option value="">Select One</option>
                    <?=getGenre()?>
                </select>
                
                Console:<select name="console">
                <option value="">Select One</option>
                    <?=getConsole()?>
                </select>
                
                
            Order by:
            
            <label> Price</label>
            <input type="radio" name="orderBy" id="orderByPrice" value="price"/>
            <label>Name </label>
            <input type="radio" name="orderBy" id="orderByName" value="name"/>
            
            
            
            
            <input type="submit" name="search" value="Search"/>
        </form>
        <br>
         <table class="table table-hover">
            <thead>
      <tr>
        <th>Item</th>
        <th>Console</th>
        <th>Price</th>
       <tbody>
        </tr>
        <tbody>
        <?php $items = getItems(); ?>
        </tbody>
       
        </div>
        
        
        <script>
        
        function add(game) {
                 return "";
        }
                $(document).ready(function(){
                    $(".add").click(function(){
                        alert("Added " + $(this).attr('value') + " item to your cart.");
                    });
                });
        </script>
    </body>
</html>