<?php

require "../../../dbConfig/dbConfig.php";

if (!isset($_SESSION["Admin_name"])) {
    header("Location: /my_care_hcm/admin/index.php?error=You are not logged in");
    exit();
}

// define variables and set to empty values
$dep_name = "";

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = validate($_POST["dep_name"]);

    $sql = "INSERT INTO department (department_name) VALUES ('$name')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: view.php");
        exit();
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
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

        
            
            <div class="col-md-10 content">
                <div class="container mt-4">
                    <h2 class="text-center">Add New Department</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="w-75 mx-auto">
                        <div class="mb-3">
                            <label for="dep_name" class="form-label">Department Name:</label>
                            <input type="text" id="dep_name" name="dep_name" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-navy w-100" style="color: white;">Create</button>
                    </form>
                </div>
            </div>
        

        <footer class="bg-navy text-white text-center text-lg-start mt-auto w-100">
            <div class="text-center p-3">
                <a class="text-white" href="#">2024</a> | <a class="text-white" href="#">My Care</a> | <a class="text-white" href="#">About Us</a> | <a class="text-white" href="#">Contact Us</a>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
