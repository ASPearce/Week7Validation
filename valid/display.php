<!DOCTYPE html>
<html>
<head>
<title>Display Users</title>
</head>
<body>
<?php
include 'connect.php';

$sql = "SELECT ID, Firstname, Lastname, Username, Age, Email FROM ValidTable";
$result = $mysqli->query ($sql);
if ($result){
if ($result->num_rows > 0) {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>firstname</th>";
                                echo "<th>lastname</th>";
                                echo "<th>username</th>";
                                echo "<th>age</th>";
                                echo "<th>email</th>";
                                echo "</tr>";
while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['ID']."</td>";
    echo "<td>".$row['Firstname']."</td>";
    echo "<td>".$row['Lastname']."</td>";
    echo "<td>".$row['Username']."</td>";
    echo "<td>".$row['Age']."</td>";
    echo "<td>".$row['Email']."</td>";
    echo "</tr>";
}
echo "</table>";

} else {
    echo "0 results";
}
$result->close();
$mysqli->close();
}
?>
</body>
</html>
