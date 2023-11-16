<?php include 'head.php';?>
<body class="bodyBg">

<?php include 'navbar.php';?>
<?php

$selectedDate = $_SESSION['selectedDate'];
$guests = $_SESSION['guests'];
$days = $_SESSION['days'];

// Ensure you have a valid database connection
$conn = new mysqli("localhost", "root", "db5466", "gwsc5");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform a valid database query to fetch available camping sites
$query = "SELECT * FROM places WHERE type = 'camp'";

$results = $conn->query($query);

// Check if the query was successful
if (!$results) {
    die("Error in query: " . $conn->error);
}
?>


<h1 class="purH1">Available Camping Sites</h1>
<?php
while ($row = mysqli_fetch_assoc($results)) {
    echo '<div class="camping-site">';
    echo '<div class="camping-site-L">';
    $imageName = strtolower($row['name']) . '.jpg'; // Construct image filename based on name
    echo '<img src="images/' . $imageName . '" alt="' . $row['name'] . '">';
    echo '<h2>' . $row['name'] . '</h2>';
    echo '<p>Base price: <span class="dollarSign">$' . $row['price'] . '</span></p>';
    echo '</div>';

    echo '<div class="camping-site-R">';
    echo '<p>Description: ' . $row['description'] . '</p>';
    echo '<p>Arrival Date: <span class="dollarSign"> ' . $selectedDate . '</span></p>';
    echo '<p>Number of Guests: <span class="dollarSign"> ' . $guests . '</span></p>';
    echo '<p>Number of Days: <span class="dollarSign"> ' . $days . '</span></p>';
    echo '<p>Total Price: <span class="dollarSign">$' . ($row['price'] * $guests * $days) . '</span></p>';
    
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        // User is logged in, show Buy button that leads to purchase.php
        echo '<form action="purchase.php" method="post">';
        echo '<input type="hidden" name="place_id" value="' . $row['id'] . '">';
        echo '<input type="hidden" name="date" value="' . $selectedDate . '">';
        echo '<input type="hidden" name="quantity" value="' . $guests . '">';
        echo '<input type="hidden" name="days" value="' . $days . '">';
        echo '<input type="submit" value="Book" class="buyBtn">';
        echo '</form>';
    } else {
        // User is not logged in, show Buy button that leads to login.php
        echo '<form action="login.php" method="post">';
        echo '<input type="submit" value="Log In to Buy" class="buyBtn">';
        echo '</form>';
    }
    echo '</div>';
    echo '</div>';
}
?>
<form action="purchase.php" method="post">
    <input type="hidden" name="place_id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="date" value="<?php echo $selectedDate; ?>">
    <input type="hidden" name="quantity" value="<?php echo $guests; ?>">
    <input type="hidden" name="times" value="<?php echo $days; ?>"> <!-- This line sets the number of days -->
    <!-- Add Buy button -->
</form>


</body>
</html>
