
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>AJAX: Sign Up Page</title>
<style type="text/css" id="diigolet-chrome-css">
</style>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script>

    function getCity() {
        
        //alert($("#zip").val());
        $.ajax({

            type: "GET",
            url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
            dataType: "json",
            data: { "zip": $("#zip").val()},
            success: function(data,status) {
              
              //alert(data.city);
              $("#city").html(data.city);
              $("#lat").html(data.latitude);
              $("#long").html(data.longitude);
            
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
        //alert("hello")
        $.ajax({

            type: "GET",
            url: "checkUsername.php",
            dataType: "json",
            data: { "username": $("#username").val()},
            success: function(data,status) {
               //alert(data);
               
               if (!data) {
                   
                   alert("USERNAME AVAILABLE!");
                   
               } else {
                   
                   alert ("username already taken!");
               }
            
            },
            complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }
            
            });//ajax
    }
    
    //event handlers
    
    $(document).ready(  function(){
        
        $("#zip").change( function(){ getCity(); } );
        $("#stateId").change(function(){getCounties(); });
        $("#username").change( function(){ checkUsername(); } );
        
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
            Zip Code:    <input type="text" id="zip"><br>
            City: <span id="city"></span> 
            <br>
            Latitude: <span id="lat"></span> 
            <br>
            Longitude:<span id="long"></span> 
            <br><br>
            State: <select id="stateId" name="state">
                <option value="">Select One</option>
                <option value="ca"> California</option>
                <option value="ny"> New York</option>
                <option value="tx"> Texas</option>
                <option value="va"> Virginia</option>

            </select><br />
            Select a County: <select id = "countyId"></select><br>
            
            Desired Username: <input type="text" id="username"><br>
            Password: <input type="password"><br>
            Type Password Again: <input type="password"><br>
            <input type="submit" value="Sign up!">
        </fieldset>
    </form>




</div></body></html>