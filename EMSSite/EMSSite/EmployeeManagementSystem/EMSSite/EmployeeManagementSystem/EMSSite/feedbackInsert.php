<?php
include_once 'ServerConnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{    
    //  $FirstName = trim($_POST['FirstName']);
    //  $LastName = trim($_POST['LastName']);
    //  $UserID = trim($_POST['UserID']);
     $FeedBack = trim($_POST['FeedBack']);


    //  $sanitized_FirstName = mysqli_real_escape_string($conn, $FirstName);
    //  $sanitized_LastName = mysqli_real_escape_string($conn, $LastName);
    //  $sanitized_UserID = mysqli_real_escape_string($conn, $UserID);
     $sanitized_FeedBack = mysqli_real_escape_string($db, $FeedBack);


    if (isset($sanitized_FeedBack)) {
      
         $sql = "INSERT INTO feedback (FeedBack) VALUES ('$sanitized_FeedBack')";
		 
		 // Write query and get result
		 $result = mysqli_query($db, $sql);
		}
    if (empty($sanitized_FeedBack)){
      
      $_SESSION['status'] = "Please Enter A feedback";
      header("Location: feedback.php");
    }

    if($result){
        $_SESSION['status'] = "Feedback submitted successfully";
        header("Location: feedback.php");
    }
    else {
        $_SESSION['status'] = "Failed to submit your Feedback. Try again!.";
        header("Location: feedback.php");
    }
        // fetch needed results
        $NewFeedback = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_close($db);
}
?>