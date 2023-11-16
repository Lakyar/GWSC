<?php
include 'nav.php';
?>


<?php


$days = 1; // Default

// Retrieve data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $place_id = $_POST["place_id"];
    $date = $_POST["date"];
    $quantity = $_POST["quantity"];

    $conn = new mysqli("localhost", "root", "db5466", "gwsc5");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT price, name FROM places WHERE id = $place_id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $price = $row["price"];
        $place_name = $row["name"];
    } else {
        echo "Not found.";
        exit;
    }

    // Calc total
    $total = $price * $quantity * $days;

    $conn->close();
}
?>


<h1 class="purH1">Purchase Details for Swimming Site</h1>

<div class="purchase-details">
    <div class="place purchase">
        <img src="images/<?php echo strtolower($place_name) . '.jpg'; ?>" alt="<?php echo $place_name; ?>" class="place-image">
        <div class="purchaseDetailsHeader">
            <h2 class="place-name"><?php echo $place_name; ?></h2>
            <p>Date: <?php echo $date; ?></p>
            <p>Guests: <?php echo $quantity; ?></p>
            <p>Days: <?php echo $days; ?></p>
            <p>Base price: $<?php echo $price; ?></p>
            <p>Total Price: $<?php echo $total; ?></p>
        </div>

        <form action="success.php" method="post">
            <input type="text" id="full_name" name="full_name" placeholder="Full name" required>
            <input type="tel" id="phone_number" name "phone_number" placeholder="Phone number" required>
            <textarea id="address" name="address" placeholder="Address" required></textarea>

            <div class="paymentMethod">
                <p>Payment Method:</p>
                <div>
                    <label for="visa">Visa</label>
                    <input type="radio" id="visa" name="payment_method" value="Visa">
                </div>
                <div>
                    <label for="paypal">PayPalll</label>
                    <input type="radio" id="paypal" name="payment_method" value="PayPal">
                </div>
                <div>
                    <label for="digital_wallet">Digital Wallet</label>
                    <input type="radio" id="digital_wallet" name="payment_method" value="Digital Wallet">
                </div>
            </div>

            <input type="submit" value="Confirm Purchase" class="confirmBtn">
            <input type="hidden" name="place_id" value="<?php echo $place_id; ?>">
            <input type="hidden" name="date" value="<?php echo $date; ?>">
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
            <input type="hidden" name="days" value="<?php echo $days; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
        </form>
    </div>
</div>

</body>
</html>
