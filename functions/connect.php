<?php
$config = include("config.php");

//Get config
$servername = $config['database']['host'];
$database = $config['database']['name'];
$username = $config['database']['user'];
$password = $config['database']['pass'];

//Create connection
$conn = new mysqli($servername, $username, $password, $database);

//Check connection
if ($conn->connect_error) {
	
	die("Connection failed!: " . $conn->connect_error);
	
}

//echo "Connected!";
?>