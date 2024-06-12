<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="style.css"> 
    <meta charset="utf-8" />
<title>
Home   
</title>
</head>
<body>
    <div class= "full-index">
    <div class="header1">
        <br>
 <h1 >Welcome to Inventory Management System </h1>
 </div>
  <div class="header2">
<h2 ></h2>
</div>
<div class= class="login-form">
<form action="login.php" method="post" >
<fieldset >
    <legend> <b>Please Login to continue </b></legend>
<p><b>username</b></p>
<input type="text" name="username" placeholder="username">
<p><b>password</b></p>
<input type ="password" name="password" placeholder="password">
  <br>
  <br>
    <input type="submit" class= "login-button" name="login" value="login">
    </span>
    <?php if(isset($_SESSION['error'])) { ?>
        <script>
            alert("<?php echo $_SESSION['error']; ?>");
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>
</fieldset>
 </form>
 </div>
 </div>
 <footer>
    Developed By Shihab Mirza
 </footer>
    </body>
</html>
