
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="newDashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <?php

session_start();

$user_id = $_SESSION["user_id"];


if(isset($_SESSION['user_id'])){
    $username = $_SESSION['username'];
     
 }else{
     header("location:login.php");
     exit();
 }


require './data/db_connection_data.php';

$dbcon = new DbConnector();

$con =  $dbcon->getConnection();

$query = "SELECT * FROM patient WHERE user_id = :user_id";

try{
    // $stmt= $con->query($query);
    // $firstRow=$stmt->fetch(PDO::FETCH_OBJ);
  

    $stmt = $con->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR); // Use PDO::PARAM_STR for string type user_id
    $stmt->execute();
    $firstRow = $stmt->fetch(PDO::FETCH_OBJ);
    
    
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
 
function calculateAge($dob) {
    $birthDate = new DateTime($dob);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;
    return $age;
}
  
?>




</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 sidebar bg-light">
                <div class="p-3 bg-navy text-white d-flex align-items-center">
                    <h4 class="mb-0">Dashboard</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="http://localhost/MyCarev1.1/dashboard.php#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Doc Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="appointment/appointment.php">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Reminder/Reminder_Calender/index.php">Reminders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/healthguidence/health-guidence.php">Health Guidance</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 content">
                <nav class="navbar navbar-light bg-navy text-white">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1 text-white"><img src="DashboardImages/Logo.png" alt="Logo" width="60" height="60" class="me-2">MyCare</span>
                        <div class="d-flex align-items-center">
                            <span class="navbar-text text-white">
                                <img src="DashboardImages/User.png" alt="User Image" class="rounded-circle" width="40">  <?php echo $username; ?>
                            </span>
                        <i class="bi bi-bell ms-3 text-white"></i>
                        <a href="logout.php"  >   <i class="bi bi-arrow-right-circle ms-3 text-white"></i> </a> 
                        </div>
                    </div>
                </nav>
                <div class="p-4">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><b>Upcoming Appointments</b></h3><br>
                                    <h6><b>14th july 2024,10:00 AM </b> with Dr.Perera</h6>
                                    <button type="button" class="btn btn-primary">View All Appointments</button>
                                    <br> &nbsp;
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title"><b>My Health Reports</b></h3>

                                    <?php if(isset($_GET['error'])): ?>
                                      <p><?php echo $_GET['error']; ?></p>
                                        <?php endif ?>


                                             <form action="repostory/upload.php" method="post" enctype="multipart/form-data">
                                      
                                        <label for="fileToUpload">Select file to upload:</label> <br>
                                        <input type="file" name="my_image" id="my_image"  required>
                                       <br><br> <input type="submit" value="Upload File" name="submit" class="btn btn-primary"> 
                                       &nbsp;&nbsp;<button class="btn btn-success"><a href="repostory/view.php" style="text-decoration:none; color:white;">View Repostory </a></button>
                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4><b>My Information </b></h4> 
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="table-responsive mb-3">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Full Name</td>
                                                    <td class="hey">|&nbsp; <?php echo $firstRow->first_name ." ".$firstRow->last_name; ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td>|&nbsp;<?php echo $firstRow->address; ?></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>Contact Number</td>
                                                    <td>|&nbsp;<?php echo $firstRow->phone_number; ?></td>
                                                    
                                                </tr>

                                                <tr>
                                                    <td>Age</td>
                                                    <td>|&nbsp;<?php echo  calculateAge($firstRow->birth_date) ; ?> years</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Height and Weight</td>
                                                    <td>|&nbsp;<?php echo $firstRow->height ." / ". $firstRow->weight; ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td>|&nbsp;<?php echo $firstRow->gender; ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Blood Type</td>
                                                    <td>|&nbsp;<?php echo $firstRow->blood_type; ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Curent Health Condition</td>
                                                    <td>|&nbsp;<?php echo  $firstRow->current_health_con ?></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>Medical History</td>
                                                    <td>|&nbsp;<?php echo $firstRow->past_conditions; ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Emergency Contact Number</td>
                                                    <td>|&nbsp;<?php echo $firstRow->emergencyno; ?></td>
                                                    
                                                <tr>
                                                    <td>Primary Doctor</td>
                                                    <td>|&nbsp;<?php echo $firstRow->primary_doc; ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Allergies</td>
                                                    <td>|&nbsp;<?php echo $firstRow->allergies; ?></td>
                                                   
                                                </tr>
                                                <tr>
                                                    <td>Current Mediactions</td>
                                                    <td> |&nbsp;<?php echo $firstRow->current_medications; ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Insurance Provider</td>
                                                    <td>|&nbsp;<?php echo $firstRow->ins_provider; ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Insurance Policy Number</td>
                                                    <td>|&nbsp;<?php echo $firstRow->ins_pol_num; ?></td>
                                               <!--    <td><button class="btn btn-secondary">Pending</button></td>  -->
                                                </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <button type="button" class="btn btn-primary" ><a href="http://localhost/MyCarev1.1/editDashboard/editform.php" style="text-decoration:none; color:white;">Edit My Infromation </a></button> &nbsp;
                            <button class="btn btn-success"><a href="dashboard.php" style="text-decoration:none; color:white;"> Save </a></button>
                            <br>
                            
                           
                            </div>
                            <br>
                           
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title"><b>GET MYQR CODE</b></h3><br>
                                        <h6><b>This is the your health profile information included QR code. <br>It serves as a quick reference for healthcare providers to access a patient's critical health information,<br> efficiently in case of emergencies or regular medical consultations. </b> </h6>
                                        <button type="button" class="btn btn-primary" onclick=" GenerateQR()">Generate MyQR Code</button>
                                        <br> &nbsp;
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                     <!-- <img src="DashboardImages/qrcode.png"  style="width:300px; height:192px" > -->
                                     <div id="imgBox" style="overflow:hidden;">
                                      <img  style="width:240px; height:200px; overflow:hidden;" id="qrImage">  
                                       </div>
                                 <script>
                                       function GenerateQR(){ 
                                        qrImage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://localhost/MyCarev1.1/QrGenerator/patientform.php";
     
                                     imgBox.classList.add("show-img"); 
                                     
                                       }
                                      
                                 </script>
                                    </div>
                                </div>
                            </div>



                    </div>
                </div>
                <footer class="bg-navy text-white text-center text-lg-start mt-auto">
                    <div class="text-center p-3">
                        <a class="text-white" href="#">2024</a> | <a class="text-white" href="#">My Care</a> | <a class="text-white" href="#">About Us</a> | <a class="text-white" href="#">Contact Us</a>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
