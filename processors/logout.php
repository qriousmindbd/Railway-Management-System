<?php
session_start();
session_unset();
session_destroy();
header("Location: /railway_system/welcome.php");
exit();
?>