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
            echo '<a href="account.php" style="--i:2;" id="accountLink">MY ACCOUNT</a>';
        } else {
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
<div class="accountSection">
        <div class="card">
            <div class="cardTop">
                <img src="images/userDefault2.jpg" alt="">
                <div class="username">
                    <h2>Full Name: <span class="dollarSign"> <?php echo $full_name; ?></span></h2><br>
                    <h4>Username: <span class="dollarSign"> <?php echo $username; ?></span></h4><br>
                    <h4>Email: <span class="dollarSign"> <?php echo $email; ?></span></h4>
                </div>
            </div>
            <div class="cardBot">
                <?php
                if (!isset($_SESSION['user_id'])) {
                    echo "User not logged in";
                    exit();
                }

                $user_id = $_SESSION['user_id'];

                $query = "SELECT wishlist FROM users WHERE id = $user_id";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $wishlist = json_decode($row['wishlist'], true);

                    if (is_array($wishlist) && count($wishlist) > 0) {
                        echo '<div class="wishListContainer">';
                        echo '<h3>Wishlist <i class="bx bx-heart"></i></h3><br>';
                        echo '<div class="wishList">';
                        foreach ($wishlist as $site_name) {
                            echo '<div><a href="search_results.php?query=' . urlencode($site_name) . '"><button>' . $site_name . '</button></a> <i class="bx bxs-trash delete-wishlist" data-site-name="' . $site_name . '"></i></div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo '<h3>Your Wish List is Empty</h3><br>';
                    }
                } else {
                    echo "User not found.";
                }
                ?>
                <button class="logoutBtn" onclick="location.href='logout.php'">Log out</button>
            </div>
        </div>
    </div>

    <?php include 'footer.php';?>

    <marquee behavior="scroll" direction="right">
    | This is Account Page |
    </marquee>


    <script>
        var deleteIcons = document.querySelectorAll('.delete-wishlist');
        deleteIcons.forEach(function (icon) {
            icon.addEventListener('click', function () {
                var siteName = icon.getAttribute('data-site-name');
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "remove_from_wishlist.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                var data = "site_name=" + siteName;
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState === 4 && xhttp.status === 200) {
                        if (xhttp.responseText === 'success') {
                            icon.parentElement.remove();
                        } else {
                            alert("Error deleting the item from the wishlist");
                        }
                    }
                };
                xhttp.send(data);
            });
        });
    </script>
</body>
</html>