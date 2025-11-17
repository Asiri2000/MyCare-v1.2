<?php
session_start();

$host = 'localhost';
$dbname = 'mycare';
$dbuser = 'root';
$dbpw = '';
$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $dbuser, $dbpw, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if (isset($_POST['reset-code'])) {
    $resetcode = htmlspecialchars($_POST['reset-code']);

    if (isset($_SESSION['email'])) {
        $sanitizedemail = $_SESSION['email'];

        // Check if the email exists in either patient or doctor table
        $sqlPatient = "SELECT reset_code, token_expire FROM patient WHERE email = ?";
        $sqlDoctor = "SELECT reset_code, token_expire FROM doctor WHERE email = ?";
        
        // Check in patient table
        $stmtPatient = $pdo->prepare($sqlPatient);
        $stmtPatient->execute([$sanitizedemail]);
        $resultPatient = $stmtPatient->fetch(PDO::FETCH_ASSOC);
        
        // Check in doctor table if not found in patient
        if (!$resultPatient) {
            $stmtDoctor = $pdo->prepare($sqlDoctor);
            $stmtDoctor->execute([$sanitizedemail]);
            $resultDoctor = $stmtDoctor->fetch(PDO::FETCH_ASSOC);
        } else {
            $resultDoctor = false; // Set to false if found in patient
        }

        if ($resultPatient || $resultDoctor) {
            $storedResetCode = $resultPatient ? $resultPatient['reset_code'] : $resultDoctor['reset_code'];
            $tokenExpireTime = $resultPatient ? $resultPatient['token_expire'] : $resultDoctor['token_expire'];

            // Validate reset code and token expiration
            if ($storedResetCode == $resetcode && strtotime($tokenExpireTime) > time()) {
                // Redirect to password reset form
                header('Location: password-reset-form.html');
                exit();
            } else {
                echo "Invalid reset code or the code has expired.";
                header('Location: forgotpassword.html');
                exit();
            }
        } else {
            echo "No reset code found for this email.";
        }
    } else {
        echo "Email is not set in session.";
    }
} else {
    echo "Please provide a reset code.";
}
?>
