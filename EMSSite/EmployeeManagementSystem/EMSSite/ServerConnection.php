<?php
session_start();

//initializ variables
$username = "";
$errors = array();

// database connection
$db= mysqli_connect('localhost', 'root', '', 'ems');

// login
if (isset($_POST['user_login'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {

    array_push($errors, "Username is required");

  }
  if (empty($password)) {

    array_push($errors, "password is required");

  }

  if(count($errors) == 0) {

    $password = $password;
    $query = "SELECT * FROM employee WHERE username = '$username' AND password = '$password'";
    $results = mysqli_query($db, $query);

    if(mysqli_num_rows($results) == 1) {

      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You have successfully logged in";

      header('location: landing.php');
    }
    else{

      array_push($errors, "Your have entered a wrong Username or Password");
    }
  }


}
  
?>