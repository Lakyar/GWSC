<?php
session_start();
?>

<nav>
    <div class="logoDiv"><a href="index.php"><img src="images/logo.png" alt="" class="logo"></a></div>
    <input type="checkbox" id="check">
    <label for="check" class="icons">
        <i class="bx bx-menu" id="menu-icon"></i>
        <i class="bx bx-x" id="close-icon"></i>
    </label>
    <div class="navLinks navbar">
        <a href="index.php" style="--i:1;" id="homeLink">HOME</a>

        <?php
        if (isset($_SESSION['user_id'])) {
            // User is logged in
            echo '<a href="account.php" style="--i:2;" id="accountLink">MY ACCOUNT</a>';
        } else {
            // User is not logged in
            echo '<a href="login.php" style="--i:2;" id="accountLink">LOG IN</a>';
        }
        ?>

        <a href="reviews.php" style="--i:3;" id="reviewsLink">REVIEWS</a>
        <a href="about.php" style="--i:4;" id="contactLink">CONTACT</a>
        <div class="dropdown">
            <a href="information.php" class="dropbtn" style="--i:5;" id="infoLink">INFORMATION  <i class='bx bxs-chevron-down'></i></a>
            <div class="dropdown-content">
                <a href="pitchTypes.php">Sites</a>
                <a href="features.php">Features</a>
                <a href="localAttraction.php">Local Attractions</a>
            </div>
        </div>
    </div>
</nav>
