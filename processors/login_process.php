<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $contact_number = $_POST["contact_number"];

    // Perform input validation and error handling
    $sql = "SELECT * FROM Passenger WHERE name='$name' AND contact_number='$contact_number'";
    $result = $conn->query($sql);
    $userData = mysqli_fetch_assoc($result);

    if ($result->num_rows == 1) {
        // User is authenticated
        $_SESSION["contact_number"] = $contact_number;
        $_SESSION["userId"] = $userData['passenger_id'];
        $_SESSION["admin"] = 1112;
        header("location: /railway_system/welcome.php"); // Redirect to a welcome page
    } else {
        echo '<p class="notify-red">Login failed! Invalid name or contact number.</p>';
    }

    $conn->close();
}
?>
