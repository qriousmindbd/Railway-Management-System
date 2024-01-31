<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Trains - RailwaySystem</title>
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

    <h2 class="make-center"> Manage Train List </h2>
    <div class="info_table">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Train Code</th>
                    <th>Train Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM train";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['train_id'] . '</td>';
                    echo '<td>' . $row['train_name'] . '</td>';
                    echo '<td>';
                    echo '<a href="edit.php?train_id=' . $row['train_id'] . '">Edit</a>'; // Link to edit page
                    echo ' | ';
                    echo '<a href="delete.php?train_id=' . $row['train_id'] . '">Delete</a>';
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