<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login/login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login/login.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="reset-password.css" rel="stylesheet" type="text/css">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- ADMIN NAV BAR [START] -->
    <nav class="nav">
        <div class="nav_container">
            <div class="logo_holder">
                <a id="logo" href="../">
                    <img src="../photos/wma-logo.png" id="logo-img">
                </a>
            </div>
            <div class="redirect">
                <a href="welcome.php"><i class="fas fa-user-circle"></i>Profile</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </div>
    </nav>
    <!-- ADMIN NAV BAR [END] -->
    <div class="container">
        <div class="login_container">
            <h2>Reset Password</h2>
            <div class="form_proper">
                <form 
                    method="post"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >

                    <input 
                        type="password" 
                        id="form-control"
                        name="new_password" 
                        autocomplete="off"
                        placeholder="Username"
                        value="<?php echo $new_password; ?>"
                        class="form-control 
                            <?php
                                echo (!empty($new_password_err)) ? 'is-invalid' : '';
                            ?>" >
                        <span class="invalid-feedback">
                            <?php echo $new_password_err; ?>
                        </span>

                        <input 
                            type="password" 
                            id="form-control"
                            name="confirm_password" 
                            placeholder="Confirm Password"
                            class="form-control 
                                <?php 
                                    echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; 
                                ?>">
                        <span class="invalid-feedback">
                            <?php echo $confirm_password_err; ?>
                        </span>
                    <div class="actions">
                        <input class="submit" type="submit" value="Submit">
                        <a class="cancel" href="welcome.php">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>    
</body>
</html>