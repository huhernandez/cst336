<?php
    
 function displayFish($randomValue) {
            //$randomValue = rand(0,2);
            switch ($randomValue){
            case 0: $symbol= "tuna";
                    break;
            case 1: $symbol= "salmon";
                    break;
            case 2: $symbol= "unagi";
                    break;
            case 3: $symbol= "avocado";
                    break;
            case 4: $symbol= "cucumber";
                    break;
            case 5: $symbol= "jalapeno";
                    break;
            
            }//endSwitch
            
            echo "<img  src='img/$symbol.jpg' alt='$symbol' title='$symbol'  /> ";
            echo '<h2>'.$symbol.'</h2>';
            
        }
        


function showme(){
            
              ${"randomValue". $i } = rand(0,2);
              displayFish(${"randomValue" . $i});
              ${"randomValue". $i } = rand(3,5);
              displayFish(${"randomValue" . $i});
             
            
        }
function bkg(){
        $back = array("chef","mat", "chopsticks");
        shuffle($back);
        echo "<img src='../img/$back.jpg'/>";
}


?>