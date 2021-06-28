<?php

//같은 코드 중복되면 에러남 그럴때는 require_once 를쓰면 됨
require('lib/print.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
       <title> 
       <?php 
       print_title();
       ?>
       </title>
</head>
<body>
      
       <h1><a href="index.php">WEB</a></h1>
       <ol>
       <?php 
       script();
       ?>
       </ol>
       <a href="create.php">create</a>
       <?php  if(isset($_GET['id'])){ ?>
              <a href="update.php?id=<?php echo $_GET['id']; ?>">update</a>
              <form action="delte_process.php" method="post"> 
              <input type="hidden" name="id" value="<?=$_GET['id']?>">
              <input type="submit" value="delete">
              </form>

       <?php } ?>
       
       

       <h2>
       <?php 
          print_title()
       ?>
       </h2>

       <?php 
      script2();
       ?>

       
<?php 
require('lib/bottom.php');
?>