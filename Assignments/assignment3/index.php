<?php
    include 'inc/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Sushi Order Form </title>
        <meta charset="utf-8"/>
        <style>
            @import url("css/styles.css");
        </style>
    </head>
    <header>
        <h1>Roll it UP!</h1>
        <h3>Welcome! </h3>
    </header>
    <body>
    
    <div class= "frameStuff">    
    <div class="formStuff">
    
        <!--<form action="/action_page.php">-->
        <!--  First name:<br>-->
        <!--  <input type="text" name="firstname" value=" "><br>-->
        <!--  Last name:<br>-->
        <!--  <input type="text" name="lastname" value=" "><br><br>-->
        <!--  <input type="submit" value="Submit">-->
        <!--</form>-->
        
    <form id="rollSelection" action="/action_page.php">
        What kind of Roll would you like?<br>
      <select name="Rolls">
    <option value="California Roll">cali</option>
    <option value="Dragon Roll">dragon</option>
    <option value="Pink Dragon Roll">pDragon</option>
    <option value="Spicy Tuna Roll">sTuna</option>
  </select>
  <br><br>
  <input type="submit">
</form>
     
     </div>
     </div>
   


    </body>
</html>