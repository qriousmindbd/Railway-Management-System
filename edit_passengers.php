<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");


(isset($_GET["passenger_id"])? $passenger_id = $_GET["passenger_id"] : $passenger_id = '');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["passenger_id"])) {

    // Fetch the Pasenger record by ID from the database
    $query = "SELECT * FROM passenger WHERE passenger_id = $passenger_id";
    $result = mysqli_query($conn, $query);
    $passenger_data = mysqli_fetch_assoc($result);
    
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Handle form submission to update the record
    $passenger_id = $_POST["passenger_id"];
    $passenger_name = $_POST["passenger_name"];
    $contact_number = $_POST["contact_number"];

    // Check if the date is empty or invalid
    if (!empty($passenger_id)) {
        // Date is not empty and valid, so update the maintenance record
        $query2 = "UPDATE passenger SET name = '$passenger_name', contact_number = '$contact_number' WHERE passenger_id = $passenger_id";
        mysqli_query($conn, $query2);
        $message = "Profile updated successfully.";
    }
} elseif(isset($_POST["delete"])) {
    $query2 = "DELETE FROM passenger WHERE passenger_id = $passenger_id";
    mysqli_query($conn, $query2);
    $message = "Passenger deleted successfully.";
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

    <h1>Edit Passenger Profile</h1>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["passenger_id"])): ?>
        <form method="post" action="">
            <input type="hidden" name="passenger_id" value="<?php echo $passenger_data['passenger_id']; ?>">
            <label for="passenger_name">Passenger Name:</label>
            <input type="text" name="passenger_name" value="<?php echo $passenger_data['name']; ?>"><br>
            <label for="new_description">Contact Number:</label>
            <input type="text" name="contact_number" value="<?php echo $passenger_data['contact_number']; ?>"><br>
            <input type="submit" name="update" value="Update Profile">
        </form>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])): ?>
        <p class="notify-green">Profile updated successfully.</p>
    <?php else: ?>
        <p class="notify-red">Invalid request.</p>
    <?php endif; ?>
    
    <a class="btn5" href="passengers.php">Go back to passengers list</a>
    </div>

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>