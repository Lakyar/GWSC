<?php include 'head.php';?>

<body class="bodyBg">
<?php include 'navbar.php';?>


    <div class="selectSiteContainer">
        <h3>Select Type</h3>
        <a href="#swimCards"><button class="swimmingBtn">Swimming</button></a>
        <a href="#campCards"><button class="caampingBtn">Camping</button></a>
    </div>
                <div id="wishlist-message" class="wishlist-message"></div>


    <div class="pitchTypeSection" id="swimCards">
        <div class="intro introSC">
            <h1>WILD SWIMMING</h1>
            <p>
            Dive into the untamed beauty of nature with our wild swimming experiences. Imagine crystal-clear waters reflecting the sky, hidden lagoons surrounded by lush forests, and secluded waterfalls beckoning you to explore. At Global Wild Swimming, we invite you to embrace the exhilaration of wild swimming in some of the most breathtaking locations. Whether you're a seasoned swimmer or a beginner, our guided tours and serene spots offer a refreshing escape.
            </p>
        </div>
    <?php include 'dbconfig.php';
    
    $sql = "SELECT name, description, image FROM places WHERE type = 'swim'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Generate card HTML for each camping site
        echo '<div class="pitchTypeCard">';
        echo '<div class="pitchTypeContent">';
        echo '<h2>';
        echo '<i class="bx bx-swim"></i>';        
    echo $row['name'] . '</h2>';        echo '<p>' . $row['description'] . '</p>';
        echo '<div>';
        echo '<a href="search_results.php?query=' . $row['name'] . '"><button class="btn-info">RESERVE NOW</button></a>';
        echo '<button class="btn-info btn-wishList" onclick="addToWishlist(\'' . $row['name'] . '\')">Add to Wishlist</button>';
        echo '</div>';
        echo '</div>';
echo '<img src="images/' . $row['image'] . '.jpg" alt="' . $row['name'] . '">';
        echo '</div>';
    }
} else {
    echo "No swimming site data available.";
}

// Close the database connection
$conn->close();
    
    
    
    
    ?>

        



        
    </div>
    <div class="pitchTypeSection" id="campCards">
        <div class="intro introSC">
            <h1>CAMPING</h1>
            <p>
            Unplug and unwind amidst the serenity of the great outdoors at Global Wild Camping. Our camping sites are a haven for those seeking solace in nature's arms. Nestled beneath towering trees and surrounded by the symphony of chirping birds, our campsites offer a tranquil retreat from the hustle and bustle of everyday life. Imagine sleeping under the starry night sky, waking up to the melodious sounds of nature, and savoring meals cooked over a crackling campfire. Whether you prefer the comfort of cabins or the simplicity of tent camping, we provide diverse accommodation options to cater to every adventurer. Explore the hidden gems of our campgrounds, where your days are filled with hiking, stargazing, and making memories around the campfire. At Global Wild Camping, we invite you to connect with the wilderness and embark on a journey of outdoor discovery. Your next camping adventure starts here.
            </p>
            </div>
            <?php include 'dbconfig.php';
    
    $sql = "SELECT name, description, image FROM places WHERE type = 'camp'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Generate card HTML for each camping site
        echo '<div class="pitchTypeCard">';
        echo '<div class="pitchTypeContent">';
        echo '<h2>';
            echo '<i class="bx bx-home-smile"></i>';        
        echo $row['name'] . '</h2>';        echo '<p>' . $row['description'] . '</p>';
        echo '<div>';
        echo '<a href="search_results.php?query=' . $row['name'] . '"><button class="btn-info">RESERVE NOW</button></a>';
        echo '<button class="btn-info btn-wishList" onclick="addToWishlist(\'' . $row['name'] . '\')">Add to Wishlist</button>';
        echo '</div>';
        echo '</div>';
echo '<img src="images/' . $row['image'] . '.jpg "alt="' . $row['name'] . '">';
        echo '</div>';
    }
} else {
    echo "No camping site data available.";
}

// Close the database connection
$conn->close();
    
    
    
    
    ?>

          




    </div>

    <a href="#top"><i class='bx bx-vertical-top'></i></a>



    <?php include 'footer.php';?>

<marquee behavior="scroll" direction="right">
| This is Swimming and Camping Sites Page |
</marquee>


    

    <script>

function addToWishlist(siteName) {
    // Check if the user is logged in, replace with your session check logic
    var loggedIn = true; // Set to true if the user is logged in, false if not

    if (loggedIn) {
        // Make an AJAX request to add the site name to the wishlist
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "add_to_wishlist.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Specify the data to send, in this case, the site name
        var data = "site_name=" + siteName;

        // Define a callback function to handle the response
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                // Handle the response
                if (xhttp.responseText === "Added to Wishlist successfully.") {
                    alert(xhttp.responseText);
                } else {
                    alert("Site is already in your wishlist.");
                }
            }
        };

        // Send the data
        xhttp.send(data);
    } else {
        // Redirect to the login page or display a message for users who are not logged in
        alert("Please log in to add sites to your wishlist.");
    }
}

function showWishlistMessage(message) {
    const messageElement = document.getElementById('wishlist-message');
    messageElement.innerText = message;
    messageElement.style.display = 'block';
    
    // Automatically hide the message after 3 seconds
    setTimeout(() => {
        messageElement.style.display = 'none';
        messageElement.innerText = '';
    }, 3000); // 3000 milliseconds = 3 seconds
}




</script>


</body>
</html>