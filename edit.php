<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");

// Maintenance Logs Edit process
if (isset($_GET["maintenance_id"])) {
    $maintenance_id = $_GET["maintenance_id"];

    // Fetch the maintenance record by ID from the database
    $query = "SELECT * FROM maintenance WHERE maintenance_id = $maintenance_id";
    $result = mysqli_query($conn, $query);
    $maintenance_data = mysqli_fetch_assoc($result);
    
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Handle form submission to update the record
    $maintenance_id = $_POST["maintenance_id"];
    $new_maintenance_date = $_POST["new_maintenance_date"];
    $new_description = $_POST["new_description"];

    // Check if the date is empty or invalid
    if (!empty($new_maintenance_date) && strtotime($new_maintenance_date)) {
        // Date is not empty and valid, so update the maintenance record
        $query = "UPDATE maintenance SET maintenance_date = '$new_maintenance_date', description = '$new_description' WHERE maintenance_id = $maintenance_id";
        mysqli_query($conn, $query);
        $message = '<p class="notify-green">Record updated successfully.</p>';
    } else {
        // Date is empty or invalid, show an error message
        $message = '<p class="notify-red">Invalid date format. Please enter a valid date.</p>';
    }
}


// Train Data Edit process
if (isset($_GET["train_id"])) {
    $train_id = $_GET["train_id"];

    // Fetch the train record by ID from the database
    $query = "SELECT * FROM train WHERE train_id = $train_id";
    $result = mysqli_query($conn, $query);
    $train_data = mysqli_fetch_assoc($result);
    
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trainedit"])) {

    $train_id = $_POST["train_id"];
    $new_train_name = $_POST["new_train_name"];

    if (!empty($new_train_name)) {
        $query = "UPDATE train SET train_name = '$new_train_name' WHERE train_id = $train_id";
        mysqli_query($conn, $query);
        $message = '<p class="notify-green">Train data updated successfully</p>';
    } else {
        $message = '<p class="notify-red">Name field is empty!</p>';
    }
}


// Station Data Edit process
if (isset($_GET["station_id"])) {
    $station_id = $_GET["station_id"];

    // Fetch the station record by ID from the database
    $query = "SELECT * FROM station WHERE station_id = $station_id";
    $result = mysqli_query($conn, $query);
    $station_data = mysqli_fetch_assoc($result);
    
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["stationedit"])) {

    $station_id = $_POST["station_id"];
    $new_station_name = $_POST["new_station_name"];
    $new_location = $_POST["new_location"];
    $new_contact_number = $_POST["new_contact_number"];

    if (!empty($new_station_name) && !empty($new_location) && !empty($new_contact_number)) {
        $query = "UPDATE station SET station_name = '$new_station_name', location = '$new_location', contact_number = '$new_contact_number' WHERE station_id = $station_id";
        mysqli_query($conn, $query);
        $message = '<p class="notify-green">Station data updated successfully</p>';
    } else {
        $message = '<p class="notify-red">Please fill in all the fields!</p>';
    }
}


// Schedule Data Edit process
if (isset($_GET["schedule_id"])) {
    $schedule_id = $_GET["schedule_id"];

    // Fetch the schedule record by ID from the database
    $query = "SELECT * FROM schedule WHERE schedule_id = $schedule_id";
    $result = mysqli_query($conn, $query);
    $schedule_data = mysqli_fetch_assoc($result);
    
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["scheduleedit"])) {

    $schedule_id = $_POST["schedule_id"];
    $new_departure_time = $_POST["new_departure_time"];
    $new_arrival_time = $_POST["new_arrival_time"];

    if (!empty($new_departure_time) && !empty($new_arrival_time)) {
        // Use prepared statements to prevent SQL injection
        $query = "UPDATE schedule SET departure_time = '$new_departure_time', arrival_time = '$new_arrival_time' WHERE schedule_id = '$schedule_id'";
        $stmt = mysqli_prepare($conn, $query);
        
        if (mysqli_stmt_execute($stmt)) {
            $message = '<p class="notify-green">Train schedule plan updated successfully</p>';
        } else {
            $message = '<p class="notify-red">Error updating schedule</p>';
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = '<p class="notify-red">Please fill in all the fields!</p>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit by Admin - RailwaySystem</title>
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

    <div class="book-ticket-container">

    <!-- Maintenance Logs Edit form -->
    <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["maintenance_id"])): ?>
        <h1>Edit Maintenance Record</h1>
        <form method="post" action="edit.php">
            <input type="hidden" name="maintenance_id" value="<?php echo $maintenance_data['maintenance_id']; ?>">

            <label for="new_maintenance_date">Maintenance Date:</label>
            <input type="date" name="new_maintenance_date" value="<?php echo $maintenance_data['maintenance_date']; ?>"><br>

            <label for="new_description">Description:</label>
            <textarea name="new_description"><?php echo $maintenance_data['description']; ?></textarea><br>

            <input type="submit" name="update" value="Update">
        </form><br>
        <a class="btn5" href="maintenance.php">Go back to maintenance</a>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])): ?>
        <h1>Edit Maintenance Record</h1>
        <?php echo $message; ?>
        <a class="btn5" href="maintenance.php">Go back to maintenance</a>
    <?php endif; ?>


    <!-- Train Edit form -->
    <?php if (isset($_GET["train_id"])): ?>
        <h1>Edit Train Data</h1>
        <form method="post" action="edit.php">
            <input type="hidden" name="train_id" value="<?php echo $train_data['train_id']; ?>">

            <label for="new_train_name">Train Name:</label>
            <input type="text" name="new_train_name" value="<?php echo $train_data['train_name']; ?>"><br>

            <input type="submit" name="trainedit" value="Update">
        </form><br>
        <a class="btn5" href="manage_train.php">Go to Manage Train</a>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trainedit"])): ?>
        <h1>Edit Train Data</h1>
        <?php echo $message; ?>
        <a class="btn5" href="manage_train.php">Go to Manage Train</a>
    <?php endif; ?>


    <!-- Station Edit form -->
    <?php if (isset($_GET["station_id"])): ?>
        <h1>Edit Station Data</h1>
        <form method="post" action="edit.php">
            <input type="hidden" name="station_id" value="<?php echo $station_data['station_id']; ?>">

            <label for="new_station_name">Station Name:</label>
            <input type="text" name="new_station_name" value="<?php echo $station_data['station_name']; ?>"><br>

            <label for="new_location">Location:</label>
            <input type="text" name="new_location" value="<?php echo $station_data['location']; ?>"><br>

            <label for="new_contact_number">Station Contact Number:</label>
            <input type="text" name="new_contact_number" value="<?php echo $station_data['contact_number']; ?>"><br>

            <input type="submit" name="stationedit" value="Update">
        </form><br>
        <a class="btn5" href="stations.php">Go to Station List</a>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["stationedit"])): ?>
        <h1>Edit Station Data</h1>
        <?php echo $message; ?>
        <a class="btn5" href="stations.php">Go to Station List</a>
    <?php endif; ?>


    <!-- Train Schedule Edit form -->
    <?php if (isset($_GET["schedule_id"])): ?>
        <h1>Edit Schedule Data</h1>
        <form method="post" action="edit.php">
            <input type="hidden" name="schedule_id" value="<?php echo $schedule_data['schedule_id']; ?>">

            <label for="new_departure_time">Departure Time:</label>
            <input type="time" step="900" name="new_departure_time" value="<?php echo $schedule_data['departure_time']; ?>"><br>

            <label for="new_arrival_time">Arrival Time:</label>
            <input type="time" step="900" name="new_arrival_time" value="<?php echo $schedule_data['arrival_time']; ?>"><br>
            <br>
            <input type="submit" name="scheduleedit" value="Update">
        </form>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["scheduleedit"])): ?>
        <h1>Edit schedule Data</h1>
        <?php echo $message; ?>
        <a class="btn5" href="edit_schedule.php">Go to Manage Schedule</a>
    <?php endif; ?>

    </div>

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>