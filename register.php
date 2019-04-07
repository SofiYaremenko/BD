<?php 
include("functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Registration</title>
</head>
<body>
<div class="topnav"> <a>ExplorUAm</a>
  <a href="main.php">Home</a>
  <a href="login.php">Login</a>
  <a class="active" href="register.php">Register</a>
</div>

<div class="header">
  <h2>Register</h2>
</div>
<form method="post" action="register.php" class="form_regist">
 
  <div class="input-group"  align="center">
    <label>Username</label>
    <input type="text" name="username" value="<?php echo $username; ?>">
  </div>
  <div class="input-group"  align="center">
    <label>Email</label>
    <input type="email" name="email" value="<?php echo $email; ?>">
  </div>
  <div class="input-group"  align="center">
    <label>First Name</label>
    <input type="text" name="firstname">
  </div>
  <div class="input-group"  align="center">
    <label>Last Name</label>
    <input type="text" name="lastname">
  </div>
  <div class="input-group"  align="center">
    <label>Phone</label>
    <input type="tel" name="phone">
  </div>
  <div class="input-group"  align="center">
    <label>Birthday</label>
    <input type="date" name="birthday">
  </div>
  <div class="input-group"  align="center">
    <label>Password</label>
    <input type="password" name="password_1">
  </div>
  <div class="input-group"  align="center">
    <label>Confirm password</label>
    <input type="password" name="password_2">
  </div>
  <div class="input-group" align="center">
    <button type="submit" class="btn" name="register_btn">Register</button>
  </div>
  <p>
    Already a member? <a href="login.php">Log in</a>
  </p>
</form>
</body>
</html>