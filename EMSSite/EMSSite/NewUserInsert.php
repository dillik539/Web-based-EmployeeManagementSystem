<?php
include_once 'ServerConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{    
     $FirstName = trim($_POST['FirstName']);
     $LastName = trim($_POST['LastName']);
     $DOB = trim($_POST['DOB']);
    //  $UserName = trim($_POST['UserName']);
     $TelNum = trim($_POST['TelNum']);
     $email = trim($_POST['Email']);
    //  $pass = trim($_POST['Password']);
     $Address = trim($_POST['Address']);
    //  $CPass = trim($_POST['CPassword']);
     $SSN = trim($_POST['SocialSecurity']);
    //  $Emp = trim($_POST['Employee']);
    //  $SA = trim($_POST['Site Admin']);
    //  $HR = trim($_POST['HR']);
    //  $Man = trim($_POST['Manager']);
    //  $Role = trim($_POST['Role']);

     

     $sanitized_FirstName = mysqli_real_escape_string($db, $FirstName);
     $sanitized_LastName = mysqli_real_escape_string($db, $LastName);
     $sanitized_DOB = mysqli_real_escape_string($db, $DOB);
    //  $sanitized_UserName = mysqli_real_escape_string($db, $UserName);
     $sanitized_TelNum = mysqli_real_escape_string($db, $TelNum);
     $sanitized_email = mysqli_real_escape_string($db, $email);
    //  $sanitized_pass = mysqli_real_escape_string($db, $pass);
     $sanitized_Address = mysqli_real_escape_string($db, $Address);
     $sanitized_SSN = mysqli_real_escape_string($db, $SSN);
	//  $sanitized_Emp = mysqli_real_escape_string($db, $Emp);
	//  $sanitized_Man = mysqli_real_escape_string($db, $Man);
    //  $sanitized_HR = mysqli_real_escape_string($db, $HR);
    //  $sanitized_SA = mysqli_real_escape_string($db, $SA);
    //  $sanitized_Role = mysqli_real_escape_string($db, $Role);


     if ($sanitized_FirstName == $FirstName){

        // Write query and get result
        $sql1 = "INSERT INTO Personal_Identifying_Info (FirstName,LastName,DateOfBirth,SSN,Address,PhoneNo,Email)
        VALUES ('$sanitized_FirstName', '$sanitized_LastName', '$sanitized_DOB', '$sanitized_SSN', '$sanitized_Address', '$sanitized_TelNum', '$sanitized_email')";
        
        $result1 = mysqli_query($db, $sql1);

        // Write query and get result
        $sql2 = "SELECT PII_ID FROM Personal_Identifying_Info WHERE SSN = '$SSN' ";

        $result2 = mysqli_query($db, $sql2);

        if(!$result2) {
            die("Invalid Query: ". $error);
        }

        //reading each row
        while($row = mysqli_fetch_array($results2)) {

            $PiiID = $row["PII_ID"];
        }


        // $sql2 = "INSERT INTO Login (CreatorID,UserName,Password,Role)
        //  VALUES (1, '$sanitized_UserName', '$sanitized_pass', '$sanitized_Role' )";
		 
		// $result2 = mysqli_query($db, $sql2);
      
      }

      else{
         echo '<script>alert("Something Went Wrong with First Name! try again")</script>';
      }
      if($result1){
         $_SESSION['success'] = "New Account Created Successfully!!";
         header("Location: NewUserCreated.php");
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

