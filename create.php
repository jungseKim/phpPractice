<?php
require('lib/print.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
       <title> 
       print_title()
       </title>
</head>
<body>
      
       <h1><a href="index.php">WEB</a></h1>
       <ol>
       <?php 
       script();
       ?>
       </ol>
   <form action="create_process.php" method="POST">
          <p>
              <input type="text" name="title" placeholder="title"> 
          </p> 
          <p>
                 <textarea name="description"></textarea>
           </p>
           <input type="submit">
       </form>
       

       
</body>
</html>