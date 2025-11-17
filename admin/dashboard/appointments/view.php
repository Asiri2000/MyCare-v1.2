<?php

require "../../../dbConfig/dbConfig.php";

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
    <title>View Appointments</title>
    <!-- Styles -->
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
            <h1 class="text-center">View Appointments</h1>
            <table class="table table-bordered table-striped">
                <thead class="bg-navy text-white">
                    <tr>
                        <th>ID</th>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Room Name</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Current Status</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT appointment.Appointment_id, patient.Patient_name, doctor.Doctor_name, appointment.Date, appointment.Start_time, appointment.End_time, appointment.Room_id, appointment_status.Status FROM appointment JOIN patient ON appointment.Patient_id = patient.Patient_id JOIN doctor ON appointment.Doctor_id = doctor.Doctor_id JOIN appointment_status ON appointment.status = appointment_status.id ORDER BY appointment.Appointment_id DESC";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $room_name = "<span class='badge-secondary'>Not Assigned</span>";
                            if (!is_null($row["Room_id"])) {
                                $sql_room = "SELECT room.Room_name FROM room WHERE Room_id = $row[Room_id]";
                                $result_rooms = mysqli_query($conn, $sql_room);

                                if (mysqli_num_rows($result_rooms) > 0) {
                                    while ($row_room = mysqli_fetch_assoc($result_rooms)) {
                                        $room_name = $row_room['Room_name'];
                                    }
                                }
                            }

                            echo "
                                <tr>
                                    <td>{$row['Appointment_id']}</td>
                                    <td>{$row['Doctor_name']}</td>
                                    <td>{$row['Patient_name']}</td>
                                    <td>$room_name</td>
                                    <td>{$row['Date']}</td>
                                    <td>{$row['Start_time']}</td>
                                    <td>{$row['End_time']}</td>
                                    <td><span class='badge-primary {$row['Status']}'>" . ucwords($row['Status']) . "</span></td>
                                    <td><a href='update.php?appointment={$row['Appointment_id']}'>Update</a></td>
                                    <td><a href='delete.php?appointment={$row['Appointment_id']}'>Delete</a></td>
                                </tr>
                            ";
                        }
                    } else {
                        echo "
                            <tr>
                                <td colspan='10' class='empty-result text-center'>No results found</td>
                            </tr>
                        ";
                    }

                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
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
        echo "<script>alert('{$_GET['message']}');</script>";
    }
    ?>
</body>

</html>
