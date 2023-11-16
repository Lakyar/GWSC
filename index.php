<?php include 'head.php';?>
<body>
        <div class="homeSection">
        <?php include 'navbar.php';?>
<?php
include 'dbconfig.php';
$pageName = "home_page";
if (!isset($_SESSION[$pageName . '_viewed'])) {
    $result = $conn->query("SELECT * FROM page_views WHERE page_name = '$pageName'");
    if ($result->num_rows > 0) {
        $conn->query("UPDATE page_views SET view_count = view_count + 1 WHERE page_name = '$pageName'");
    } else {
        $conn->query("INSERT INTO page_views (page_name, view_count) VALUES ('$pageName', 1)");
    }
    $_SESSION[$pageName . '_viewed'] = true;
}

$result = $conn->query("SELECT view_count FROM page_views WHERE page_name = '$pageName'");
$viewCount = $result->fetch_assoc()['view_count'];
?>
            <div class="CtoAContainer">
                <h1>GLOBAL WILD SWIMMING & CAMPING</h1>
                <div>
                    <a href="chkSwim.php"><button class="CtoAswimming">SWIMMING</i></button></a>
                    <a href="chkCamp.php"><button class="CtoACamping">CAMPING</i></button></a>
                </div>
                <form class="searchForm" action="search_results.php" method="get">
                    <input type="text" name="query" placeholder="Search sites..." class="searchInput">
                    <input type="submit" value="Search" class="searchBtn">
                </form>
            </div>
        </div>
        <div class="homeCard">
            <div class="slideshow-container">
                <div class="mySlides fade">             
                <img src="images/slide1.jpg">             
                </div>  
                <div class="mySlides fade">             
                <img src="images/slide2.jpg">              
                </div>  
                <div class="mySlides fade">             
                <img src="images/slide3.jpg">             
                </div>
                <div class="mySlides fade">              
                <img src="images/River View Tent.jpg">
                </div>
            </div>
            <br>
            <div style="text-align:center">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
            
            <br><br>
                <h2>Welcome</h2><br>
                <p>
                    Welcome to Global Wild Swimming and Camping - your destination for unbridled natural beauty and boundless adventure. Immerse yourself in the serene allure of untouched landscapes, where the sapphire waters of wild swimming spots and the tranquility of remote camping sites await your discovery. With our curated selection of wild swimming spots and the warmth of our global community, create memories that will last a lifetime. Grab your backpack, lace-up your hiking boots, and get ready to make a splash – your adventure begins now! <a href="safety.php">Safety tips</a>
                </p>
               
        </div>

        
            <div class="map">  
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.848163446189!2d96.15614480884521!3d16.784228119837657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ec8817795cc3%3A0xb06372cdad1a36f!2sM.S.T%20College!5e0!3m2!1sen!2smm!4v1698031681959!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
            
            
        <?php include 'footer.php';?>
        <marquee behavior="scroll" direction="right">
        | This is Home Page <i class='bx bx-home'></i> | Page Views: <?php echo $viewCount; ?> <i class='bx bx-user'></i> |
        </marquee>

    <script src="script.js"></script>
    </body>
    </html>