<!DOCTYPE html>
<!DOCTYPE html>
<?php
    function getRandomColor(){
        
        return "rgba(".rand(0,255).", ".rand(0,255).", ".rand(0,255).", ".(rand(0,10) *.1).");";
    }

?>

<html>
    <head>
        <title> Random background color</title>
        <meta charset="utf-8"/>
        
        <style>
        
            body{
                /*background-color: rgba(100, 200, 50, .6 ); */
                
                <?php
                
                $red = rand(0,255);
                $green = rand(0,255);
                $blue = rand(0,255);
                $alpha = rand(0,10) *.1;
                echo "background-color: rgba(".rand(0,255).", ".rand(0,255).", ".rand(0,255).", ".(rand(0,10) *.1).");";
                
                
                ?>
            }
            
            h1 {
                
                <?php
                
                echo "color:" .getRandomColor();
                echo "background-color;" . getRandomColor();
                
                ?>
            }
            
            h2 {
                color: <?=getRandomColor()?>
                background-color: <?=getRandomColor()?>
            }
            
        </style>
    </head>
    <body>
    <h1>Welcome!</h1>
    
    <h2> ¡Hola!</h2>
        
    </body>
    
</html>