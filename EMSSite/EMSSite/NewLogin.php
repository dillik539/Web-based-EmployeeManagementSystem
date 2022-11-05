<?php
require_once "ServerConnection.php";
include_once "CreateNewLogin.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

      body {
        font-family: Calibri, Helvetica, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .container {
        padding: 50px;
        background-color:#DCDCDC;
      }

      input[type=tel],
      input[type=email],
      input[type=text],
      input[type=password],
      textarea {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
        border-radius: 4px;
        box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
      }

      div {
        padding: 10px 0;
      }

      hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
      }

      .registerbtn {
        background-color: #0066A2;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
      }

      .registerbtn:hover {
        background-color: #45a049;
      }

      input[type=submit] {
        background-color: #0066A2;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
      }

      input[type=submit]:hover {
        background-color: #45a049;
      }
    </style>
  </head>
  <body>
    <form action="CreateNewLogin.php" method="POST">
      <div class="container">
        <center>
          <h1> Insert New User</h1>
        </center>
        <hr>
        <label> Personal Identifying Number: </label>
        <input type="number" name="PII_ID" placeholder="PII_ID #" min="0" required />
        <br>
        <br>
        <label> Username: </label>
        <input type="text" name="UserName" placeholder="Username" size="15" required />
        <div>
        <div>
          <label> Role : </label>
          <select name="Role">
            <option value="Employee" name="Role">Employee</option>
            <option value="Site Admin" name="Role">Site Admin</option>
            <option value="HR" name="Role">HR</option>
            <option value="Manager" name="Role">Manager</option>
          </select>
        </div>
        <br>
          <label for="psw">
            <b>Password</b>
          </label>
          <input type="password" placeholder="Enter Password" name="Password" required>
          <label for="psw-repeat">
            <b>Confirm Password</b>
          </label>
          <input type="password" placeholder="Retype Password" name="CPassword" required>
          <input type="submit" class="registerbtn" name="Register" >
    </form>
  </body>
</html>