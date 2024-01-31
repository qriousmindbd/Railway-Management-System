<?php
session_start();

if(!isset($_SESSION['contact_number'])) {
    header("Location: /railway_system/welcome.php");
    exit();
}

?>