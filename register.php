<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$email = $firstname = $lastname = $passport_num = $fname = $phone = "";
$birthday = date("Y-m-d");

$username_err = $password_err = $confirm_password_err = $passport_err = $lastname_err = $fname_err = $firstname_err = $email_err = $birthday_err = $phone_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id_client FROM clients WHERE cl_login = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);
            /*$param_password = trim($_POST["password"]);
            $param_type = "user_type";
            $param_surname = trim($_POST["lastname"]);
            $param_name = trim($_POST["firstname"]);
            $param_fname = "";
            $param_passport = trim($_POST["passport_num"]);
            $param_birthday = trim($_POST["birthday"]);
            $param_email = trim($_POST["email"]);
            $param_phone = trim($_POST["phone"]);*/

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    if(empty(trim($_POST["email"]))){
        $email_err = "Email is required.";
    } else{
        $email = trim($_POST["email"]);
    }
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Firstname is required.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }
    if(empty(trim($_POST["lastname"]))){
        $lastname_err = "Lastname is required.";
    } else{
        $lastname = trim($_POST["lastname"]);
    }
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Second name is required.";
    } else{
        $fname = trim($_POST["fname"]);
    }
    if(empty(trim($_POST["birthday"]))){
        $birthday_err = "Birthday is required.";
    } else{
        $birthday = trim($_POST["birthday"]);
    }
    if(empty(trim($_POST["passport_num"]))){
        $passport_err = "Passport number is required.";
    } else{
        $passport_num = trim($_POST["passport_num"]);
    }
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Phone is required.";
    } else{
        $phone = trim($_POST["phone"]);
    }
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)
        && empty($email_err) && empty($fname_err) && empty($firstname_err)&& empty($lastname_err)
        && empty($phone_err) && empty($birthday_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO clients (cl_login, cl_password, user_type, cl_surname, cl_name, cl_fname, passport_n, birthday, email, cl_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssss", $param_username,$param_password, $param_type,
                $param_surname,$param_name, $param_fname, $param_passport, $param_birthday, $param_email,$param_phone);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_type = "user";
            $param_surname = $lastname;
            $param_name = $firstname;
            $param_fname = $fname;
            $param_passport = $passport_num;
            $param_birthday = $birthday;
            $param_email = $email;
            $param_phone = $phone;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "stmt error :  " . (mysqli_stmt_error($stmt));
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
     <link rel="stylesheet" href="styles.css">

    
</head>
<body>
<div class="topnav"> <a>ExplorUAm</a>
    <a href="main.php">Home</a>
    <a href="login.php">Login</a>
    <a class="active"  href="register.php">Register</a>
</div>

<div class="wrapper">
    <div class="header">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form_regist">
        <div class="input-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
            <label>Surname</label>
            <input type="text" name="lastname" class="form-control" value="<?php echo $lastname; ?>">
            <span class="help-block"><?php echo $lastname_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
            <span class="help-block"><?php echo $firstname_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
            <label>Second Name</label>
            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
            <span class="help-block"><?php echo $fname_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($passport_err)) ? 'has-error' : ''; ?>">
            <label>Passport Number</label>
            <input type="text" name="passport_num" class="form-control" value="<?php echo $passport_num; ?>">
            <span class="help-block"><?php echo $passport_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($birthday_err)) ? 'has-error' : ''; ?>">
            <label>Birthday</label>
            <input type="text" name="birthday" class="form-control" value="<?php echo $birthday; ?>">
            <span class="help-block"><?php echo $birthday_err; ?></span>
        </div>

        <div class="input-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
            <span class="help-block"><?php echo $phone_err; ?></span>
        </div>
        <div class="input-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="input-group">
            <input type="submit" class="btn" value="Submit">
            <input type="reset" class="btn" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>