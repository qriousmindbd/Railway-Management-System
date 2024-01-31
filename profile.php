<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page - RailwaySystem</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/insights.css">
</head>
<body>
    <header>
        <?php
            if(isset($_SESSION["contact_number"])) {
                include_once('components/logd_header.php');
            } else {
                include_once('components/header.php');
            }
            
            if(isset($_GET['message']) && $_GET['message'] === 'proupsuccess') {
                echo '<p class="notify-green">Profile Successfully Updated.</p>';
            }
        ?>
    </header>

    <?php
        include_once('components/profile_header.php');
    ?>
    
    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>