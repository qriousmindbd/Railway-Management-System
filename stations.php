<?php
session_start();
include_once("processors/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stations - RailwaySystem</title>
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
        ?>
    </header>

    <?php
        if(isset($_SESSION["contact_number"])) {
            include_once('components/profile_header.php');
        }
    ?>

    <h2 class="make-center"> Available Train Stations </h2>
    <div class="info_table">
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th>SL. No.</th>
        <th>Name</th>
        <th>City</th>
        <th>Phone</th>
        <?php if($_SESSION['admin'] == $_SESSION['userId']) {echo '<th>Action</th>';} ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM station";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['station_id'] . '</td>';
            echo '<td>' . $row['station_name'] . '</td>';
            echo '<td>' . $row['location'] . '</td>';
            echo '<td>' . $row['contact_number'] . '</td>';
            if(isset($_SESSION["contact_number"]) && $_SESSION['admin'] == $_SESSION['userId']) {
                echo '<td>';
                echo '<a href="edit.php?station_id=' . $row['station_id'] . '">Edit</a>'; // Link to edit page
                echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
    </table>
    </div>

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>