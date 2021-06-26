<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
      
       <h1>WEB</h1>

       <ol>
       <li><a href="index.php?id=html">html</a></li>
       <li><a href="index.php?id=CSS">css</a></li>
       <li><a href="index.php?id=javaScript">javaScript</a></li>
       </ol>

       <h2>
       <?php 
       echo $_GET['id'];
       ?>
       </h2>

       Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
       sed do eiusmod tempor incididunt ut labore et dolore magna
       aliqua. Ut enim ad minim veniam, quis nostrud exercitation
       ullamco laboris nisi ut aliquip ex ea commodo consequat. 
       Duis aute irure dolor in reprehenderit in voluptate velit 
       illum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
       cupidatat non proident, sunt in culpa qui o
       fficia deserunt mollit anim id est laborum

</body>
</html>