<?php
    include 'inc/header.php';
    
     function getPetList() {
            include '../../dbConnection.php';
            $conn = getDatabaseConnection("c9");


            $sql = "SELECT *
                    FROM adoptees"; 
                    
                            
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $record = $stmt->fetchAll(PDO::FETCH_ASSOC);//expecting only one record
 
            return $record;
        }
?>
  
<script>

    $(document).ready( function(){
        
        $(".petLink").click( function(){
            
            //alert($(this).attr('id'));
            
            $.ajax({

                type: "GET",
                url: "api/getPetInfo.php",
                dataType: "json",
                data: { "id": $(this).attr('id') },
                success: function(data,status) {
                
                   //alert(data);
                   $("#petInfo").html(" Age: " + data.age + "<br>" +
                                      " <img src='img/" + data.pictureURL + "'><br >" + 
                                       data.description);   
                
                },
                complete: function(data,status) { //optional, used for debugging purposes
                //alert(status);
                }
                
            });//ajax
            
            
        }); //.getLink click
        
    });//document.ready

    
</script>            

<?php
    
        $pets = getPetList();
        //print_r($pets);
        
        foreach ($pets as $pet){
            
            echo "Name: ";
            echo "<a href='#' class='petLink' id='".$pet['id']."' >". $pet['name'] . "</a><br>";
            echo "Type: " . $pet['type'] . "<br>";
            echo "<hr><br>";
            
        }

?>

<div id="petInfo"></div> 
        
<?php
    include 'inc/footer.php';
?>