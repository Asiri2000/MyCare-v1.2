<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        input[type="tel"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>

<?php

require './db_connection_data.php';

$dbcon = new DbConnector();

$con =  $dbcon->getConnection();

session_start();
$user_id = $_SESSION["user_id"];

$query = "SELECT * FROM patient WHERE user_id = :user_id";

try{
    $stmt = $con->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR); // Use PDO::PARAM_STR for string type user_id
    $stmt->execute();
    $firstRow = $stmt->fetch(PDO::FETCH_OBJ);
    
 
    
} catch (Exception $ex) {
       die("Error while running the sql query".$ex->getMessage());
}
 

  
?>



</head>
<body>
    <div class="container">
        <h1>User Information Form</h1>
        <form action="dashboard_update.php" method="POST" >

        <div class="form-group">
                <label for="username">  Patient ID:    </label>
                <input type="text" id="user_id" name="user_id" value="<?php echo $firstRow->user_id; ?>" required>
            </div>

            <div class="form-group">
                <label for="fullName">First Name:</label>
                <input type="text" id="fname" name="fname" value="<?php echo $firstRow->first_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="fullName">Last Name:</label>
                <input type="text" id="fname" name="lname" value="<?php echo $firstRow->last_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $firstRow->address; ?>" required>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="contactNumber" value="<?php echo $firstRow->phone_number; ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob"   value="<?php echo  $firstRow->birth_date ;  ?>"   required >
            </div>
            <div class="form-group">
                <label for="height">Height:</label>
                <input type="text" id="height" name="height" value="<?php echo $firstRow->height; ?>" required>
            </div>

            <div class="form-group">
                <label for="Weight"> Weight:</label>
                <input type="text" id="weight" name="weight" value="<?php echo $firstRow->weight; ?>" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>

                <?php 
if ($firstRow->gender == "Male") {
    echo "<input type=\"radio\" name=\"gender\" value=\"Male\" required checked>Male <br>";
}else{
    echo "<input type=\"radio\" name=\"gender\" value=\"Female\" required checked>Female <br>";
}
?>

                
                <!-- <input type="radio"  name="gender" value="female" required>female<br> -->

            </div>
            <div class="form-group">
                <label for="bloodType">Blood Type:</label>
                <input type="text" id="bloodType" name="bloodType" value="<?php echo $firstRow->blood_type; ?>" required>
            </div>
            <div class="form-group">
                <label for="currentHealthCondition">Current Health Condition:</label>
                <input type="text" id="currentHealthCondition" name="currentHealthCondition" value="<?php echo $firstRow->current_health_con; ?>" >
            </div>
            <div class="form-group">
                <label for="medicalHistory">Medical History:</label>
                <textarea id="medicalHistory" name="medicalHistory" rows="4"  ><?php echo $firstRow->past_conditions; ?></textarea>
            </div>
            <div class="form-group">
                <label for="emergencyContactNumber">Emergency Contact Number:</label>
                <input type="tel" id="emergencyContactNumber" name="emergencyContactNumber" value="<?php echo $firstRow->emergencyno; ?>" required>
            </div>
            <div class="form-group">
                <label for="primaryDoctor">Primary Doctor:</label>
                <input type="text" id="primaryDoctor" name="primaryDoctor" value="<?php echo $firstRow->primary_doc; ?>" >
            </div>
            <div class="form-group">
                <label for="allergies">Allergies:</label>
                <input type="text" id="allergies" name="allergies" value="<?php echo $firstRow->allergies; ?>" >
            </div>
            <div class="form-group">
                <label for="currentMedications">Current Medications:</label>
                <textarea id="currentMedications" name="currentMedications" rows="4"  ><?php echo $firstRow->current_medications; ?></textarea>
            </div>
            <div class="form-group">
                <label for="insuranceProvider">Insurance Provider:</label>
                <input type="text" id="insuranceProvider" name="insuranceProvider" value="<?php echo $firstRow->ins_provider; ?>" >
            </div>
            <div class="form-group">
                <label for="insurancePolicyNumber">Insurance Policy Number:</label>
                <input type="text" id="insurancePolicyNumber" name="insurancePolicyNumber" value="<?php echo $firstRow->ins_pol_num; ?>" >
            </div>
            <input type="submit" value="SAVE">
        </form>
    </div>
</body>
</html>
