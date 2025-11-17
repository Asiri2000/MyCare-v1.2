<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

$host = 'localhost';
$dbname = 'mycare';
$dbuser = 'root';
$dbpw = '';
$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $dbuser, $dbpw, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Enter a valid email.");
    } else {
        $sanitizedemail = filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    // Check if email exists in either patient or doctor table
    $sqlPatient = "SELECT patient_id FROM patient WHERE email = ?";
    $sqlDoctor = "SELECT doctor_id FROM doctor WHERE email = ?";
    $stmtPatient = $pdo->prepare($sqlPatient);
    $stmtDoctor = $pdo->prepare($sqlDoctor);
    $stmtPatient->execute([$sanitizedemail]);
    $stmtDoctor->execute([$sanitizedemail]);

    if ($stmtPatient->rowCount() > 0 || $stmtDoctor->rowCount() > 0) {
        $code = random_int(100000, 999999);
        $expires_at = date('Y-m-d H:i:s', strtotime('+4 hour')); 

        // Determine which table to update based on email existence
        if ($stmtPatient->rowCount() > 0) {
            $updateSql = "UPDATE patient SET reset_code = ?, token_expire = ? WHERE email = ?";
        } else {
            $updateSql = "UPDATE doctor SET reset_code = ?, token_expire = ? WHERE email = ?";
        }

        // Update reset code and expiration time
        $stmtUpdate = $pdo->prepare($updateSql);
        $stmtUpdate->execute([$code, $expires_at, $sanitizedemail]);

        $_SESSION['email'] = $sanitizedemail;
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                           // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';      // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                  // Enable SMTP authentication
            $mail->Username   = 'chethanakumarikumari337@gmail.com'; // SMTP username
            $mail->Password   = 'tmcy neqx xguh bmxp'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also accepted
            $mail->Port       = 587;                   // TCP port to connect to

            // Recipients
            $mail->setFrom('chethanakumarikumari337@gmail.com', 'MyCare');
            $mail->addAddress($sanitizedemail);        // Add a recipient
            $mail->addReplyTo('No-Reply@Noreply.com', 'Do not reply');

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset Code';
            $mail->Body    = 'Your password reset code is: <b>' . $code . '</b>';
            $mail->AltBody = 'Your password reset code is: ' . $code;

            $mail->send();
            echo 'Password reset code has been sent to your email.';
            header('Location: reset-code-validation.html');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Health Management</title>';
        echo '<link rel="stylesheet" href="styles.css">';
        echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">';
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">';
        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
                crossorigin="anonymous"></script>';
        echo '<script src="https://kit.fontawesome.com/9f2f1fcf1c.js" crossorigin="anonymous"></script>';
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
        echo '</head>';
        
        echo '<body>';
        echo '<script src="index.js"></script>';
        
        echo '<header class="container-fluid">';
        echo '<div class="row align-items-center">';
        echo '<div class="col-3 d-md-none text-start">';
        echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">';
        echo '<span class="navbar-toggler-icon"></span>';
        echo '</button>';
        echo '</div>';
        echo '<div class="col-6 col-md-3 text-center">';
        echo '<a href="index.html"> <img src="logo2.png" alt="Logo" class="logoimg"></a>';
        echo '</div>';
        echo '<div class="col-3 d-md-none text-end auth-links">';
        echo '<a href="#" class="me-2">Login</a>';
        echo '<a href="#" data-bs-toggle="modal" data-bs-target="#registrationModal">Sign Up</a>';
        echo '</div>';
        echo '<nav class="col-12 col-md-6 d-none d-md-block">';
        echo '<ul class="nav justify-content-end">';
        echo '<li class="nav-item"><a class="nav-link" href="#">Home</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="#">Doc Chat</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="#">Appointments</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="#">Reminders</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="#">Health Guidance</a></li>';
        echo '</ul>';
        echo '</nav>';
        echo '<div class="col-12 col-md-3 d-none d-md-block text-end auth-links">';
        echo '<a href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a> | <a href="#"
                data-bs-toggle="modal" data-bs-target="#registrationModal">Sign Up</a>';
        echo '</div>';
        echo '</div>';
        echo '</header>';
        echo '<nav class="collapse" id="navbarNav">';
        echo '<ul class="nav flex-column text-center">';
        echo '<li class="nav-item"><a class="nav-link" href="#">Home</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="#">Doc Chat</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="#">Appointments</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="#">Reminders</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="#">Health Guidance</a></li>';
        echo '</ul>';
        echo '</nav>';
        
        echo '<div class="fp-container">';
        echo '<div class="reset-inner-div">';
        echo '<div class="fp-card">';
        echo '<h1 class="fp-title" style="color: red;">Invalid Email.</h1>';
        echo '<p class="fp-description"> No account found with this email</p>';
        echo '<button type="button" class="fp-submit-btn" onclick="location.href=\'index.html\'"> Back to Login page</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '<footer class="container-fluid bg-dknavy text-white text-center py-3">';
        echo '<p>&copy; 2023 Health Management. All rights reserved.</p>';
        echo '<ul class="list-inline">';
        echo '<li class="list-inline-item"><a href="#" class="text-white">2024 | </a></li>';
        echo '<li class="list-inline-item"><a href="#" class="text-white">MyCare | </a></li>';
        echo '<li class="list-inline-item"><a href="#" class="text-white">About Us | </a></li>';
        echo '<li class="list-inline-item"><a href="#" class="text-white">Contact Us</a></li>';
        echo '</ul>';
        echo '</footer>';
        echo '</body>';
    }
}

?>
