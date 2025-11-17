<?php

require "../../../dbConfig/dbConfig.php";

if (!isset($_SESSION["Admin_name"])) {
    header("Location: /my_care_hcm/admin/index.php?error=You are not logged in");
    exit();
}

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room = validate($_POST["change_room"]);
    $status = validate($_POST["change_status"]);
    $appointment = validate($_POST["appointment_id"]);

    $sql_update = "UPDATE appointment SET Room_id = '$room', Status= '$status' WHERE Appointment_id = $appointment";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: view.php?message=Updated successfully");
        exit();
    }
} else {
    if (!isset($_GET['appointment']) || empty($_GET['appointment']) || !is_numeric($_GET['appointment'])) {
        header("Location: view.php");
        exit();
    }
    $appointment_id = $_GET['appointment'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Appointment</title>
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
            <h1 class="text-center">Update Appointment</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <?php
                $sql = "SELECT appointment.Appointment_id, patient.Patient_name, doctor.Doctor_name, appointment.Date, appointment.Start_time, appointment.End_time, appointment.Room_id, appointment_status.Status, Department.Department_name FROM appointment JOIN patient ON appointment.Patient_id = patient.Patient_id JOIN doctor ON appointment.Doctor_id = doctor.Doctor_id JOIN appointment_status ON appointment.status = appointment_status.id JOIN department ON doctor.Department_id = Department.Department_id WHERE appointment.Appointment_id = $appointment_id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $department = $row['Department_name'];
                        $patient_name = $row['Patient_name'];
                        $doctor_name = $row['Doctor_name'];
                        $date = $row['Date'];
                        $start_time = $row['Start_time'];
                        $end_time = $row['End_time'];
                        $room_id = $row['Room_id'];
                        $status = $row['Status'];
                        $room_name = "Not Assigned";
                        $isRoomAssigned = false;
                        if (!is_null($row["Room_id"])) {
                            $sql_room = "SELECT room.Room_name FROM room WHERE Room_id = $row[Room_id]";
                            $result_rooms = mysqli_query($conn, $sql_room);

                            if (mysqli_num_rows($result_rooms) > 0) {
                                while ($row_room = mysqli_fetch_assoc($result_rooms)) {
                                    $room_name = $row_room['Room_name'];
                                    $isRoomAssigned = true;
                                }
                            }
                        }
                    }
                }
                ?>

                <div class="mb-3" style="display: none;">
                    <label for="appointment">Appointment ID:</label>
                    <input type="text" name="appointment_id" value="<?= $appointment_id ?>" id="appointment" class="form-control" />
                </div>

                <div class="mb-3">
                    <label for="department">Department:</label>
                    <input type="text" name="" value="<?= $department ?>" id="department" class="form-control" disabled />
                </div>

                <div class="mb-3">
                    <label for="doctor">Doctor:</label>
                    <input type="text" name="" value="<?= $doctor_name ?>" id="doctor" class="form-control" disabled />
                </div>

                <div class="mb-3">
                    <label for="date">Date:</label>
                    <input type="date" id="date" value="<?= $date ?>" name="date" class="form-control" required disabled />
                </div>

                <div class="mb-3">
                    <label for="start_time">Start Time:</label>
                    <input type="text" name="" value="<?= $start_time ?>" id="start_time" class="form-control" disabled />
                </div>

                <div class="mb-3">
                    <label for="end_time">End Time:</label>
                    <input type="text" name="" value="<?= $end_time ?>" id="end_time" class="form-control" disabled />
                </div>

                <div class="mb-3">
                    <label for="room">Room:</label>
                    <input type="text" name="" value="<?= $room_name ?>" id="room" class="form-control" disabled />
                </div>

                <?php if (!$isRoomAssigned) : ?>
                    <div class="mb-3">
                        <label for="change_room">Change Room:</label>
                        <select id="change_room" name="change_room" class="form-select" required></select>
                    </div>
                <?php else : ?>
                    <div class="mb-3" style="display: none;">
                        <label for="change_room">Change Room:</label>
                        <input type="text" name="change_room" value='<?= $room_id ?>' id="change_room" class="form-control" />
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="status">Current Status:</label>
                    <input type="text" name="" value="<?= ucwords($status) ?>" id="status" class="form-control" disabled />
                </div>

                <div class="mb-3">
                    <label for="change_status">Change Status:</label>
                    <select name="change_status" id="change_status" class="form-select" required>
                        <?php
                        $sql = "SELECT id, Status FROM appointment_status";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $selected = ($row['Status'] === $status) ? 'selected' : '';
                                echo "<option value='{$row['id']}' $selected>" . ucwords($row['Status']) . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <input type="submit" value="Submit" class="btn" style="background-color: navy; color: white;">
            </form>
        </div>

        <footer class="bg-navy text-white text-center text-lg-start mt-auto w-100">
            <div class="text-center p-3">
                <a class="text-white" href="#">2024</a> | <a class="text-white" href="#">My Care</a> | <a class="text-white" href="#">About Us</a> | <a class="text-white" href="#">Contact Us</a>
            </div>
        </footer>
    </div>

    <script>
        window.onload = function() {
            const start_time = document.getElementById('start_time').value.replace(" ", "%20");
            const date = document.getElementById('date').value;
            const URL = `http://localhost/my_care_hcm/admin/api/get_rooms.php?date=${date}&&start_time="${start_time}"`;

            const select_tag = document.getElementById('change_room');

            if (select_tag !== null) {
                const xhr = new XMLHttpRequest();
                xhr.open("GET", URL, true);
                xhr.getResponseHeader("Content-type", "application/json");
                xhr.onload = function() {
                    const rooms = JSON.parse(this.responseText);
                    rooms.forEach(room => {
                        const option = document.createElement('option');
                        option.value = room.id;
                        option.innerText = room.name;
                        if (room.booked) {
                            option.disabled = true;
                        }
                        select_tag.appendChild(option);
                    });
                }
                xhr.send();
            }
        }
    </script>
</body>

</html>
