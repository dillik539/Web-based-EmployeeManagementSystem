<?php
include_once 'ServerConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{    
     $FirstName = trim($_POST['FirstName']);
     $LastName = trim($_POST['LastName']);
     $UserName = trim($_POST['UserName']);
     $TelNum = trim($_POST['TelNum']);
     $email = trim($_POST['Email']);
     $pass = trim($_POST['Password']);
     $Address = trim($_POST['Address']);
     $CPass = trim($_POST['CPassword']);
    //  $Emp = trim($_POST['Employee']);
    //  $SA = trim($_POST['Site Admin']);
    //  $HR = trim($_POST['HR']);
    //  $Man = trim($_POST['Manager']);
     $Role = trim($_POST['Role']);

     $sanitized_FirstName = mysqli_real_escape_string($db, $FirstName);
     $sanitized_LastName = mysqli_real_escape_string($db, $LastName);
     $sanitized_UserName = mysqli_real_escape_string($db, $UserName);
     $sanitized_TelNum = mysqli_real_escape_string($db, $TelNum);
     $sanitized_email = mysqli_real_escape_string($db, $email);
     $sanitized_pass = mysqli_real_escape_string($db, $pass);
     $sanitized_Address = mysqli_real_escape_string($db, $Address);
	//  $sanitized_Emp = mysqli_real_escape_string($db, $Emp);
	//  $sanitized_Man = mysqli_real_escape_string($db, $Man);
    //  $sanitized_HR = mysqli_real_escape_string($db, $HR);
    //  $sanitized_SA = mysqli_real_escape_string($db, $SA);
     $sanitized_Role = mysqli_real_escape_string($db, $Role);


     if ($sanitized_pass == $CPass){

        // Write query and get result
         $sql1 = "INSERT INTO personal_identifying_information (FirstName,LastName,Address,Email,TelNum,Role)
         VALUES ('$sanitized_FirstName', '$sanitized_LastName', '$sanitized_Address', '$sanitized_email',  '$sanitized_TelNum', '$sanitized_Role' )";
		 
		 $result1 = mysqli_query($db, $sql1);

        //  $sql2 = "INSERT INTO login (UserName,Password,Role)
        //  VALUES ('$sanitized_UserName', '$sanitized_pass', '$sanitized_Role' )";
		 
		//  $result2 = mysqli_query($db, $sql2);
      
      }

      else{
         echo '<script>alert("Your Passwords do not match!! Please try again")</script>';
      }
      if($result1){
         $_SESSION['success'] = "New Account Created Successfully!!";
         header("Location: HRLanding.php");
       }
       else {
           $error = "Account Creation Failed!!! Please Try again.";
           header("Location: InsertNewUser.php");
       }
         // fetch needed results
         $NewUser = mysqli_fetch_all($result1, MYSQLI_ASSOC);

     mysqli_close($db);
}
?>

