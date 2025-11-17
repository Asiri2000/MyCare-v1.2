<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
         .table{
            border:2px solid #f8f9fa;
         }

        .table td {
            vertical-align: middle;
            border:1px solid ;
        }
        .table td.hey {
            font-weight: bold;
        }

        .container-fluid{
    font-family: "Roboto", sans-serif;
  font-weight: 600;
  font-style: normal;
  
}

    </style>

<?php

session_start();

$user_id = $_SESSION["user_id"];

require './db_connection_data.php';

$dbcon = new DbConnector();

$con =  $dbcon->getConnection();

$query = "select * from patient where user_id='$user_id' ";

try{
    $stmt= $con->query($query);
    $firstRow=$stmt->fetch(PDO::FETCH_OBJ);
    
    
    // if($secondRow){
        
    //         echo "Customer id:" .$secondRow->Name."<br>";
    //         echo "Customer name:" .$secondRow->Address."<br>";
    //         echo "Customer email:" .$secondRow->Age."<br>";
    
    // }else{
    //         echo "NO any records available";
    // }
    
} catch (Exception $ex) {
       die("Error while running the sql query".$ex->getMessage());
}
 
  
  
?>



</head>
<body>
   
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Patient Information</h4>
            </div>
            <div class="container-fluid">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Full Name</td>
                            <td ><?php echo $firstRow->first_name ." ". $firstRow->last_name; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td> <?php echo $firstRow->address; ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td> <?php echo $firstRow->phone_number; ?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td> <?php echo $firstRow->birth_date; ?> </td>
                        </tr>
                        <tr>
                            <td>Height and Weight</td>
                            <td> <?php echo $firstRow->height; ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td> <?php echo $firstRow->gender; ?></td>
                        </tr>
                        <tr>
                            <td>Blood Type</td>
                            <td> <?php echo $firstRow->blood_type; ?></td>
                        </tr>
                        <tr>
                            <td>Current Health Condition</td>
                            <td> <?php echo $firstRow->current_health_con; ?></td>
                        </tr>
                        <tr>
                            <td>Medical History</td>
                            <td> <?php echo $firstRow->past_conditions; ?></td>
                        </tr>
                        <tr>
                            <td>Emergency Contact Number</td>
                            <td> <?php echo $firstRow->emergencyno; ?></td>
                        </tr>
                        <tr>
                            <td>Primary Doctor</td>
                            <td> <?php echo $firstRow->primary_doc; ?></td>
                        </tr>
                        <tr>
                            <td>Allergies</td>
                            <td> <?php echo $firstRow->allergies; ?></td>
                        </tr>
                        <tr>
                            <td>Current Medications</td>
                            <td> <?php echo $firstRow->current_medications; ?></td>
                        </tr>
                        <tr>
                            <td>Insurance Provider</td>
                            <td> <?php echo $firstRow->ins_provider; ?></td>
                        </tr>
                        <tr>
                            <td>Insurance Policy Number</td>
                            <td> <?php echo $firstRow->ins_pol_num; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>