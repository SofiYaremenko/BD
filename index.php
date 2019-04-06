<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>

 <title>Login</title>
 <link rel="stylesheet" href="styles.css">

</head>
<body>

<div class="topnav"> <a>ExplorUAm</a>
  <a href="main.php">Home</a>
  <a class="active"  href="index.php">Login</a>
  <a href="register.php">Register</a>
</div>


 <div class="header">
    <h2>Login</h2>
  </div>
   
  <form method="post" action="index.php" class="form_regist">
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" >
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password">
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
 </body>
</html>
