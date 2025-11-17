<?php

require './db_connection_data.php';



if($_SERVER["REQUEST_METHOD"]=="POST" && !empty($_POST)){
      
   
   
    $user_id = $_POST["user_id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $address = $_POST["address"];
    $contact_number = $_POST["contactNumber"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];
    $bloodType = $_POST["bloodType"];
    $currentHealthCondition = $_POST["currentHealthCondition"];
    $medicalHistory = $_POST["medicalHistory"];
    $emergencyContactNumber = $_POST["emergencyContactNumber"];  
    $primaryDoctor = $_POST["primaryDoctor"];
    $allergies = $_POST["allergies"];
    $currentMedications = $_POST["currentMedications"];
    $insuranceProvider = $_POST["insuranceProvider"];
    $insurancePolicyNumber = $_POST["insurancePolicyNumber"];




        $query = "update patient set first_name='$fname', last_name='$lname', address='$address', phone_number='$contact_number', birth_date='$dob',
        height='$height', weight='$weight' , gender='$gender', blood_type='$bloodType', 
        current_health_con='$currentHealthCondition' , past_conditions='$medicalHistory' ,
        emergencyno='$emergencyContactNumber', primary_doc='$primaryDoctor' ,
        allergies='$allergies' , current_medications = '$currentMedications' ,
        ins_provider = '$insuranceProvider' , ins_pol_num = '$insurancePolicyNumber'  where user_id='$user_id'";

        function calculateAge($dob) {
            $birthDate = new DateTime($dob);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthDate)->y;
            return $age;
        }

}

try{
    $dbcon = new DbConnector();
    $con = $dbcon->getConnection();
     $a =  $con->exec($query);
   if($a>0){
       echo"Patient is updated succesfully";
       header("Location: http://localhost/MyCarev1.1/dashboard.php");
        exit();
   }else{
       echo"Patient update error";
       header("Location: http://localhost/MyCarev1.1/dashboard.php");
        exit();
   }
} catch (Exception $ex) {
       die("Error while running the sql query".$ex->getMessage());
}

?>