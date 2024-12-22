<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets - RailwaySystem</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/insights.css">
</head>
<body>
    <header>
        <?php
            $user_contact_number = $_SESSION["contact_number"];

            if(empty($user_contact_number)) {
                include_once('components/header.php');
                $query = "SELECT t.ticket_id, p.name AS passenger_name, 
                                            p.contact_number AS passenger_contact, 
                                            s.train_id, t.seat_number, t.ticket_price, 
                                            t.journey_date, tr.train_name 
                                    FROM ticket AS t 
                                    INNER JOIN passenger AS p ON t.passenger_id = p.passenger_id 
                                    INNER JOIN schedule AS s ON t.schedule_id = s.schedule_id 
                                    INNER JOIN train AS tr ON s.train_id = tr.train_id;";
            } else {
                include_once('components/logd_header.php');
                $query = "SELECT t.ticket_id, p.name AS passenger_name, 
                                            p.contact_number AS passenger_contact, 
                                            s.train_id, t.seat_number, t.ticket_price, 
                                            t.journey_date, tr.train_name 
                                    FROM ticket AS t 
                                    INNER JOIN passenger AS p ON t.passenger_id = p.passenger_id 
                                    INNER JOIN schedule AS s ON t.schedule_id = s.schedule_id 
                                    INNER JOIN train AS tr ON s.train_id = tr.train_id
                                    WHERE p.contact_number = '" . $user_contact_number . "';";
            }
        ?>
    </header>

    <?php
        include_once('components/profile_header.php');
    ?>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ticket_id = $_POST["record_id"];
            
            // Perform the actual delete operation using SQL
            $sql2 = "DELETE FROM ticket WHERE ticket_id = $ticket_id";
            if (mysqli_query($conn, $sql2)) {
                echo '<p class="notify-green">Ticket ID '.$ticket_id.' process cancellation done!</p>';
            } else {
                echo '<p class="notify-green">Couldn\'t cancel ticket id '.$ticket_id.'!</p>';
            }
        }

        if(isset($_GET['message']) && $_GET['message'] === 'booksuccess') {
            echo '<p class="notify-green">Ticket booked successfully! Please wait for further process.</p>';
        }
    ?>

    <h2 class="make-center"> Ticket Details </h2>
    <div class="info_table">
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
        <th>Ticket No.</th>
        <th>Passenger Name</th>
        <th>Passenger Contact</th>
        <th>Train ID</th>
        <th>Train Name</th>
        <th>Seat No.</th>
        <th>Ticket Price(BDT)</th>
        <th>Journey Date</th>
        <?php if(isset($_SESSION["contact_number"])) {
            echo '<th>Status</th>';
        }?>
        <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php

        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['ticket_id'] . '</td>';
            echo '<td>' . $row['passenger_name'] . '</td>';
            echo '<td>' . $row['passenger_contact'] . '</td>';
            echo '<td>' . $row['train_id'] . '</td>';
            echo '<td>' . $row['train_name'] . '</td>';
            echo '<td>' . $row['seat_number'] . '</td>';
            echo '<td>' . $row['ticket_price'] . '</td>';
            echo '<td>' . $row['journey_date'] . '</td>';
            echo '<td> <font color="green"> Booked </font> </td>';
            if(isset($_SESSION["contact_number"])) {
                echo '<td>';
                echo '<form action="" method="POST" id="deleteForm'.$row['ticket_id'].'">
                                <input type="hidden" name="record_id" value="'.$row['ticket_id'].'">
                                <button type="button" onclick="confirmDelete('.$row['ticket_id'].')">Cancel ticket</button>
                              </form>';
                echo '</td>';
            }
            echo '</tr>';
        }
        ?>
    </tbody>
    </table>
        <script>
            function confirmDelete(ticketId) {
                if (confirm(`Are you sure you want to cancel ticket ${ticketId}?`)) {
                    document.getElementById("deleteForm"+ticketId).submit();
                }
            }
        </script>
    </div>

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>