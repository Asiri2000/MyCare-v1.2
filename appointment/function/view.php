<?php

require "../../DbConnector/DbConnector.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: /my_care_hcm/patient/index.php?error=You are not logged in");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Appointments</title>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../css/common.css">
</head>

<body>

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

    <div>
        <h1 class="text-center">View Appointments</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Doctor Name</th>
                <th>Room Name</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
            <?php
               $db = new DbConnector();
               $conn = $db->getConnection();


            $sql = "SELECT appointment.Appointment_id, patient.Patient_name, doctor.Doctor_name, appointment.Date, appointment.Start_time, appointment.End_time, appointment.Room_id, appointment_status.Status FROM appointment JOIN patient ON appointment.Patient_id = patient.user_id JOIN doctor ON appointment.Doctor_id = doctor.Doctor_id JOIN appointment_status ON appointment_status.id = appointment.Status WHERE patient.Patient_id = $_SESSION[user_id] ORDER BY appointment.Appointment_id DESC;";
             $result = $conn->prepare($sql);
               $result->execute();

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
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
                            <td>$row[Appointment_id]</td>
                            <td>$row[Doctor_name]</td>
                            <td>$room_name</td>
                            <td>$row[Date]</td>
                            <td>$row[Start_time]</td>
                            <td>$row[End_time]</td>
                            <td><span class='badge-primary $row[Status]'>" . ucwords($row["Status"]) . "</span></td>
                    ";

                    if ($row['Status'] === 'pending') {
                        echo "<td><a href='delete.php?appointment=$row[Appointment_id]'>Delete</a></td>";
                    } else {
                        echo "<td>Not Allowed</td>";
                    }

                    echo "</tr>";
                }
            } else {
                echo "
                    <tr>
                        <td colspan='6' class='empty-result'>No results found</td>
                    </tr>
                ";
            }

            mysqli_close($conn);
            ?>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-navy text-white text-center text-lg-start mt-auto w-100">
        <div class="text-center p-3">
            <a class="text-white" href="#">2024</a> | <a class="text-white" href="#">My Care</a> | <a class="text-white" href="#">About Us</a> | <a class="text-white" href="#">Contact Us</a>
        </div>
    </footer>

</body>

</html>
