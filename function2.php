<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
       <h1>function</h1>
       <h2>Basic</h2>
       <?php
       function basic(){
              echo "hellow function";
       }
       basic();
       echo "<br>";
       ?>

       <?php 
       function sum($a,$b){
              return $a+$b;
       }
       echo sum(1,2);
       file_put_contents("temp.txt",sum(1,2));
       echo "<br>";

       function sum2(... $a){
              $sum=0;
              for($i=0;$i<count($a);$i++){
                     $sum+=$a[$i];
              }
              echo $sum;
       }
       sum2(1,2,3,4,5);

       ?>



</body>
</html>