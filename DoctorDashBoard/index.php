<?php



session_start();

if(isset($_SESSION['username'])){
   $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];

}elseif(isset($_COOKIE['username'])){
    $fname = $_COOKIE['f_name'];
    $lname = $_COOKIE['l_name'];
}
else{
    header("location:login.php");
    exit();
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
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
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Doc Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Appointments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reminders</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-10 content">
                <nav class="navbar navbar-light bg-navy text-white">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1 text-white"><img src="images/Screenshot (227).png" alt="Logo" width="60" height="60" class="me-2">MY CARE</span>
                        <div class="d-flex align-items-center">
                            <span class="navbar-text text-white">
                                <img src="images/images.png" alt="User Image" class="rounded-circle" width="40"> <?php echo " "."$fname"." "."$lname";?>
                            </span>
                            <i class="bi bi-bell ms-3 text-white"></i>
                            <a href='logout.php'> <i class="bi bi-arrow-right-circle ms-3 text-white"> </i></a> 
                          <?php  echo "<a href='logout.php'>Logout</a>";   ?>
                            
                        </div>
                    </div>
                </nav>
                <div class="p-4">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Today's Appointments</h5>
                                    <h2>10</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Patients</h5>
                                    <h2>30</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5>Today's Schedule</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="table-responsive mb-3">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>10:00 AM - 11:00 AM</td>
                                                    <td>Kasun Perera</td>
                                                    <td><button class="btn btn-success">Confirm</button></td>
                                                </tr>
                                                <tr>
                                                    <td>10:00 AM - 11:00 AM</td>
                                                    <td>Ruwan Hettiarachchi</td>
                                                    <td><button class="btn btn-secondary">Pending</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h5>Search Patients</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="input-group mb-3" style="max-width: 600px;">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Patient Name">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h5>Reports</h5>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>01</td>
                                                    <td>Kasun Perera</td>
                                                    <td>2024/05/06</td>
                                                    <td><button class="btn btn-primary">Show</button></td>
                                                </tr>
                                                <tr>
                                                    <td>02</td>
                                                    <td>Ruwan Hettiarachchi</td>
                                                    <td>2024/05/06</td>
                                                    <td><button class="btn btn-primary">Show</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
