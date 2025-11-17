<?php

require "../../../dbConfig/dbConfig.php";

if (!isset($_SESSION["Patient_name"])) {
    header("Location: /my_care_hcm/patient/index.php?error=You are not logged in");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment = $_POST["appointment_id"];

    $sql = "DELETE FROM appointment WHERE Appointment_id = $appointment";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header("Location: view.php?message=Your Appointment Deleted");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (!isset($_GET['appointment']) || empty($_GET['appointment']) || !is_numeric($_GET['appointment'])) {
    header("Location: view.php");
    exit();
}
$appointment_id = $_GET['appointment'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/common.css">
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

        <div class="container mt-4 flex-grow-1">
            <h3 class="text-center">Are you sure you want to delete this appointment?</h3>
            <p class="text-center">This action cannot be undone. Please confirm your decision.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="appointment_id" value="<?= $appointment_id ?>" style="display: none;">
            <div class="d-flex justify-content-center">
            <input type="button" value="Cancel" class="btn btn-secondary me-2" onclick="window.location.href = 'view.php';">
            <input type="submit" value="Delete" class="btn btn-danger">
            </div>
        </form>
    </div>

    <footer class="bg-navy text-white text-center text-lg-start mt-auto w-100">
            <div class="text-center p-3">
                <a class="text-white" href="#">2024</a> | <a class="text-white" href="#">My Care</a> | <a class="text-white" href="#">About Us</a> | <a class="text-white" href="#">Contact Us</a>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if (isset($_GET['message'])) {
        echo "<script>alert('$_GET[message]');</script>";
    }
    ?>
</body>

</html>