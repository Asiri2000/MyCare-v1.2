<?php



session_start();
session_destroy();

if (isset($_COOKIE['username'])) {
    setcookie('username', '', 0, "/"); 
}
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', 0, "/"); 
}



header("Location: http://localhost/MyCarev1.1/index.html");
exit;
?>