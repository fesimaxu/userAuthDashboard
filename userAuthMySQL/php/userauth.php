<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();

    $query = "SELECT * FROM students WHERE email = '$email'";

    $connect = mysqli_query($conn,$query);

    $userdata = mysqli_fetch_assoc($connect);

   if($userdata){
     if($userdata["email"] === $email){
        echo "Email Already exist";
        exit;
     }
   }
    
   $query = "INSERT INTO students(fullnames, country, email, gender, password) VALUES ('$fullnames', '$country', '$email', '$gender', '$password')";
                                

   if(mysqli_query($conn,$query)){
         //check if user with this email already exist in the database
         echo "Register Successfully";
    }
  
}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    //echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    $userdata = "SELECT * FROM students WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $userdata);
    $studentdata = mysqli_fetch_assoc($result);
    $username = $studentdata['fullnames'];

     //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
        if(mysqli_num_rows($result) > 0){
            session_start();
            $_SESSION['username'] = $username;
            header("Location:../dashboard.php");
        }else{
            header("Location:../forms/login.html");
        }
    
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    $query = "SELECT * FROM students WHERE email = '$email'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 0){
        echo "email does not exist";
    }else{
        $sql = "UPDATE students SET passowrd = $passowrd WHERE email == '$email'"; 

        mysqli_query($conn,$sql);
        echo "Password Updated Successfully";
    }
   
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['fullnames'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();

     //delete user with the given id from the database
     $query = "DELETE FROM students WHERE id == '$id'";

     if(mysqli_query($conn,$query)){
        header('location:'. $_SERVER['PHP_SELF']. '?all=');
     }else{
        echo "erro " .mysqli_error($conn);
     }
 }
