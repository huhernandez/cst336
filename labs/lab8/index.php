
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>AJAX: Sign Up Page</title>
<style type="text/css" id="diigolet-chrome-css">
</style>
<link  href="css/styles.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Ubuntu" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <style>
            body {
                text-align: center;
            }
        </style>
<script>


    function getCity() {
        
        //alert($("#zip").val());
        $.ajax({

            type: "GET",
            url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
            dataType: "json",
            data: { "zip": $("#zip").val()},
            success: function(data,status) {
                
                 if (!data) {
                   alert(status);
                   alert("No city for this zip!");
                   document.getElementById("noZip").innerHTML ="<span style='color: red;'>No city for this zip code!</span>";
                 } else{
                      //alert(data.city);
                      $("#noZip").empty();
                      $("#city").html(data.city);
                      $("#lat").html(data.latitude);
                      $("#long").html(data.longitude);
                      
                 }
            
            },
            complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }

        });//ajax
        
    }  //function
    
    
    
    function getCounties() {
        
        //alert("You've selected state: " + $("#stateId").val());
        $.ajax({
        
        type: "GET",
        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
        dataType: "json",
        data: { "state": $("#stateId").val()},
        success: function(data,status) {
         //alert(data[0].county)
         $("#countyId").html("<option> Select One </option>");
         for (var i=0; i < data.length; i++){
         $("#countyId").append("<option>"+data[i].county+"</option>");
         }
        },
        complete: function(data,status) { //optional, used for debugging purposes
        //alert(status);
        }
        
        });//ajax
    }
    function checkUsername() {
        //alert("hello");
        
        $.ajax({

        type: "GET",
            url: "checkUsername.php",
            dataType: "json",
            data: { "username": $("#username").val()},
            success: function(data,status) {
        alert(data);
             if (!data) {
                   alert(status);
                   alert("USERNAME AVAILABLE!");
                   document.getElementById("warning").innerHTML ="<span style='color: green;'>Username available!</span>";
               } else {
                   
                   alert ("username already taken!");
                   document.getElementById("warning").innerHTML ="<span style='color: red;'>Username already taken!</span>";
               }
        
        },
        complete: function(data,status) { //optional, used for debugging purposes
       // alert(status);
        }
        
        });//ajax

    
    }
    
    function checkPassword(){
        if ($("#password").val() != $("#password2").val()) {
                $("#passwordError").html("*Passwords do not match!");
            }
        else{
            $("#passwordError").empty();
        }
    }
    //event handlers
    
    $(document).ready(  function(){
        
        $("#zip").change( function(){ getCity(); } );
        $("#stateId").change(function(){getCounties(); });
        $("#username").change( function(){ checkUsername(); } );
        $("#password2").change( function(){ checkPassword(); } );
        //alert( "ready!" );
        
        
    } ); //documentReady
    
    
</script>

</head>

<body id="dummybodyid">

   <h1> Sign Up Form </h1>

    <form onsubmit="return false">
        <fieldset>
           <legend>Sign Up</legend>
            First Name:  <input type="text"><br> 
            Last Name:   <input type="text"><br> 
            Email:       <input type="text"><br> 
            Phone Number:<input type="text"><br><br>
            Zip Code:    <input type="text" id="zip">
            <span id="noZip"></span><br>
            City: <span id="city"></span> 
            <br>
            Latitude: <span id="lat"></span> 
            <br>
            Longitude:<span id="long"></span> 
            <br><br>
            State: <select id="stateId" name="state">
                <option value="">Select One</option>
                <option value="AL">Alabama</option>
            	<option value="AK">Alaska</option>
            	<option value="AZ">Arizona</option>
            	<option value="AR">Arkansas</option>
            	<option value="CA">California</option>
            	<option value="CO">Colorado</option>
            	<option value="CT">Connecticut</option>
            	<option value="DE">Delaware</option>
            	<option value="DC">District Of Columbia</option>
            	<option value="FL">Florida</option>
            	<option value="GA">Georgia</option>
            	<option value="HI">Hawaii</option>
            	<option value="ID">Idaho</option>
            	<option value="IL">Illinois</option>
            	<option value="IN">Indiana</option>
            	<option value="IA">Iowa</option>
            	<option value="KS">Kansas</option>
            	<option value="KY">Kentucky</option>
            	<option value="LA">Louisiana</option>
            	<option value="ME">Maine</option>
            	<option value="MD">Maryland</option>
            	<option value="MA">Massachusetts</option>
            	<option value="MI">Michigan</option>
            	<option value="MN">Minnesota</option>
            	<option value="MS">Mississippi</option>
            	<option value="MO">Missouri</option>
            	<option value="MT">Montana</option>
            	<option value="NE">Nebraska</option>
            	<option value="NV">Nevada</option>
            	<option value="NH">New Hampshire</option>
            	<option value="NJ">New Jersey</option>
            	<option value="NM">New Mexico</option>
            	<option value="NY">New York</option>
            	<option value="NC">North Carolina</option>
            	<option value="ND">North Dakota</option>
            	<option value="OH">Ohio</option>
            	<option value="OK">Oklahoma</option>
            	<option value="OR">Oregon</option>
            	<option value="PA">Pennsylvania</option>
            	<option value="RI">Rhode Island</option>
            	<option value="SC">South Carolina</option>
            	<option value="SD">South Dakota</option>
            	<option value="TN">Tennessee</option>
            	<option value="TX">Texas</option>
            	<option value="UT">Utah</option>
            	<option value="VT">Vermont</option>
            	<option value="VA">Virginia</option>
            	<option value="WA">Washington</option>
            	<option value="WV">West Virginia</option>
            	<option value="WI">Wisconsin</option>
            	<option value="WY">Wyoming</option>
            </select><br />
            
            Select a County: <select id = "countyId"></select><br>
            
            Desired Username: <input id= "username" type="text">
            <span id="warning"></span><br>
            Password: <input type="password" id="password"><br>
            Type Password Again: <input type="password" id="password2">
            <span id="passwordError"></span><br>
            <input type="submit" value="Sign up!">
        </fieldset>
    </form>




</div></body></html>