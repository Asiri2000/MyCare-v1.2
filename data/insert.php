<?php


require './db_connection.php';

//echo "hey hey";

if($_SERVER["REQUEST_METHOD"]=="POST" && !empty($_POST)){
      
    $patientId = $_POST["patientId"];
    $fullname = $_POST["fullName"];
    $address = $_POST["address"];
    $contact_number = $_POST["contactNumber"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $heightWeight = $_POST["heightWeight"];
    $bloodType = $_POST["bloodType"];
    $currentHealthCondition = $_POST["currentHealthCondition"];
    $medicalHistory = $_POST["medicalHistory"];
    $emergencyContactNumber = $_POST["emergencyContactNumber"];  
    $primaryDoctor = $_POST["primaryDoctor"];
    $allergies = $_POST["allergies"];
    $currentMedications = $_POST["currentMedications"];
    $insuranceProvider = $_POST["insuranceProvider"];
    $insurancePolicyNumber = $_POST["insurancePolicyNumber"];
   
  //echo $name."<br>".$address."<br>".$age."<br>".$gender;
    

    


   $dbcon = new DbConnector();

$con =  $dbcon->getConnection();

$query = "insert into dashboard  values('$patientId','$fullname','$address','$contact_number','$age','$heightWeight','$gender','$bloodType','$currentHealthCondition','$medicalHistory','$emergencyContactNumber','$primaryDoctor','$allergies','$currentMedications',' $insuranceProvider','$insurancePolicyNumber')";

try{
 $a=$con->exec($query);
 if($a>0){
     echo "<br>details is added Successfuly";
 }else{
     echo "Error in adding customer";
 }
 
} catch (PDOException $ex) {
         die("Error".$ex->getMessage());
}
 



}






?>