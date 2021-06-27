<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
       <?php 
       // echo '<script>alert("바보");</script>';
       echo htmlspecialchars('<script>alert("바보");</script>');
       //확실하게 문자열로 바궈줌
       ?>
</body>
</html>