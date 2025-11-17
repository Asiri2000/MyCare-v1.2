<?php


require './db_connection.php';

//echo "hey hey";

if($_SERVER["REQUEST_METHOD"]=="POST" && !empty($_POST)){
      
    
    
    $doctorId = $_POST["doctor_id"];
    $username = $_POST["username"];
     $password = $_POST["password"];
    $address = $_POST["address"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $specialization = $_POST["specialization"];
    $experience = $_POST["experience"];
    $appointment_fee = $_POST["appointment_fee"];
    $room_number = $_POST["room_number"];
    $working_hours = $_POST["working_hours"];
    

    


   $dbcon = new DbConnector();

$con =  $dbcon->getConnection();

$query = "insert into doctor_info  values('$doctorId','$username','$password','$address','$first_name','$last_name','$specialization','$experience','$appointment_fee','$room_number','$working_hours')";

try{
 $a=$con->exec($query);
 if($a>0){
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#successModal').modal('show');
    });
  </script>";

     
 }else{
     echo "Error in adding customer";
 }
 
} catch (PDOException $ex) {
         die("Error".$ex->getMessage());
}
 



}


?>

<html>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function redirectToLogin() {
            window.location.href = 'login.php';
        }
    </script>


  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your registration is successful!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="redirectToLogin()">OK</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


</html>