var words = [{word:"snake", hint:"It's a reptile."},
            {word:"monkey",hint:"It's a mammal"},
            {word: "beetle",hint:"It's an insect"},
            {word:"chipmunk",hint:"It's a rodent"},
            {word: "mantis",hint:"It's an insect"}];
            
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                
var selectedWord = "";
var selectedHint = "";
var board = "";
var remainingGuesses = 6;
            
window.onload=startGame();

$(".replayBtn").on("click",function() {
    location.reload();
                
});

$("#letters").on("click",".letter", function(){
    //alert($(this).attr("id"));
    checkLetter($(this).attr("id"));
    disableButton($(this));
                
});

function pickWord() {
   var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
    console.log(selectedWord);
}

$("#letterBtn").click(function(){
        //updateImage();
        var boxVal = $("#letterBox").val();
        alert(boxVal);
});
            
function createLetters(){
    
    for (var letter of alphabet) {
        
        $("#letters").append("<button class='letter','btn', 'btn-success' id='"+letter+"'>" + letter + "</button>");
    }
    
}

function initBoard() {
    for (var i=0; i<selectedWord.length; i++) { //similar loop in tutorial
        
        board += "_";
    }
    console.log(board);
}

function updateBoard() {
    $("#word").empty();
    
    for (var letter of board){
         document.getElementById("word").innerHTML += letter + " ";
    }
    $("#word").append("<br />");
    $("#word").append("<span class='hint'>Hint: " + selectedHint+ "</span>")
}

function updateWord(positions, letter){
    for (var pos of positions){
        board = replaceAt(board, pos, letter)
    }
    updateBoard(board);
    if (!board.includes('_')) {
        endGame(true);
    }
}

function checkLetter(letter) {
    
    var positions = new Array();
    
    // Put all the positions the letter exists in an array
    for (var i = 0; i < selectedWord.length; i++) {
        if (letter == selectedWord[i]) {
            positions.push(i);
        }
    }
    if(positions.length>0){
        updateWord(positions, letter);
        
    } else {
        
        remainingGuesses--;
        $("#hangImg").attr("src", "img/stick_"+(6-remainingGuesses)+".png");
    }
    if(remainingGuesses<=0){
        endGame(false);
    }
}
        
// function updateImage(){
//     // document.getElementById("man").innerHTML="<img src='img/stick_0.png'>"
//     $("img").attr("src","img/stick_3.png");
// }




function startGame() {
    
    pickWord();
    createLetters();
    initBoard();
    updateBoard();
    
}

function endGame(win){
    $("#letters").hide();
    if(win){
        $('#won').show();
    }else{
        $('#lost').show();
    }
}

function disableButton(btn){
    btn.prop("disabled",true);
    btn.attr("class","btn btn-danger")
}

//helper function for replacing specific indexes in a string
function replaceAt(str, index, value){
    return str.substr(0, index) + value + str.substr(index + value.length);
}