<?php

/* sess
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

    session_start();

    $user_id = $_SESSION["user_id"];

      if(isset($_POST['submit']) && isset($_FILES['my_image'])){
          
          include "db_conn.php";
          
          echo "<pre>";
          print_r($_FILES['my_image']);
          echo "<pre>";
          
          $img_name = $_FILES['my_image']['name'];
          $img_size = $_FILES['my_image']['size'];
          $temp_name = $_FILES['my_image']['tmp_name'];
          $error = $_FILES['my_image']['error'];
          
          if($error === 0){
              if($img_size > 5000000){
                   $em = "Sorry, your file is too large.";
                   header("Location: dashboard.php?error=$em");
              }
              else{
                  $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                  $img_ex_lc = strtolower($img_ex);
                  
                  $allowed_exs = array("jpg","jpeg","png","gif");
                  
                  if(in_array($img_ex_lc,$allowed_exs)){
                      $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
                      $img_upload_path = 'upload/'.$new_img_name;
                      move_uploaded_file($temp_name,$img_upload_path);
                      
                      $query = "INSERT INTO repository(image_url,user_id)VALUES('$new_img_name','$user_id')";
                      mysqli_query($conn,$query);
                      //echo"upload succesfull";
                      header("Location:view.php");
                      
                  }else{
                      $em = "You can't upload files of this type";
                      header("Location: http://localhost/MyCareV1.1/dashboard.php?error=$em");
                  }
              }
              
          }else{
              $em = "Unknown error occurred!";
              header("Location: dashboard.php?error=$em");
          }
          
          
      }else{
             header("Location: http://localhost/MyCareV1.1/dashboard.php");
      }




?>