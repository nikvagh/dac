<?php
 $servername = "localhost";
 $username = "lara1_db";
 $password = "1@42WJfd937V";
 $dbname = "lara1";
 $port = "3306";

 // Create connection
 $conn = new mysqli($servername.':'.$port, $username, $password, $dbname);

 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 echo "Connected successfully";


