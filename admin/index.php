<?php

require "../dbConfig/dbConfig.php";

// define variables and set to empty values
$email = $password = "";

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);

    if (empty($email)) {
        header("Location: index.php?error=Email is required");
        exit();
    } elseif (empty($password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {

        $sql = "SELECT Admin_name, Admin_email, Admin_password FROM admin WHERE Admin_email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row["Admin_password"])) {
                    $_SESSION["Admin_name"] = $row["Admin_name"];
                    $_SESSION["Admin_email"] = $row["Admin_email"];
                    header("Location: dashboard/index.php");
                    exit();
                } else {
                    header("Location: index.php?error=Incorrect email or password");
                    exit();
                }
            }
        } else {
            header("Location: index.php?error=Incorrect email or password");
            exit();
        }

        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/common.css">
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
            <form class="form admin-login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h1>Admin Login</h1>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <input type="submit" name="submit" id="submit" value="Login" class="btn btn-primary">
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
        echo "<script>alert('{$_GET['message']}');</script>";
    }
    ?>
</body>

</html>
