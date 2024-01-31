<div class="header">
    <div class="header-left">
        <a href="/railway_system/welcome.php">
            <h1>Railway System</h1>
        </a>
    </div>
    <div class="header-right">
        <div class="header-profile">
            <a href="profile.php">
                <div class="profile-btn"><img src="/railway_system/images/avatar.png" alt="photo">
                 My Profile </div>
            </a>
        </div>
        <a href="/railway_system/processors/logout.php"><span class="btn3">Log Out</span></a>
    </div>
</div>
<div class="nav-bar">
    <a href="welcome.php"><span>Home</span></a>
    <a href="trains.php"><span>Train</span></a>
    <a href="tickets.php"><span>Tickets</span></a>
    <a href="stations.php"><span>Station</span></a>
    <?php if($_SESSION['admin'] == $_SESSION['userId']) {echo '<a href="maintenance.php"><span>Maintenance</span></a>
    <a href="passengers.php"><span>Passenger</span></a>';} ?>
    <a href="schedules.php"><span>Schedule</span></a>
</div>