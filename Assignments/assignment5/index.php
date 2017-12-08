<?php

include 'dbconnection.php';
    $conn = getDatabaseConnection();
?>

<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Spectral+SC" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link  href="css/styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">         
<title>AJAX: Beer me please</title>
<style type="text/css" id="diigolet-chrome-css">
</style>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script>
    
    ageFunction();
    
    
    function showInput() {
        document.getElementById('display').innerHTML =
        "you have searched for ABV " +  document.getElementById("abv").value;
    }
    
   function clearDisp(){
        $("#biers").hide();
    }
    
    function ageFunction() {
        var response = confirm("Are you 21 years of age or older?!?!");
    
    if (!response){
        window.history.back();
    }
    
}

        
</script>

</head>

<body id="dummybodyid">

   <h1> Beer ME </h1>

    <form onsubmit="return false">
        <fieldset>
           <legend>Pair your dish with a cold one!</legend>
            
            What's the highest alcohol content percentage you would like?<br>
            <input type="text" id="abv"> % <br><br>
            
            Pairing with what kind of food? <select id="pair" name="pairing">
                <option value="">Select One</option>
                <option value="chicken"> Chicken</option>
                <option value="carne"> Steak</option>
                <option value="spicy">Spicy</option>
                <option value="fruit">Fruit</option>
            </select>
            
            <br />
            
            
            <input type="submit" value="Submit" id="submit" class="submit"><br><br>
         </fieldset>
    </form>
    
    <div id="biers">
            <div id="bier1">
            Name: <span id="beerName"></span><br>
            ABV: <span id="ab"></span><br>
            <img id= "b1" height="150"><br>
            Description: <span id="descrip"></span><br><br>
            </div>
            
            <div id="bier2">
            Name: <span id="beerName2"></span><br>
            ABV: <span id="ab2"></span><br>
            <img id= "b2" height="150"><br>
            Description: <span id="descrip2"></span><br><br>
            </div>
            
            <div id="bier3">
            Name: <span id="beerName3"></span><br>
            ABV: <span id="ab3"></span><br>
            <img id= "b3" height="150"><br>
            Description: <span id="descrip3"></span><br><br>
            </div>
            
            <div id="bier4">
            Name: <span id="beerName4"></span><br>
            ABV: <span id="ab4"></span><br>
            <img id= "b4" height="150"><br>
            Description: <span id="descrip4"></span><br><br>
            </div>
    </div>
    
    <div id="display"></div>
            
            
        




</div>
</body></html>