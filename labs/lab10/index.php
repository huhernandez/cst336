<?php

  //print_r($_FILES);
  //echo "File size " . $_FILES['myFile']['size'];
  
  if ($_FILES['myFile']['size']< 1000000){
    move_uploaded_file($_FILES["myFile"]["tmp_name"], "gallery/" . $_FILES["myFile"]["name"] );
  }
  else{
      echo "File must be under 1MB!";

  }
 
  $files = scandir("gallery/", 1);
 // print_r($files);
  
  

?>




<!DOCTYPE html>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <title> Lab 10: Photo Gallery </title>
        
    </head>
    <body>
    <div id="pageone" data-role="main" class="ui-content">
    <h2> Photo Gallery </h2>
    <form method="POST" enctype="multipart/form-data"> 


        <input type="file" name="myFile" /> 
        
        <input type="submit" value="Upload File!" />

    </form>
    
    <div id="thumbnail-container" >
        <?php
            for ($i = 0; $i < count($files) - 2; $i++) {
                echo "<img  class= 'thumbnail' src='gallery/" .   $files[$i] . "' width='50' >";
            }
        
        ?>
    </div>
    
    <div id="container">
            <img id="large" src="" width='100'/>
            

        </div>
        
    
  </div>

    </body>
    </div>
    <script>
            $(function() {
 $('.thumbnail').click(function(e){
  e.preventDefault();
 $("#large").attr('src',$(this).attr("src"));
 alert(this.src);
 });
});
        </script>

</html>