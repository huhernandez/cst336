<!DOCTYPE html>
<html>
    <head>
        <title> Random Card Game </title>
        <meta charset="utf-8"/>
    </head>
    <body>
        <?php
        
        function displaySymbol($randomValue) {
            //$randomValue = rand(0,2);
            switch ($randomValue){
            case 0: $symbol= "seven";
                    break;
            case 1: $symbol= "lemon";
                    break;
            case 2: $symbol= "grapes";
                    break;
            case 3: $symbol= "orange";
                    break;
            }//endSwitch
            
            echo "<img src='img/$symbol.png' alt='$symbol' title='$symbol' width='70' /> ";
            
        }
        
        
        for($i=1; $i<4; $i++){
            ${"randomValue". $i } = rand(0,2);
            displaySymbol(${"randomValue" . $i});
        }
        
        echo "<h2>" . $randomValue1 . " " . $randomValue2 . " " . $randomValue3 . " </h2>"
        
    
        ?>

    



    </body>
</html>