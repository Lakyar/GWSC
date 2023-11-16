<?php
session_start();


$days = 1;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDate = $_POST['date'];
    $guests = intval($_POST['guests']); 
    $days = 1; 

    $conn = new mysqli("localhost", "root", "db5466", "gwsc5");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM places WHERE type = 'swim'";

    $results = $conn->query($query);

    if (!$results) {
        die("Error in query: " . $conn->error);
    }
}
?>


<?php include 'head.php';?>
<body class="bodyBg">
    
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
            // User  in
            echo '<a href="account.php" style="--i:2;" id="accountLink">MY ACCOUNT</a>';
        } else {
            // User ! in
            echo '<a href="login.php" style="--i:2;" id="accountLink">LOG IN</a>';
        }
        ?>

        <a href="reviews.php" style="--i:3;" id="reviewsLink">REVIEWS</a>
        <a href="safety.php" style="--i:4;"  id="safetyLink">SAFETY</a>
        <a href="about.php" style="--i:5;" id="contactLink">CONTACT</a>
        <div class="dropdown">
            <a href="information.php" class="dropbtn" style="--i:6;" id="infoLink">INFORMATION  <i class='bx bxs-chevron-down'></i></a>
            <div class="dropdown-content">
                <a href="pitchTypes.php">Sites</a>
                <a href="features.php">Features</a>
                <a href="localAttraction.php">Local Attractions</a>
            </div>
        </div>
    </div>
</nav>

<h1 class="purH1">Available Swimming Sites</h1>

<?php
while ($row = mysqli_fetch_assoc($results)) {
    echo '<div class="swimming-site">';
        echo '<div class="swimming-site-L">';
            $imageName = strtolower($row['name']) . '.jpg'; // img name
            echo '<img src="images/' . $imageName . '" alt="' . $row['name'] . '">';
            echo '<h2>' . $row['name'] . '</h2>';
            echo '<p>Base price:<span class="dollarSign"> $' . $row['price'] . '</span></p>';
        echo '</div>';

        echo '<div class="swimming-site-R">';
            echo '<p>Description: ' . $row['description'] . '</p>';
            echo '<div class="site-detail-div">';

            echo '<div>';

                echo '<p>Arrival Date: <span class="dollarSign"> ' . $selectedDate . '</span></p>';
                echo '<p>Number of Guests: <span class="dollarSign"> ' . $guests . '</span></p>';
                echo '<p>Number of Days: <span class="dollarSign"> ' . $days . '</span></p>';
                echo '<p>Total Price: <span class="dollarSign">$' . ($row['price'] * $guests * $days) . '</span></p>';
    
                echo '</div>';
            if (isset($_SESSION['user_id'])) {
                 // User in, show Buy btn
        echo '<form action="purchase_swim.php" method="post">';
                echo '<input type="hidden" name="place_id" value="' . $row['id'] . '">';
                echo '<input type="hidden" name="date" value="' . $selectedDate . '">';
                echo '<input type="hidden" name="quantity" value="' . $guests . '">';
                echo '<input type="hidden" name="days" value="' . $days . '">';
                echo '<input type="submit" value="Book" class="buyBtn">';
                echo '</form>';
            } else {
                   // User !in, !show Buy btn
        echo '<form action="login.php" method="post">';
                echo '<input type="submit" value="Log In to Buy" class="buyBtn">';
                echo '</form>';
            }
        echo '</div>';
        echo '</div>';
    echo '</div>';
}
?>

</body>
</html>
