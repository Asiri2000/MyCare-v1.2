<?php
session_start();

if (isset($_SESSION['email'])) {
    $sanitizedemail = filter_var($_SESSION['email'], FILTER_SANITIZE_EMAIL);
}

if (isset($_POST['password'])) {
    $hashed_password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
}

$host = 'localhost';
$dbname = 'mycare';
$dbuser = 'root';
$dbpw = '';
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $dbuser, $dbpw, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    // Check patient table for the email
    $sql = "SELECT email FROM patient WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sanitizedemail]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Email found in patient table
        $table = 'patient';
    } else {
        // Check doctor table for the email
        $sql = "SELECT email FROM doctor WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$sanitizedemail]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Email found in doctor table
            $table = 'doctor';
        } else {
            die("Email not found in both patient and doctor tables.");
        }
    }

    // Prepare and execute the SQL update statement
    $stmt = $pdo->prepare("UPDATE $table SET password = ?, reset_code = NULL, token_expire = NULL WHERE email = ?");
    $stmt->execute([$hashed_password, $sanitizedemail]);

    // Redirect to a success page
    header('Location: reset_success.html');
    exit(); // Ensure no further script execution after redirect
} catch (PDOException $e) {
    die("Error: " . $e->getMessage()); // Handle PDO exceptions
}
?>
