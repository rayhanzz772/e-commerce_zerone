<?php
session_start();
session_destroy();
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/user/index.php';
header('Location: ' . $home_url);
?>
<!-- masih error -->