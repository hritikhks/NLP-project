<?php 
$servername = "localhost";
$username = "hritik";
$password = "Hritik@6811";

// Create connection
//$conn1 = new mysqli($servername, $username, $password);
$conn1 = mysqli_connect($servername, $username, $password);
// Check connection
if ($conn1->connect_error) {
	echo "Not Connected";
    die("Connection failed: " . $conn->connect_error);
} 
// Create database
$sql = "CREATE DATABASE chemword";
if (mysqli_query($conn1, $sql)) {
    echo "Database created successfully";
} else {
    // echo "Error creating database: " . mysqli_error($conn1);
}


include_once "crttbl.php";
mysqli_close($conn1);

?>