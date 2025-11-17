<?php
if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['available' => false, 'error' => 'Invalid email format']);
        exit();
    }
}

$conn = new mysqli('localhost', 'root', '', 'mycare');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $sql = "SELECT * FROM patient WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['available' => false]);
    } else {
        echo json_encode(['available' => true]);
    }

    $stmt->close();
    $conn->close();
}
?>
