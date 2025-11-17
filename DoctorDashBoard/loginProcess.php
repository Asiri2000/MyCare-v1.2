<?php


require './db_connection.php';

session_start();

if(isset($_SESSION['username'])||isset($_COOKIE['username'])){
    header("location:welcome.php");
}else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $dbcon = new DbConnector();
    $con = $dbcon->getConnection();
    
    $query = "select * from doctor_info where username = ?";
   
    try{
        $pstmt = $con->prepare($query);
        $pstmt->bindValue(1,$username);
        $pstmt->execute();
        
        $row = $pstmt->fetch(PDO::FETCH_OBJ);
        if(!empty($row)){
            $pwdhash = $row->password;
           
          //  echo"$pwdhash<br>$password";
            
            if($password===$pwdhash){
                
                 $_SESSION['username']=$username;
                 $_SESSION['fname'] = $row->first_name;
                $_SESSION['lname'] = $row->last_name;
                 header("location:index.php");
                 exit();
            }
            else{
                echo "Login unsuccessful<br>";
                echo "<a href='login.php'>Back to Login</a>";
            }
        }else{
            header("location:login.php");
            exit();
        }
        
    } catch (Exception $exc) {
               die($exc->getMessage());
    }
    
}



?>