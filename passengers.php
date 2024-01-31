<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passengers - RailwaySystem</title>
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

    <h2 class="make-center"> Registered Passengers List </h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $passenger_id = $_POST["record_id"];
        
        // Perform the actual delete operation using SQL
        $sql2 = "DELETE FROM passenger WHERE passenger_id = $passenger_id";
        if (mysqli_query($conn, $sql2)) {
            echo '<p class="notify-green">Passenger record '.$passenger_id.' deleted successfully!</p>';
        } else {
            echo '<p class="notify-green">Couldn\'t delete Passenger record '.$passenger_id.'!</p>';
        }
    }
    ?>
    <div class="info_table">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Passenger Name</th>
                    <th>Contact Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    $query = "SELECT * FROM passenger";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                       if($_SESSION["contact_number"] !== $row['contact_number']){
                        echo '<tr>';
                        echo '<td>' . $row['passenger_id'] . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['contact_number'] . '</td>';
                        echo '<td>';
                        echo '<form action="" method="POST" id="deleteForm'.$row['passenger_id'].'">
                                <a href="edit_passengers.php?passenger_id='.$row['passenger_id'].'">Edit info</a> | 
                                <input type="hidden" name="record_id" value="'.$row['passenger_id'].'">
                                <button type="button" onclick="confirmDelete('.$row['passenger_id'].')">Delete</button>
                              </form>';
                        echo '</td>';
                        echo '</tr>';
                       }
                    }
                    ?>
                    <script>
                        function confirmDelete(passengerId) {
                            if (confirm(`Are you sure you want to delete record ${passengerId}?`)) {
                                document.getElementById("deleteForm"+passengerId).submit();
                            }
                        }
                    </script>
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