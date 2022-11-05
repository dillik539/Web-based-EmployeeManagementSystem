<?php
require_once "ServerConnection.php";

$UserName = trim($_POST['UserName']);


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // save

    // User
    $result=mysqli_query($db,"SELECT 1 FROM login/or/employee WHERE UserName = $UserName");
    $sql = "";

    if (mysqli_num_rows($result) > 0){

        $sql = "
            UPDATE --Tabel-- SET
                FirstName = ?
                ,LastName = ?
                ,TelNum= ?
                ,Email = ?
                ,Address = ?
                ,SocialSecurity = ?
                ,UserName = ?
                ,Role = ?
                ,Password = ?
            WHERE UserName = ? ";
            
//important to update the sequance of the list of updated thing to match the DB
    }else {
        $sql = "
        INSERT INTO --Table-- (FirstName, LastName, TelNum, Email, Address, .......)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    }
    
    if($stmt = mysqli_prepare($db, $sql)){
 
        mysqli_stmt_bind_param($stmt, "ssisi", $FirstName,$LastName,$TelNum,$email,$SSN,.......);
        $FirstName = trim($_POST['FirstName']);
        $LastName = trim($_POST['LastName']);
        $UserName = trim($_POST['UserName']);
        $TelNum = trim($_POST['TelNum']);
        $email = trim($_POST['Email']);
        $pass = trim($_POST['Password']);
        $Address = trim($_POST['Address']);
        $SSN = trim($_POST['SocialSecurity']);
       //  $Emp = trim($_POST['Employee']);
       //  $SA = trim($_POST['Site Admin']);
       //  $HR = trim($_POST['HR']);
       //  $Man = trim($_POST['Manager']);
        $Role = trim($_POST['Role']);
     

        if(mysqli_stmt_execute($stmt)){
    
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Other info that can be in other tables that needs updating
    $result=mysqli_query($db,"SELECT 1 FROM --Table-- WHERE UserName = $UserName");
    $sql = "";
    if (mysqli_num_rows($result) > 0){
        $sql = "
        UPDATE --Table-- SET
        lalala = ?
        ,lalalala = ?
        WHERE UserName = ?;
        ";
    }else {
        $sql = "
        INSERT INTO --Table-- (lalaal, lalala, lala, UserName maybe or the userID)
        VALUES (?, ?, ?, ?);";
    }
  
    if($stmt = mysqli_prepare($db, $sql)){

        mysqli_stmt_bind_param($stmt, "ssii", $lala, $lalala,$UserName);

        $lala = str_replace("-", "", $_POST["lalala"]);
        $lalala = $_POST["lalala"];
        $lalala = $_POST["lalala"];
        $lalala = $_POST["lalala"];
        
        if(mysqli_stmt_execute($stmt)){
            
        } else{
            echo "Oops! Something went wrong. Please try again later. " . mysqli_error($db);
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    header("location: UpdateUser.php");
    exit;

}else{
    // get

    // user info
    $sql = "SELECT FirstName, LastName, TelNum, .....  FROM --Table-- WHERE UserName = ? ";
    if($stmt = mysqli_prepare($db, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i/or/s", $UserID or $UserName);

        if(mysqli_stmt_execute($stmt)){
            
            mysqli_stmt_store_result($stmt);
                
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                
                mysqli_stmt_bind_result($stmt, $FirstName, $LastName, $TelNum, $email, ...);
                if(mysqli_stmt_fetch($stmt)){
                }
                
            } else{
                // email doesn't exist, display a generic error message
                echo  "Invalid email or password.";
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Other info to update in another Table
    $sql = "SELECT lala, lalala  FROM --Table-- WHERE UserName or UserID IDK we will see when the time comes = ? ";
    if($stmt = mysqli_prepare($db, $sql)){
    
        mysqli_stmt_bind_param($stmt, "i/or/s", $UserID or $UserName);

        if(mysqli_stmt_execute($stmt)){
            
            mysqli_stmt_store_result($stmt);
                
            if(mysqli_stmt_num_rows($stmt) == 1){                    
                
                mysqli_stmt_bind_result($stmt, $lala, $lalala);
                if(mysqli_stmt_fetch($stmt)){

                
                }
            } 
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        mysqli_stmt_close($stmt);
    }
}

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
    <form action="NewUserInsert.php" method="POST">
      <div class="container">
        <center>
          <h1> Insert New User</h1>
        </center>
        <hr>
        <label> First name </label>
        <input type="text" name="FirstName" placeholder="Firstname" value="<?php echo $FirstName;   ?>" size="15" required />
        <label> Lastname: </label>
        <input type="text" name="LastName" placeholder="Lastname" value="<?php echo $LastName;   ?>" size="15" required />
        <label> Username: </label>
        <input type="text" name="UserName" placeholder="Username" value="<?php echo $UserName;   ?>" size="15" required />
        <label> Social Security Number: </label>
        <input type="text" name="SocialSecurity" placeholder="Expected pattern is ###-##-####" value="<?php echo $SSN;   ?>" size=" 15" required pattern="^d{3}-d{2}-d{4}$" />
        <div>
        <div>
          <label> Role : </label>
          <select name="Role">
            <option value="Employee" name="Role"<?php if($Role=="Employee") echo "selected=\"selected\""; ?>>Employee</option>
            <option value="Site Admin" name="Role" <?php if($Role=="Site Admin") echo "selected=\"selected\""; ?>>Site Admin</option>
            <option value="HR" name="Role" <?php if($Role=="HR") echo "selected=\"selected\""; ?>>HR</option>
            <option value="Manager" name="Role" <?php if($Role=="Manager") echo "selected=\"selected\""; ?>>Manager</option>
          </select>
        </div>
        <div> Phone : </label>
          <input type="tel" name="TelNum" placeholder="phone #" value="<?php echo $TelNum;   ?>" size="10" / required>
          <br>
          <br>
          <br>
          <label for="address">Current Address :
          </label>
          <textarea cols="80" name="Address" rows="5" placeholder="Current Address" value="address" value="<?php echo $Address;   ?>" required></textarea>
          <label for="email">
            <b>Email</b>
          </label>
          <input type="email" placeholder="Enter Email" name="Email" value="<?php echo $email;   ?>" required>
          <label for="psw">
            <b>Reset Password</b>
          </label>
          <input type="password" placeholder="Enter Password" name="Password" required>
          <input type="submit" class="registerbtn" name="Register" >
    </form>
  </body>
</html>