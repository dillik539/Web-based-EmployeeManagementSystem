<?php
// // Include config file
// require_once "ServerConnection.php";
// session_start();
// include ("ServerConnection.php");
// // initializing variables
// // $username = "";
// // $password = "";
// // $errors = array();
// $username = $password = "";
// $username_err = $password_err = $login_err = "";
// // LOGIN USER
// if (isset($_POST['signin-button'])) {
//     $username = mysqli_real_escape_string($db, $_POST['username']);
//     $password = mysqli_real_escape_string($db, $_POST['password']);
  
//     if (empty($username)) {
//         array_push($username_err = "Username is required");
//     }
//     if (empty($password)) {
//         array_push($password_err = "Password is required");
//     }
  
//     if(empty($username_err) && empty($password_err)) {
//         $password = md5($password);
//         $query = "SELECT * FROM employee WHERE username = '$username' AND password='$password'";
//         $results = mysqli_query($db, $query);
//         if (mysqli_num_rows($results) == 1) {
//           $_SESSION['username'] = $username;
//           $_SESSION['success'] = "You are now logged in";
//           header("location: landing.php");
//         }else {
//             array_push($errors, "Wrong username or password");
//         }
//     }
//   }
  
?>

<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to their profile page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: landing.php");
    exit;
}
// Include config file
require_once "ServerConnection.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['signin-button'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        // Check if username is empty
        if(empty(trim($_POST[$username]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST[$username]);
        }
        // Check if password is empty
        if(empty(trim($_POST[$password]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST[$password]);
        }
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT UserID, UserName FROM employee WHERE UserName = ? AND Password = ?";
            if($stmt = mysqli_prepare($db, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ss", $param_username,$param_password);
    
                // Set parameters
                $param_username = $username;
                $param_password = $password;
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    // Check if username$username exists, if yes then verify password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $UserID, $username);
                        if(mysqli_stmt_fetch($stmt)){
                            //if(password_verify($password)){
                                // Password is correct, so start a new session
                                session_start();
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["UserID"] = $UserID;
                                $_SESSION["username"] = $username;                            
                                // Redirect user to welcome page
                                header("location: landing.php");
                            // } else{
                            //     // Password is not valid, display a generic error message
                            //     $login_err = "Invalid username$username or password.";
                            // }
                        }
                    } else{
                        // username doesn't exist, display a generic error message
                        $login_err = "Invalid username or password.";
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    }
}


?>
