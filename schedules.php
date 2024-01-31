<?php
session_start();
include_once("processors/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Schedule - RailwaySystem</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
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

    <h2 class="make-center"> Train Schedules </h2>
    <div class="info_table">
        <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Schedule ID</th>
            <th>Train Name</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM schedule LEFT OUTER JOIN train ON schedule.train_id = train.train_id";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['schedule_id'] . '</td>';
                echo '<td>' . $row['train_name'] . '</td>';
                echo '<td>' . $row['departure_time'] . '</td>';
                echo '<td>' . $row['arrival_time'] . '</td>';
                echo '</tr>';
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