<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paystub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body style="margin:100px 300px 100px 100px;">
    <h2>Payment Information</h2>
    <br>
    <table class="table" style = "border: 1px solid black">
        <thead class="table-header" style="background-color: lightgreen;">
            <tr>
                <th>UserName</th>
                <th>Pay Period</th>
                <th>Pay Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'ServerConnection.php';

            $username = $_SESSION['username'];

            $sql = "SELECT PayPeriod, PayDate FROM paystub JOIN login ON paystub.PII_ID = login.PII_ID
                WHERE login.UserName = '$username';";
                
            $sql1 = "SELECT CONCAT(FirstName,' ',LastName) AS Name, Role AS Title, PayPeriod, PayDate From personal_identifying_info
                JOIN paystub ON personal_identifying_info.PII_ID = paystub.PII_ID 
                JOIN login on login.PII_ID = paystub.PII_ID WHERE login.UserName = '$username';";

            $result = mysqli_query($db, $sql);
            if(!$result){
                die("Invalid query: " .mysqli_error());
            }
            $row = $result->fetch_assoc();

            if(!empty($row)){
                echo "<tr>
                <td>$username</td>
                <td> $row[PayPeriod] </td>
                <td> $row[PayDate] </td>
            </tr>";
            }
            else{
                echo "No payment information available for: $username";
            }

            

            /*
            while($row = $result->fetch_assoc()){
                echo "<tr>
                <td> $row[Name] </td>
                <td> $row[Title] </td>
                <td> $row[PayPeriod] </td>
                <td> $row[PayDate] </td>
            </tr>";
            }
            */
            //echo $username;
            ?>
        </tbody>
        <br>
    </table>
    <br>

    <button type="button" class="" onclick="location.href='ManagerLanding.php'">
        <span class="">Main Page</span>
        <span class="">
            <ion-icon name="main-page"></ion-icon>
        </span>
    </button>
</body>
</html>
