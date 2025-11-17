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
</head>
<body>
    <div class="container">
        <h1>User Information Form</h1>
        <form action="insert.php" method="POST" >

        <div class="form-group">
                <label for="username">  Patient ID:    </label>
                <input type="text" id="patientId" name="patientId" required>
            </div>

            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="contactNumber" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="heightWeight">Height and Weight:</label>
                <input type="text" id="heightWeight" name="heightWeight" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="radio"  name="gender" value="male" required>Male <br>
                <input type="radio"  name="gender" value="female" required>female<br>

            </div>
            <div class="form-group">
                <label for="bloodType">Blood Type:</label>
                <input type="text" id="bloodType" name="bloodType" required>
            </div>
            <div class="form-group">
                <label for="currentHealthCondition">Current Health Condition:</label>
                <input type="text" id="currentHealthCondition" name="currentHealthCondition" required>
            </div>
            <div class="form-group">
                <label for="medicalHistory">Medical History:</label>
                <textarea id="medicalHistory" name="medicalHistory" rows="4" ></textarea>
            </div>
            <div class="form-group">
                <label for="emergencyContactNumber">Emergency Contact Number:</label>
                <input type="tel" id="emergencyContactNumber" name="emergencyContactNumber" required>
            </div>
            <div class="form-group">
                <label for="primaryDoctor">Primary Doctor:</label>
                <input type="text" id="primaryDoctor" name="primaryDoctor" required>
            </div>
            <div class="form-group">
                <label for="allergies">Allergies:</label>
                <input type="text" id="allergies" name="allergies" >
            </div>
            <div class="form-group">
                <label for="currentMedications">Current Medications:</label>
                <textarea id="currentMedications" name="currentMedications" rows="4" ></textarea>
            </div>
            <div class="form-group">
                <label for="insuranceProvider">Insurance Provider:</label>
                <input type="text" id="insuranceProvider" name="insuranceProvider" >
            </div>
            <div class="form-group">
                <label for="insurancePolicyNumber">Insurance Policy Number:</label>
                <input type="text" id="insurancePolicyNumber" name="insurancePolicyNumber" >
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
