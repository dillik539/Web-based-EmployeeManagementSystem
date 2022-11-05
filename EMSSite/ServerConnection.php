<?php
session_start();

//initializ variables
$username = "";
$errors = array();

// database connection
$db= mysqli_connect('localhost', 'root', '', 'ems');
if(!$db){
  die('Could not Connect to DB: '. mysql_error());
}

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
    $query = "SELECT * FROM Login WHERE username = '$username' AND password = '$password'";
    $query1 = "SELECT role FROM Login WHERE username = '$username' AND password = '$password'";

    $results = mysqli_query($db, $query);
    $results1 = mysqli_query($db, $query1);
    $count=mysqli_num_rows($results);
    
    if($count == 1) {

      $role = mysqli_fetch_array($results1);

      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You have successfully logged in";
      $_SESSION['role'] = $role;
      
      
      if(isset($username) && $role[0] == 'Employee'){
        header('Location: EmployeeLanding.php');
        exit();
      }
      elseif(isset($username) && $role[0] == 'Manager'){
        header('Location: ManagerLanding.php');
        exit();
      }
      elseif(isset($username) && $role[0] == 'HR'){
        header('Location: HRLanding.php');
        exit();
      }
      elseif(isset($username) && $role[0] == 'SiteAdmin'){
        header('Location: SiteAdminLanding.php');
        exit();
      }
    }
    else{

      array_push($errors, "Your have entered a wrong Username or Password");
    }

  }
}
  
?>