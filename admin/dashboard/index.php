<?php

require "../../dbConfig/dbConfig.php";

if (!isset($_SESSION["Admin_name"])) {
    header("Location: /my_care_hcm/admin/index.php?error=You are not logged in");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/my_care_hcm/css/common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid p-0 d-flex flex-column" style="min-height: 100vh;">
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
            <div class="col-md-2 sidebar bg-light">
                <div class="p-3 bg-navy text-white d-flex align-items-center">
                    <h4 class="mb-0">Dashboard</h4>
                </div>
                <ul class="nav flex-column mt-3">
                    <li class="nav-item">
                        <a class="nav-link active btn btn-navy text-white" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-navy text-white" href="#">Doc Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-navy text-white" href="#">Reminders</a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link btn btn-navy text-white" href="logout.php"><i class="bi bi-arrow-left-circle"></i> Logout</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 content">
                <div class="container mt-4 text-center">
                    <div class="greeting mb-4">
                        <p>Hello, <?php echo $_SESSION["Admin_name"]; ?></p>
                        <p><?php echo $_SESSION["Admin_email"]; ?></p>
                    </div>
                    
                    <div class="dashboard-topic">
                         <h5>Manage Departments</h5>
                            <ul class="list-unstyled">
                                <li><a href="departments/view.php" class="btn btn-navy-1 text-white mb-2 dashboard-topic">View Departments</a></li>
                                <li><a href="departments/add.php" class="btn btn-navy-1 text-white mb-4 dashboard-topic">Add Department</a></li>
                            </ul>
                        <h5>Manage Doctors</h5>
                            <ul class="list-unstyled">
                                <li><a href="doctors/view.php" class="btn btn-navy-1 text-white mb-4 dashboard-topic">View Doctors</a></li>
                            </ul>
                        <h5>Manage Appointments</h5>
                            <ul class="list-unstyled">
                                <li><a href="appointments/view.php" class="btn btn-navy-1 text-white dashboard-topic">View Appointments</a></li>
                            </ul>
                        </div>
                </div>
            </div>
        </div>

        <footer class="bg-navy text-white text-center text-lg-start mt-auto w-100">
            <div class="text-center p-3">
                <a class="text-white" href="#">2024</a> | <a class="text-white" href="#">My Care</a> | <a class="text-white" href="#">About Us</a> | <a class="text-white" href="#">Contact Us</a>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
