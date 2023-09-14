<?php
// Step 1: Parse the XML content and extract the data
$xmlString = '<?xml version="1.0"?>
<brightstar>
    <name>Sirius</name>
    <magnitude>1.45</magnitude>
    <distance>9</distance>
    <name>Canopus</name>
    <magnitude>-5.53</magnitude>
    <distance>310</distance>
    <name>Rigil Kentaurus</name>
    <magnitude>4.34</magnitude>
    <distance>4</distance>
</brightstar>
';

$xml = simplexml_load_string($xmlString);

// Step 2: Establish a connection to the MySQL database
$host = 'localhost';
$username = 'root';
$password ='';
$database = 'lab_7';

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Step 3: Create a table in the database to store the extracted data
$sqlCreateTable = "CREATE TABLE IF NOT EXISTS bright_stars (
    name VARCHAR(100) NOT NULL,
    magnitude DECIMAL(5, 2) NOT NULL,
    distance INT NOT NULL
)";

if ($connection->query($sqlCreateTable) === TRUE) {
    echo "Table 'bright_stars' created successfully.<br>";
} else {
    echo "Error creating table: " . $connection->error;
}

$names = (array) $xml->name;
$magnitudes = (array) $xml->magnitude;
$distances = (array) $xml->distance;


for($i=0 ; $i< sizeof($xml->name) ; $i++){
    $name = $xml->name[$i] ;
    $magnitude = $xml->magnitude[$i];
    $distance = $xml->distance[$i];

    echo "Data " . $name . "  " . $magnitude . "  " . $distance . "   ";

    $sqlInsertData = "INSERT INTO bright_stars (name, magnitude, distance) VALUES ('$name', $magnitude, $distance)";
    if ($connection->query($sqlInsertData) !== TRUE) {
        echo "Error inserting data: " . $connection->error;
    }
    else{
        echo "Data inserted successfully";
    }
}

$connection->close();
?>
