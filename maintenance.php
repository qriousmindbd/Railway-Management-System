<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - RailwaySystem</title>
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
        include_once('components/profile_header.php');
    ?>

    <h2 class="make-center"> Manage Train Maintenance Logs </h2>
    <div class="info_table">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>M.Log ID</th>
                    <th>Train Name</th>
                    <th>M. Date</th>
                    <th>Log details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT maintenance.maintenance_id, maintenance.train_id, maintenance.maintenance_date, maintenance.description, train.train_name
                            FROM maintenance
                            INNER JOIN train ON maintenance.train_id = train.train_id;";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['maintenance_id'] . '</td>';
                    echo '<td>' . $row['train_name'] . '</td>';
                    echo '<td>' . $row['maintenance_date'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>';
                    echo '<a href="edit.php?maintenance_id=' . $row['maintenance_id'] . '">Edit</a>'; // Link to edit page
                    echo ' | ';
                    echo '<a href="delete.php?maintenance_id=' . $row['maintenance_id'] . '">Delete</a>'; // Link to delete page
                    echo '</td>';
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