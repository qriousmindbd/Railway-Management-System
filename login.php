<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RailwaySystem</title>
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
        <form action="" method="post">
        <div class="login-form">
        <h2>Login</h2><br>
        <?php
        if(isset($_GET['reg']) && $_GET['reg'] === "success"){
            echo '<p class="notify-green">Registration successful!</p>';
        }
        ?>
            <p><?php require_once("processors/login_process.php"); ?></p>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" required>
            </div>
            <button type="submit" class="btn-primary">Login</button>
        </div>
        </form>
    </div>

    

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>