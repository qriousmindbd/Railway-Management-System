<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");
include_once("processors/db_functions.php");

$contact_number = $_SESSION['contact_number'];
$passengerId = $_SESSION["userId"];


$query = "SELECT * FROM passenger WHERE contact_number = $contact_number";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book A New Ticket - RailwaySystem</title>
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

    <?php
        // Ticket Booking process for passenger
        if (isset($_POST["submitticket"])) {
            $lastid = getLastIdValue('ticket_id', 'ticket', $conn) + 1;
            $seat_number = $_POST["seat_number"];
            $schedule_id = $_POST["schedule_id"];
            $ticket_price = $_POST["ticket_price"];
            $journey_date = $_POST['journey_date'];

            if (!empty($seat_number) && !empty($schedule_id) && !empty($ticket_price) && !empty($journey_date)) {
                $query = "INSERT INTO ticket (ticket_id,schedule_id, passenger_id, seat_number, ticket_price, journey_date) VALUES ($lastid, $schedule_id, $passengerId, '$seat_number', '$ticket_price', '$journey_date')";
                
                if (mysqli_query($conn, $query)) {
                    header("Location: tickets.php?message=proupsuccess");
                } else {
                    echo '<p class="notify-red">Error: ' . mysqli_error($conn) . '</p>';
                }
            } else {
                echo '<p class="notify-red">Please fill in all the fields!</p>';
            }
        }
    ?>

    <form class="book-ticket-container" action="" method="POST">
    <h1>Book A New Ticket</h1>
    <p>please fill up the following requirements</p><br>
        <!-- Passenger Details -->
        <input type="hidden" id="id" name="passenger_id" value="<?php if(isset($user['passenger_id'])) echo $user['name'];?>">
        
        <label for="name">Name:<font color="red"><sup>*</sup></font></label>
        <input type="text" id="name" name="name" placeholder="<?php if(isset($user['passenger_id'])) echo $user['name'].'" disabled'; else echo 'Enter your name..." required';?> >

        <!-- Travel Details -->
        <label for="schedule_id">Schedule ID:<font color="red"><sup>*</sup></font></label>
        <select name="schedule_id" id="schedule_id">
            <option value="">-- Select --</option>
            <?php
                $scheduleIds = mysqli_query($conn, "SELECT * FROM schedule INNER JOIN train ON schedule.train_id = train.train_id;");

                while ($row = mysqli_fetch_assoc($scheduleIds)) {
                    echo '<option value="'. $row['schedule_id'] .'">'. $row['schedule_id'] .' - ' . $row['train_name'] . '</option>" required>';
                }
            ?>
        </select><br>

        <label for="phone">Seat Number:<font color="red"><sup>*</sup></font></label>
        <input type="text" id="seat_number" name="seat_number" placeholder="<?php if(isset($user['seat_number'])) echo $user['seat_number'].'" disabled'; else echo 'Enter your seat number..." required';?> ><br>

        <label for="ticket_price">Ticket Price:<font color="red"><sup>*</sup></font></label>
        <input type="number" id="ticket_price" name="ticket_price" placeholder="Enter Ticket price..." required><br>

        <label for="journey_date">Journey Date:<font color="red"><sup>*</sup></font></label>
        <input type="date" id="departure_date" name="journey_date" required><br>

        <!-- Payment Information 
        <label for="card_number">Credit Card Number:</label>
        <input type="text" id="card_number" name="card_number" placeholder="Enter credit card..." required><br>

        <label for="expiration_date">Expiration Date:</label>
        <input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY" required><br>

        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" maxlength="3" placeholder="Enter 3 digits of your CVV..." required><br> -->
       

        <!-- Submit Button -->
        <input type="submit" name="submitticket" value="Book Now">
    </form>

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>