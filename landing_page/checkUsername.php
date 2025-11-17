<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}

$conn = new mysqli('localhost', 'root', '', 'mycare');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $sql_patient = "SELECT * FROM patient WHERE username = ?";
    $stmt_patient = $conn->prepare($sql_patient);
    $stmt_patient->bind_param("s", $username);
    $stmt_patient->execute();
    $result_patient = $stmt_patient->get_result();

    $sql_doctor = "SELECT * FROM doctor WHERE username = ?";
    $stmt_doctor = $conn->prepare($sql_doctor);
    $stmt_doctor->bind_param("s", $username);
    $stmt_doctor->execute();
    $result_doctor = $stmt_doctor->get_result();

    $sql_admin = "SELECT * FROM admin WHERE username = ?";
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bind_param("s", $username);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_patient->num_rows > 0 || $result_doctor->num_rows > 0|| $result_admin->num_rows > 0) {
        echo json_encode(['available' => false]);
    } else {
        echo json_encode(['available' => true]);
    }

    $stmt_patient->close();
    $stmt_doctor->close();
    $conn->close();
}
?>
