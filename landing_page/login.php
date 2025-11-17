<?php
session_start();

$host = 'localhost';
$dbname = 'mycare';
$dbuser = 'root';
$dbpw = '';
$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $dbuser, $dbpw, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);


    $query = "SELECT * FROM patient WHERE username = :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$user) {
        $query = "SELECT * FROM doctor WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];

        $cookie_name = 'user_login';
        $cookie_value = $_SESSION['user_id'];
        setcookie($cookie_name, $cookie_value, time() + 3600, '/'); 


        if (isset($user['doctor_id'])) {
            header('Location: dummydoctor.php');
            exit();
        } elseif (isset($user['user_id'])) {
            header('Location: http://localhost/MyCarev1.1/dashboard.php');
            exit();
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
        echo '<h1 class="fp-title" style="color: red;">Invalid Username or password</h1>';
        echo '<p class="fp-description"> password or username name invalid , Try resetting :</p>';
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
