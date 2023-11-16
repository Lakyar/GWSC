<?php
session_start(); // Start a PHP session
include 'head.php';
include 'dbconfig.php';

if (isset($_POST['login'])) {
    // Check and track login attempts
    if (isset($_SESSION['login_attempt_count']) && $_SESSION['login_attempt_count'] >= 3) {
        // Check if the user is temporarily locked out
        if (isset($_SESSION['login_attempt_time']) && (time() - $_SESSION['login_attempt_time']) < 600) {
            echo "You have reached the maximum number of login attempts. Please wait for 10 minute before trying again.";
            exit;
        } else {
            // Reset login attempts if the lockout duration has passed
            $_SESSION['login_attempt_count'] = 0;
        }
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists in the database
    $check_email = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_email);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Login successful, store user ID
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect password.";
            // Track login attempts
            $_SESSION['login_attempt_count'] = isset($_SESSION['login_attempt_count']) ? $_SESSION['login_attempt_count'] + 1 : 1;
            if ($_SESSION['login_attempt_count'] >= 2) {
                $_SESSION['login_attempt_time'] = time();
            }
        }
    } else {
        $error = "Invalid email.";
    }
}

$conn->close();
?>

<body class="bodyBg">
    <div class="signUpSection">
    
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
    <form action="login.php" method="POST" class="loginForm">
    <h1>Log In</h1>
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Log In</button>
    <?php
    if (isset($error)) {
        echo '<p style="color: red;">' . $error . '</p>';
    }
    ?>
    <p>Don't have an account? <a href="signup.php"> Sign Up</a></p>
</form>
    </div>

<?php include 'footer.php';?>

<marquee behavior="scroll" direction="right">
| This is Login Page |
</marquee>

    <script></script>
</body>
</html>
