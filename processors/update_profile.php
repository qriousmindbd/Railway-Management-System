<?php
include_once("db.php");
include_once("db_functions.php");
include_once("logincheck.php");

// Retrieve the user's current information from the database
$contact_number = $_SESSION['contact_number']; // previously set in session variable upon login
$query = "SELECT * FROM passenger WHERE contact_number = $contact_number";
$result = mysqli_query($conn, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
} else {
    die("Database query failed.");
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated user data from the form
    $new_name = $_POST['name'];
    $new_contact_number = $_POST['contact_number'];

    // Check if any changes were made
    if ($new_name != $user['name'] || $new_contact_number != $user['contact_number']) {
        // Check if the new contact number already exists in the database
        if ($new_contact_number != $user['contact_number'] && isDuplicateValue($new_contact_number, "contact_number", 'passenger', $conn)) {
            echo '<p class="notify-red">Sorry! This contact number is used by another user.</p>';
        } else {
            // Update the user's information in the database
            $update_query = "UPDATE Passenger SET name = '$new_name', contact_number = '$new_contact_number' WHERE contact_number = $contact_number";

            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                $_SESSION['contact_number'] = $new_contact_number;
                // Redirect to the profile page with a success message
                header("Location: /railway_system/profile.php?message=proupsuccess");
                exit();
            } else {
                // Handle the error
                die("Database query failed.");
            }
        }
    } else {
        echo '<p class="notify-red">No changes were made.</p>';
    }
}

$conn->close();

?>
