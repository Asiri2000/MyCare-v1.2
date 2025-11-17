<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

 $name = "localhost";
 $username = "root";
 $password = "";

  $db_name = "mycare";
  
  $conn = mysqli_connect($name,$username,$password,$db_name);

  
    if(!$conn){
               echo "Connection failed!";
                exit();
                
    }


?>