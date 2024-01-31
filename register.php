<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - RailwaySystem</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
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

    <div class="logreg-body">
        <div class="reg-container">
            <h2>Register</h2>
            <?php require_once("processors/register_process.php"); ?>
            <form action="" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" required><br>
                
                <label for="contact_number">Contact Number:</label>
                <input type="text" name="contact_number" required><br>

                <input type="submit" value="Register">
            </form>
            <p class="login-txt"> Already have an account? <a href="login.php">Log in here</a> </p>
        </div>
    </div>

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>
