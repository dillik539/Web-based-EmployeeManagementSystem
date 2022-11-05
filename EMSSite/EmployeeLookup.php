<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmployeeInfo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body style="margin:100px 600px 100px 200px;">
    <h2>Employee Information</h2>
    <br>
    <table class="table" style = "border: 1px solid black">
        <thead class="table-header" style="background-color: lightgreen;">
            <tr>
                <th>EmployeeID</th>
                <th>FirstName</th>
                <th>LastName</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once 'ServerConnection.php';

            $sql = "SELECT UserID, FirstName, LastName From Employee
                JOIN personal_identifying_info ON Employee.PII_ID = personal_identifying_info.PII_ID;";

            $result = mysqli_query($db, $sql);
            if(!$result){
                die("Invalid query: " .mysqli_error());
            }
            while($row = $result->fetch_assoc()){
                echo "<tr>
                <td> $row[UserID] </td>
                <td> $row[FirstName] </td>
                <td> $row[LastName] </td>
            </tr>";
            }
            
            ?>
        </tbody>
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
