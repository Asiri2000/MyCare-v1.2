<?php



session_start();
session_unset();
session_destroy();
setcookie('username', '', time()-30, '/');
setcookie('f_name', '', time()-30, '/');
setcookie('l_name', '', time()-30, '/');
header("location:http://localhost/MyCarev1.1/DoctorDashBoard/login.php");
exit();


?>