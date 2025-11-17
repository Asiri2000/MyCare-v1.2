<?php
session_start();

if (isset($_POST['tokenid'])) {
    $userid = htmlspecialchars($_POST['tokenid']);
}

if (isset($_POST['Fname'])) {
    $firstname = htmlspecialchars($_POST['Fname']);
}
if (isset($_POST['Lname'])) {
    $lastname = htmlspecialchars($_POST['Lname']);
}
if (isset($_POST['Username'])) {
    $username = htmlspecialchars($_POST['Username']);
}
if (isset($_POST['age'])) {
    $date = htmlspecialchars($_POST['age']);
}
if (isset($_POST['phone-number'])) {
    $phoneNumber = htmlspecialchars($_POST['phone-number']);
}
if (isset($_POST['gender'])) {
    $gender = htmlspecialchars($_POST['gender']);
}
if (isset($_POST['address'])) {
    $address = htmlspecialchars($_POST['address']);
}
if (isset($_POST['allergies'])) {
    $allergies = htmlspecialchars($_POST['allergies']);
}
if (isset($_POST['past-conditions'])) {
    $pastConditions = htmlspecialchars($_POST['past-conditions']);
}
if (isset($_POST['blood-type'])) {
    $bloodType = htmlspecialchars($_POST['blood-type']);
}
if (isset($_POST['password'])) {
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
}
if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Enter a valid email.");
    } else {
        $sanitizedemail = filter_var($email, FILTER_SANITIZE_EMAIL);
    }
}

if (isset($_POST['height'])) {
    $height = htmlspecialchars($_POST['height']);
}
if (isset($_POST['weight'])) {
    $weight = htmlspecialchars($_POST['weight']);
}
if (isset($_POST['Em-contact'])) {
    $Emcontact = htmlspecialchars($_POST['Em-contact']);
}
// Handle checkbox values (diseases)
$diseases = isset($_POST['diseases']) ? $_POST['diseases'] : [];
$selectedDiseases = implode(',', $diseases); 

// Database connection parameters
$host = 'localhost';
$dbname = 'mycare';
$dbuser = 'root';
$dbpw = '';
$dsn = "mysql:host=$host;dbname=$dbname";
$pdo = new PDO($dsn, $dbuser, $dbpw, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// Prepare the SQL query
$query = "INSERT INTO patient (phone_number, first_name, last_name, username, gender, email, birth_date, password, address, allergies, past_conditions, blood_type, diseases, height, weight, emergencyno, registration_date,user_id) 
          VALUES (:phone_number, :first_name, :last_name, :user_name, :gender, :email, :birth_date, :password, :address, :allergies, :past_conditions, :blood_type, :diseases, :height, :weight, :emergencyno, current_timestamp(),:tokenid)";
$stmt = $pdo->prepare($query);

// Bind parameters
$stmt->bindParam(':phone_number', $phoneNumber);
$stmt->bindParam(':first_name', $firstname);
$stmt->bindParam(':last_name', $lastname);
$stmt->bindParam(':user_name', $username);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':email', $sanitizedemail);
$stmt->bindParam(':birth_date', $date);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':allergies', $allergies);
$stmt->bindParam(':past_conditions', $pastConditions);
$stmt->bindParam(':blood_type', $bloodType);
$stmt->bindParam(':diseases', $selectedDiseases);
$stmt->bindParam(':height', $height);
$stmt->bindParam(':weight', $weight);
$stmt->bindParam(':emergencyno', $Emcontact);
$stmt->bindParam(':tokenid', $userid);

try {
    $stmt->execute();
    $_SESSION['registration_success'] = true;
    echo "login was successfull";
    header('Location: index.html');
} catch (PDOException $e) {
    $_SESSION['registration_success'] = false;
    die('Error executing query: ' . $e->getMessage());
    echo  "Try again";
}
?>
