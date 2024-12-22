<?php
$contact_number = $_SESSION['contact_number'];

$ph_query = "SELECT * FROM Passenger WHERE contact_number = $contact_number";
$ph_result = mysqli_query($conn, $ph_query);

if ($ph_result) {
    $ph_user = mysqli_fetch_assoc($ph_result);
}
?>

<div class="container">
    <h1>Welcome, <?php echo $ph_user['name']; ?> <?php if($_SESSION['admin'] == $_SESSION['userId']) {echo ' [Admin]';} ?></h1>
    <div class="user-info">
        <img class="user-image" src="images/avatar.png" alt="User Image">
        <div class="user-details">
            <h2>Your Profile</h2>
            <p><strong>Name:</strong> <?php echo $ph_user['name']; ?></p>
            <p><strong>User Code:</strong> <?php echo $ph_user['passenger_id']; ?></p>
        </div>
        <a href="edit_profile.php" class="edit-profile-button">Edit Profile</a>
    </div>
    <div class="navigation">
        <a href="tickets.php">My Tickets</a>
        <a href="book_ticket.php">Book A Ticket</a>
        <a href="booking_history.php">Booking History</a>
        <?php
        if($_SESSION['admin'] == $_SESSION['userId']) {
            echo '<a href="manage_train.php">Manage Train</a>
            <a href="edit_schedule.php">Edit Schedule</a>
            <a href="maintenance.php">Maintenance Logs</a>';
        }
        ?>
    </div>
    <hr>
</div>