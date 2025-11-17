<?php
require "../DbConnector/DbConnector.php";

session_start();

$user_id = $_SESSION["user_id"];


// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.html?error=You are not logged in");
    exit();
}

$dbcon = new DbConnector();

$con =  $dbcon->getConnection();

$query = "SELECT * FROM patient WHERE user_id = :user_id";

try{
  

    $stmt = $con->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    
    
} catch (Exception $ex) {
       die("Error while running the sql query".$ex->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/my_care_hcm/css/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</head>

<body>

<div class="container-fluid p-0 d-flex flex-column" style="min-height: 100vh;">
    <!-- Header -->
    <header class="bg-navy text-white w-100">
        <nav class="navbar navbar-light justify-content-between">
            <div class="d-flex align-items-center">
                <img src="Screenshot (227).png" alt="Logo" width="60" height="60" class="me-2">
                <span class="navbar-brand mb-0 h1 text-white">MY CARE</span>
            </div>
            <div class="d-flex align-items-center user-icons">
                <span class="navbar-text text-white d-flex align-items-center">
                    <img src="images.png" alt="User Image" class="rounded-circle me-2" width="40"> Admin
                </span>
                <i class="bi bi-bell ms-3 text-white"></i>
                <i class="bi bi-arrow-right-circle ms-3 text-white"></i>
            </div>
        </nav>
    </header>

    <div class="row flex-grow-1">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar bg-light">
            <div class="p-3 bg-navy text-white d-flex align-items-center">
                <h4 class="mb-0">Dashboard</h4>
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link active btn btn-navy text-white" href="../dashboard.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-navy text-white" href="#">Doc Chat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-navy text-white" href="#">Reminders</a>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link btn btn-navy text-white" href="../logout.php"><i class="bi bi-arrow-left-circle"></i> Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 content">
            <div class="container mt-4 text-center">
                <div class="greeting mb-4">
                    <p>Hello, <?php echo $user->username; ?></p>
                    <p><?php echo $user->email; ?></p>
                </div>

                <!-- Dashboard Topic -->
                <div class="dashboard-topic">
                    <h5>Manage Appointments</h5>
                    <ul class="list-unstyled">
                        <li><a href="function/add.php" class="btn btn-navy-1 text-white mb-2 dashboard-topic">Add Appointment</a></li>
                        <li><a href="function/view.php" class="btn btn-navy-1 text-white mb-4 dashboard-topic">View Appointments</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-navy text-white text-center text-lg-start mt-auto w-100">
        <div class="text-center p-3">
            <a class="text-white" href="#">2024</a> | <a class="text-white" href="#">My Care</a> | <a class="text-white" href="#">About Us</a> | <a class="text-white" href="#">Contact Us</a>
        </div>
    </footer>
</div>

<!-- Bootstrap JS and custom scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
