<?php
// Step 5: Retrieve the data from the MySQL table and display it in an HTML table
$host = 'localhost';
$username = 'root';
$password ='';
$database = 'lab_7';
$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sqlRetrieveData = "SELECT * FROM bright_stars";
$result = $connection->query($sqlRetrieveData);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Name</th>
                <th>Magnitude</th>
                <th>Distance</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['magnitude'] . "</td>";
        echo "<td>" . $row['distance'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}

$connection->close();
?>
