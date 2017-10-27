<!DOCTYPE html>
<?php
    // include 'functions.php';
    
    function yearList($start, $end){
        
        $zodiac = array("rat","ox","tiger","rabbit","dragon","snake","horse","goat","monkey","rooster","dog","pig");

        
        global $sum;
        $val;
        $cnt=0;
        
        for($start; $start <= $end; $start++){
            $sum += $start;
            if ($start % 4 == 0){
                echo "<li> Year $start ";
                if ($start == 1776){
                    echo "USA INDEPENDENCE";
                }
                if ($start % 100 == 0){
                    echo "HAPPY NEW CENTURY";
                }
                if ($start>=1900){
                    $val= $cnt %12;
                    $cnt++;
                }
             
            echo " </li>";
            displaySymbol($val );
            }
            
           
        }
        echo "Year Sum: $sum";
       
    }
    
     function displaySymbol($val) {
            //$randomValue = rand(0,2);
            switch ($val){
            case 0: $symbol= "rat";
                    break;
            case 1: $symbol= "ox";
                    break;
            case 2: $symbol= "tiger";
                    break;
            case 3: $symbol= "rabbit";
                    break;
            case 4: $symbol= "dragon";
                    break;
            case 5: $symbol= "snake";
                    break;
            case 6: $symbol= "horse";
                    break;
            case 7: $symbol= "goat";
                    break;
            case 8: $symbol= "monkey";
                    break;
            case 9: $symbol= "rooster";
                    break;
            case 10: $symbol= "dog";
                    break;
            case 11: $symbol= "pig";
                    break;        
            }//endSwitch
            
            echo "<img  src='img/$symbol.png' alt='$symbol' title='$symbol' /> ";
            
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Practice Chinese Zodiac List</title>
    </head>
    <body>
        <h1>Chinese Zodiac List</h1>
        
        <ul>
            
            <?=yearList(1900, 2000) ?>
        </ul>
    </body>
</html>