<?php
	$bot_token = "";
	
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gethaze";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
	$conn->query('SET NAMES utf8');

    // Check connection 
    if ($conn->connect_error) {
        die("Connection with the Database failed!");
    }
?>