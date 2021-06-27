<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>

       <?php
       $var=array(1,"two","there","four");//다른 대이터 타입도 가능
       
       array_push($var,33,44);//제일 뒤에 추가
       array_pop($var);//제일 마지막
       array_shift($var);//재일앞에 제거
       array_unshift($var,"unshift");//제일 앞에 추가
       
       for($let=0;$let<count($var);$let++){
              echo var_dump($var[$let]);
       }
       ?>


</body>
</html>