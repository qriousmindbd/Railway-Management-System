<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Railway Service System</title>
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

    <main>
        <div class="welcome-container">
            <h1><font color="#ff9900">Welcome to</font> <br> Railway Service System</h1>
            <p>Connecting Journeys, Empowering Travelers</p>
            <?php if(isset($_SESSION["contact_number"])) echo '<a href="book_ticket.php"><span class="btn margi"> Book Ticket Now <b>→</b></span></a>';
                    else echo '<a href="login.php"><span class="btn margi"> Get Started Now <b>→</b></span></a>';
            ?>
            <div id="clock">
            <?php
                // Get the current time and format it
                $currentTime = date('H:i:s');
                echo $currentTime;
            ?>
            </div>

            <script>
                // Function to update the clock every second
                function updateClock() {
                    var clockElement = document.getElementById('clock');
                    var currentTime = new Date();
                    var hours = currentTime.getHours();
                    var minutes = currentTime.getMinutes();
                    var seconds = currentTime.getSeconds();

                    // Add leading zeros to single-digit hours, minutes, and seconds
                    hours = (hours < 10 ? '0' : '') + hours;
                    minutes = (minutes < 10 ? '0' : '') + minutes;
                    seconds = (seconds < 10 ? '0' : '') + seconds;

                    // Update the clock's text
                    clockElement.textContent = 'Current Time : ' + hours + ':' + minutes + ':' + seconds;
                }

                // Update the clock immediately and then every second
                updateClock();
                setInterval(updateClock, 1000);
            </script>
        </div>
    </main>

    <footer>
        <?php
            include_once('components/footer.php');
        ?>
    </footer>
</body>
</html>
