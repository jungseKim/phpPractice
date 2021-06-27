<?php 
function print_title(){
       if(isset($_GET['id'])){
              echo $_GET['id'];
       }else{
              echo '아이디 null';
       };
}
function script(){
       $dir=scandir("./data");
       $i=0;
       while($i<count($dir)){
             if($dir[$i]!="."&&$dir[$i]!=".."){
              echo "<li><a href=\"index.php?id=$dir[$i]\">$dir[$i]</a></li>";
             }
              $i++;
       }
}

function script2(){
       if(isset($_GET['id'])){
              echo file_get_contents("./data/".$_GET['id']);
       }else{
              echo '아이디 null';
       };
}

?>