<?php
include_once 'ServerConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{    
     $UserName = trim($_POST['UserName']);
     $pass = trim($_POST['Password']);
     $CPass = trim($_POST['CPassword']);
     $Role = trim($_POST['Role']);
     $PiiID = trim($_POST['PII_ID']);

     

     $sanitized_UserName = mysqli_real_escape_string($db, $UserName);

     $sanitized_pass = mysqli_real_escape_string($db, $pass);

     $sanitized_Role = mysqli_real_escape_string($db, $Role);

     $sanitized_PiiID = mysqli_real_escape_string($db, $PiiID);


     if ($sanitized_pass == $CPass){

        // Write query and get result

        $sql = "INSERT INTO Login (CreatorID,PII_ID,UserName,Password,Role)
         VALUES (1, $sanitized_PiiID, '$sanitized_UserName', '$sanitized_pass', '$sanitized_Role' )";
		 
		$result = mysqli_query($db, $sql);
      
      }

      else{
         echo '<script>alert("Your Passwords do not match!! Please try again")</script>';
      }
      if($result1){
         $_SESSION['success'] = "New Login Created Successfully!!";
         header("Location: SiteAdminLanding.php");
       }
       else {
           $error = "Login Creation Failed!!! Please Try again.";
           header("Location: CreateNewLogin.php");
       }
         // fetch needed results
         $NewUser = mysqli_fetch_all($result, MYSQLI_ASSOC);

     mysqli_close($db);
}
?>

