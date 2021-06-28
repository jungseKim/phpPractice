<?php
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
      
       <h2>
       <?php 
          print_title()
       ?>
       </h2>


       <form action="update_process.php" method="POST">
              <input type='hidden' name='old_name' value="<?php echo $_GET['id'];?>">
          <p>
              <input type="text" name="title" placeholder="title"
              value=<?php print_title(); ?>> 
          </p> 
          <p>
                 <textarea name="description" ><?php script2(); ?>
                 </textarea>
           </p>
           <input type="submit">
       </form>
       

       
</body>
</html>