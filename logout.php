<?php
ob_start();
session_start();

unset($_SESSION["login"]);
unset($_SESSION["user_data"]);

header('Location: index.php');
?>