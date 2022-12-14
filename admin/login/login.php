<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../admin.php");
    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: ../admin.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <div class="login_container">
            <div class="login_title">
                <div class="title_logo">
                    <a href="https://westmigrationagency.com/">
                        <img src="../../photos/wma-logo.png">
                    </a>
                    <h2>Admin Login</h2>
                </div>
            </div>
            <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }        
            ?>
            <div class="form_proper">
                <form 
                    name="login"
                    method="post"
                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  >
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        autocomplete="off"
                        placeholder="Username"
                        value="<?php echo $username; ?>"
                        class="form-control 
                            <?php 
                                echo (!empty($username_err)) ? 'is-invalid' : '';
                            ?>" 
                        >
                    <span class="invalid-feedback">
                        <?php echo $username_err; ?>
                    </span>

                    <input 
                        value=""
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="off"
                        placeholder="Password"
                        value="<?php echo $password; ?>"
                        class="form-control 
                            <?php 
                                echo (!empty($password_err)) ? 'is-invalid' : '';
                            ?>" 
                        >
                    <span class="invalid-feedback">
                        <?php echo $password_err; ?>
                    </span>

                    <button 
                        id="submit"
                        name="submit"
                        type="submit"
                        onclick="resetForm()">
                        LOGIN
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>