<?php
include 'head.php';
session_start(); 
if (isset($_SESSION['user_id'])) {
    include 'dbconfig.php';

    $user_id = $_SESSION['user_id'];
    $query = "SELECT full_name, username, email FROM users WHERE id = $user_id";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $full_name = $row['full_name'];
        $username = $row['username'];
        $email = $row['email'];
    }
} else {
    header("Location: login.php");
    exit();
}
?>
<body>

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
            // loggend in
            echo '<a href="account.php" style="--i:2;" id="accountLink">MY ACCOUNT</a>';
        } else {
            //  logged in 
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
    <div class="reviewSection bodyBg">
        <div class="intro">
            <h1>REVIEWS</h1>
            <p>
                Welcome to Global Wild Swimming and Camping! Immerse yourself in the beauty of nature
                as you explore our stunning wild swimming spots and camping sites. Discover the perfect
                adventure that awaits you.Welcome to Global Wild Swimming and Camping! Immerse yourself
                in the beauty of nature as you explore our stunning wild swimming spots and camping sites. 
                Discover the perfect adventure that awaits you.
            </p>
        </div>

    
    
        <div class="reviewCardContainer">
                <div class="reviewCard">
                        <img src="images/userDefault2.jpg" alt="">
                    <div class="reviewCardContent">
                        <h3>Barry Allen</h3>
                        <p>What an incredible experience! The pristine waters and breathtaking campsite views left me in awe. Global Wild Swimming and Camping truly offers a slice of paradise.
                        </p>
                    </div>
                </div>
                <div class="reviewCard">
                    <img src="images/userDefault2.jpg" alt="">
                    <div class="reviewCardContent">
                        <h3>Louis Lane</h3>
                        <p>I've explored many wild swimming spots, but this place is magical. Camping under the stars while swimming in nature's lap is simply unforgettable. I'll be back!
                        </p>
                    </div>
                </div>
                <div class="reviewCard">
                    <img src="images/userDefault2.jpg" alt="">
                    <div class="reviewCardContent">
                        <h3>Bruce Wayne</h3>
                        <p>A hidden gem! The combination of adventure and relaxation is perfect. I can't get enough of Global Wild Swimming and Camping's beauty and tranquility.
                        </p>
                    </div>
                </div>
                <div class="reviewCard">
                    <img src="images/userDefault2.jpg" alt="">
                    <div class="reviewCardContent">
                        <h3>Clark Kent</h3>
                        <p>Nature at its finest! The wild swimming spots are like no other, and the campsite amenities are top-notch. I felt truly connected to the great outdoors.
                        </p>
                    </div>
                </div>
                <div class="reviewCard">
                    <img src="images/userDefault2.jpg" alt="">
                    <div class="reviewCardContent">
                        <h3>Lex Luthor</h3>
                        <p>Global Wild Swimming and Camping is a paradise for nature lovers. I've discovered serene swimming spots and had unforgettable nights under the stars. Can't recommend it enough!
                        </p>
                    </div>
                </div>
                <div class="reviewCard">
                <img src="images/userDefault2.jpg" alt="">
                <div class="reviewCardContent">
                    <h3>Jack Napier</h3>
                    <p>The ultimate escape! If you're looking for a getaway that renews your spirit, this is it. The wild swimming locations are captivating, and the camping experience is pure bliss.
                    </p>
                </div>
            </div>
    </div>
    
        
    <?php
        // chk log in?
        if (isset($_SESSION['user_id'])) {
            echo '<div class="reviewForm">';
            echo '    <textarea id="reviewTextarea" rows="3" placeholder="Write a review"></textarea>';
            echo '    <button id="submitReview">SEND <i class="bx bx-send"></i></button>';
            echo '</div>';
        } else {
            echo '<p class="revLogin">Please <a href="login.php">log in</a> to write a review.</p>';
        }
        ?>
</div>



<?php include 'footer.php';?>

<marquee behavior="scroll" direction="right">
| This is Reviews Page |
</marquee>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $("#submitReview").on("click", function () {
        const reviewTextarea = $("#reviewTextarea");
        const reviewMessage = reviewTextarea.val();

        if (reviewMessage.trim() !== "") {
            const userFullName = "<?php echo $full_name; ?>";

            const newReviewCard = `
                <div class="reviewCard">
                <img src="images/userDefault2.jpg" alt="">
                    <div class="reviewCardContent">
                        <h3>${userFullName}</h3>
                        <p>${reviewMessage}</p>
                    </div>
                </div>
            `;

            $(".reviewCardContainer").append(newReviewCard);

            reviewTextarea.val("");
        } else {
            alert("Please enter a review message.");
        }
    });
});
</script>
</body>
</html>