<?php
// Include config file
include "ServerConnection.php";
include "feedbackInsert.php";
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h2>FEEDBACK FORM</h2>
<div class="container">
  <form action="feedbackInsert.php" method="POST">
    <!-- Failed Message getting fed from feedbackInsert.php -->
    <?php
      if(isset($_SESSION['status']))
      {
        echo "<h4>".$_SESSION['status']."</h4>";
        unset($_SESSION['status']);
      }
    ?>
    <!-- <div class="row">
      <div class="col-25">
        <label for="fname">First Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="firstname" placeholder="Your name...">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Last Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="Your last name...">
      </div>
    </div>
    <div class="row">
        <div class="col-25">
          <label for="empid"> Employee Id</label>
        </div>
        <div class="col-75">
          <input type="empid" id="email" name="empid" placeholder="Your employee id..">
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-25">
        <label for="feed_back">Provide your Feedback Anonymously</label>
      </div>
      <div class="col-75">
        <textarea id="FeedBack" name="FeedBack" placeholder="Write something.." style="height:200px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>
</body>
</html>