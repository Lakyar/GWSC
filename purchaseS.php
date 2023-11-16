<?php
$host = "localhost"; 
$database = "gwsc5"; 
$user = "root"; 
$password = "db5466"; 

$mysqli = new mysqli($host, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$place_id = $_POST["place_id"];
$date = $_POST["date"];
$quantity = $_POST["quantity"];
if (isset($_POST["times"])) {
    $times = $_POST["times"];
} else {
    $times = 1;
}

$sql = "SELECT price, name FROM places WHERE id = $place_id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $price = $row["price"];
    $place_name = $row["name"];
} else {
    echo "Not found.";
    exit;
}

$total = $price * $quantity * $times;

$mysqli->close();
?>

<?php
include 'nav.php';
?>
        <h1>Purchase Details</h1>

        <div class="purchase-details">
            <div class="place purchase">
                <img src="images/<?php echo strtolower($place_name) . '.jpg'; ?>" alt="<?php echo $place_name; ?>" class="place-image">
                    <div class="purchaseDetailsHeader">
                        <h2 class="place-name"><?php echo $place_name; ?></h2>
                        <p>Date: <span class="dollarSign"> <?php echo $date; ?></span></p>
                        <p>Guests: <span class="dollarSign"> <?php echo $quantity; ?></span></p>
                        <p>Days: <span class="dollarSign"> <?php echo $times; ?></span></p>
                        <p>Base price: <span class="dollarSign"> $<?php echo $price; ?></span></p>
                        <p>Total Price: <span class="dollarSign"> $<?php echo $total; ?></span></p>

                    </div>

                    <form action="success.php" method="post">
                        <input type="text" id="full_name" name="full_name" placeholder="Full name" required>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Phone number" required>
                        <textarea id="address" name="address" placeholder="Address" required></textarea>

                            <div class="paymentMethod">
                                <p>Payment Method:</p>
                                    <div>
                                        <label for="visa">Visa</label>
                                        <input type="radio" id="visa" name="payment_method" value="Visa">
                                    </div>
                                    <div>
                                        <label for="paypal">PayPal</label>
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
                        <input type="hidden" name="times" value="<?php echo $times; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="total" value="<?php echo $total; ?>">
                </form>
            </div>

            
        </div>
    </body>
</html>
