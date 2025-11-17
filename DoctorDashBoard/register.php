<!DOCTYPE html>
<html>
<head>
    <title>Doctor Registration</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Doctor Registration</h2>
        <form action="insert.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="doctor_id">Doctor ID:</label>
                <input type="text" class="form-control" id="doctor_id" name="doctor_id" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="specialization">Specialization:</label>
                <input type="text" class="form-control" id="specialization" name="specialization" required>
            </div>
            <div class="form-group">
                <label for="experience">Experience:</label>
                <input type="text" class="form-control" id="experience" name="experience" required>
            </div>
            <div class="form-group">
                <label for="appointment_fee">Appointment Fee:</label>
                <input type="text" class="form-control" id="appointment_fee" name="appointment_fee" required>
            </div>
            <div class="form-group">
                <label for="room_number">Room Number:</label>
                <input type="text" class="form-control" id="room_number" name="room_number" required>
            </div>
            <div class="form-group">
                <label for="working_hours">Working Hours:</label>
                <input type="text" class="form-control" id="working_hours" name="working_hours" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
