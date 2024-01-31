<?php
include_once("db.php");
include_once("db_functions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $contact_number = $_POST["contact_number"];

    // Check if the Contact no. already exists in the database
    $query_contact = "SELECT * FROM passenger WHERE contact_number = '$contact_number'";
    $result_contact = mysqli_query($conn, $query_contact);
    // contact no. duplicate value check
    if (mysqli_num_rows($result_contact) > 0) {
        echo '<p class="notify-red"> An account with this Contact info already exists! </p>';
        return;
    }

    // Fetch the max id and add next row data
    $lastid = getLastIdValue('passenger_id', 'passenger', $conn) + 1;

    $sql = "INSERT INTO Passenger (passenger_id, name, contact_number) VALUES ($lastid, '$name', '$contact_number')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php?reg=success");
    } else {
        echo '<p class="notify-red">Error: ' . $sql . "<br>" . $conn->error . "</p>";
    }

    $conn->close();
}
?>
