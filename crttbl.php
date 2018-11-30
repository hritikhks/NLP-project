<?php 
$servername = "localhost";
$username = "hritik";
$password = "Hritik@6811";
$dname = "chemword";


$connection = mysqli_connect($servername, $username, $password, $dname);

if (!$connection) {
	echo "Not Connected";
    die("Connection failed: " . mysqli_connect_error());
} 
// sql to create table
$sql = "CREATE TABLE Words ( english VARCHAR(120) , Hinglish VARCHAR(100) , Hindi VARCHAR(100))";

if (mysqli_query($connection, $sql)) {
	echo "<br>";
    echo "Table Words created successfully";
} 
else {
	//echo "table not created";

}
$tbl = "CREATE TABLE sentence ( english VARCHAR(120) , sntc VARCHAR(240) )";

if (mysqli_query($connection, $tbl)) {
	echo "<br>";
    echo "Table sentence created successfully";
}


mysqli_close($connection);
 
?>