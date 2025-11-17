<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    <header class="container-fluid">
        <div class="row align-items-center">
            <div class="col-6 col-md-3 text-center">
                <a href="index.html"><img src="logo2.png" alt="Logo" class="logoimg"></a>
            </div>
        </div>
    </header>

    <main class="container">
        <section class="row align-items-center justify-content-center">
            <div class="col-12 col-md-6">
                <h1>Forgot Password</h1>
                <p>Enter your email address to reset your password.</p>
                <form action="forgot-password.php" method="POST">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control item" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer class="container-fluid bg-dknavy text-white text-center py-3">
        <p>&copy; 2023 Health Management. All rights reserved.</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="text-white">2024 | </a></li>
            <li class="list-inline-item"><a href="#" class="text-white">MyCare | </a></li>
            <li class="list-inline-item"><a href="#" class="text-white">About Us | </a></li>
            <li class="list-inline-item"><a href="#" class="text-white">Contact Us</a></li>
        </ul>
    </footer>
</body>
</html>
