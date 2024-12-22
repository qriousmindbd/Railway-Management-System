<?php
include_once("processors/logincheck.php");
include_once("processors/db.php");
$contact_number = $_SESSION['contact_number'];

$query = "SELECT * FROM Passenger WHERE contact_number = $contact_number";
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
    <title>Edit Profile - RailwaySystem</title>
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
        include_once("processors/update_profile.php");
    ?>

    <div class="edit-profile-container">
    <h1>Edit Profile Info</h1>
    <form action="processors/update_profile.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>"><br><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo $user['contact_number']; ?>"><br><br>

        <input type="submit" value="Update Profile">
    </form>
    </div>
    

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>
