<?php
include "config.php";
$conn = db();
$sql = "CREATE TABLE PHPStudents (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullnames VARCHAR(30) NOT NULL,
    country VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    gender VARCHAR(30),
    password VARCHAR(60)
    )";
    
    if ($conn->query($sql) === TRUE) {
            echo "Table Students created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
     }