<?php

include "config.php";

$conn =db();

 $query = '';
 $sqlfile = file('C:\xampp\htdocs\userAuthMySQL\userAuthMySQL\users.sql');




  foreach($sqlfile as $sqlline){
    
  $query .= $sqlline;
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sssss",$fullnames,$country,$email,$gender, $password);
  $stmt->execute();



  }
