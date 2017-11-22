function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 37, lng: -122 },
            scrollwheel: false,
            zoom: 2
        });
    }



function getCity() {
  initMap();      

alert("before");
$.ajax({
        type: "GET",    //parameters in url, using GET method
        url: "https://maps.googleapis.com/maps/api/place/nearbysearch/json",
        key: "AIzaSyDS0mvEeDvykcLwviG5NuK4sPHcQA9xodM",
        dataType: "jsonp", //some use jsonp->check documentation
        data: { "location":"37,-122", "radius":"10000", "keyword":"sushi"},
        
        //data: { "location": $("#userLocale").val(),"term":"sushi"},  //look at params after the question mark
        //data: { "term":"sushi", "radius":"10000"},
        //data: '{ "jewellerId":' + filter + ', "locale":"en" }',
        success: function(data,status){
            //alert(data);
            alert("Name:" + data.name + " Link: "+ data.url );
            alert(data.results[1].name);
           // $("#location").html(data.results.name);
            // $("#latitude").html(data.latitude);
            // $("#longitude").html(data.longitude);
        },
        complete: function(data,status) { //optional, used for debugging purposes
            //alert(status);
            }
});
    
        
alert("after");
    }  //function

  //AIzaSyCmVxuiouOzGqrr13FTGMJen-aOL_lqQP8  
   // $("#zip").change( function(){ getCity(); } );  //onclick cals the getCity() function
///////////////////////////////////////////////////////////////////////////////////////////////////////////

var fishy = ["tuna",
            "salmon",
            "unagi"]
            
var garn=   ["avocado",
            "cucumber",
            "jalapeno"];

       
var fish = "";
var garnish = "";

            
//window.onload=startGame();


 

function pickWord() {
   var randomInt = Math.floor(Math.random() *fishy.length );
    fish = fishy[randomInt];
    var randomInt2 = Math.floor(Math.random() * garn.length);
    garnish = garn[randomInt2];
    console.log(fish);
    console.log(garnish);
    
    var selectedFish= "img/"+ fish+".jpg";
    var selectedGarnish= "img/"+ garnish+".jpg";
    
    var fishText = fish.toUpperCase();
    var garnText = garnish.toUpperCase();

    
    document.getElementById("fish").src= selectedFish;
    document.getElementById("garnish").src= selectedGarnish;
    
    document.getElementById("fName").innerHTML = fishText +"!!!";
    document.getElementById("gName").innerHTML = garnText +"!!!";

}





 
function startGame() {
    pickWord();
}

window.onload=startGame();

$(".replayBtn").on("click",function() {
    location.reload();
});