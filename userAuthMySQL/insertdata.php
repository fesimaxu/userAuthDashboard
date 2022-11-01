<?php

include "config.php";

$conn =db();
$query = `users.sql`;


  $stmt = $conn->prepare($query);
  $stmt->bind_param("sssss",$fullnames,$country,$email,$gender, $password);
  $stmt->execute();



 
