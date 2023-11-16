
<?php include "nav.php" ?>
    
    <div class="rss-container">
        <div class="rss-box">
        <div class="rss-title">
        <img src='images/rss.jpg' alt=''>
        <h2>GWSC RSS Feeds </h2>
        </div>
        <p>Setup GWSC RSS feeds to get the latest swimming spots and camping pitches.</p>

        <div class="rss-body">
            <h2>Generate RSS URL</h2>
        <p>The default RSS feed URL for all swimming sites and camping pitches is: https://gwsc.almir.info/rss/ </p>

        <p>To generate your own RSS Feed URL with your custom filters please use the tool below.</p>
        </div>
        <br>
        <hr>
        <br>
        <form class="rss-form" action="rss.php" method="post">
            <button name="camps" value="camp"><i class="fa-solid fa-square-rss"></i>Campings</button>
            <button name="swims" value="swim"><i class="fa-solid fa-square-rss"></i>Swimmings</button>
        </form>
        </div>
    </div>

        <?php
     include "dbconfig.php";


     if(isset($_POST["camps"])) {
        $type = $_POST['camps'];

     $str = "<?xml version='1.0' ?>";
     $str .= "<rss version='2.0'>";
     $str.="<Campings>";
 
     $sql = "SELECT * FROM places WHERE type=?";
     $st = $conn->prepare($sql);
     $st->bind_param("s", $type);
     $st->execute();
        $result = $st->get_result();
        

     if($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
            $str .= "<item>";
            $str .= "<id>" . htmlspecialchars($row['id']) . "</id>";
            $str .= "<name>" . htmlspecialchars($row['name']) . "</name>";
            $str .= "<content>" . htmlspecialchars($row['description']) . "</content>";
            $str .= "<capacity>" . htmlspecialchars($row['price']) . "</capacity>";
            $str .= "<priceperday>" . htmlspecialchars($row['type']) . "</priceperday>";
            $str .= "<image>" . htmlspecialchars($row['image']) . "</image>";
            $str .= "</item>";
         }
     }
     $str.="</Campings>";
     $str.="</rss>";
 
     file_put_contents("rssCampings.xml",$str);
     echo "
     <div style='display: flex; width: 100%; flex-direction: column; justify-content: center;'>
     <p style='text-align: center; margin-bottom: 20px;'>Generated URL: </p>
     <a style='text-decoration: none;' href='rssCampings.xml' target=_blank'>
     <div style='display: flex; width: 100%; margin-bottom: 40px; justify-content: center;'>
     <img style='width: 35px; height: 35px; margin-right: 10px;' src='images/rss.jpg' alt=''>
     <p> /rss/campings </p>
     </div>
     </a>
     </div>";
 }
 
 
 if(isset($_POST["swims"])) {
    $type = $_POST['swims'];

     $str = "<?xml version='1.0' ?>";
     $str .= "<rss version='2.0'>";
     $str.="<Swimmings>";
 
     $sql = "SELECT * FROM places WHERE type=?";
     $st = $conn->prepare($sql);
     $st->bind_param("s", $type);
     $st->execute();
        $result = $st->get_result();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $str .= "<item>";
               $str .= "<id>" . htmlspecialchars($row['id']) . "</id>";
               $str .= "<name>" . htmlspecialchars($row['name']) . "</name>";
               $str .= "<content>" . htmlspecialchars($row['description']) . "</content>";
               $str .= "<capacity>" . htmlspecialchars($row['price']) . "</capacity>";
               $str .= "<priceperday>" . htmlspecialchars($row['type']) . "</priceperday>";
               $str .= "<image>" . htmlspecialchars($row['image']) . "</image>";
               $str .= "</item>";
            }
        }
 
     
     $str.="</Swimmings>";
     $str.="</rss>";
 
     file_put_contents("rssSwimmings.xml",$str);
     echo "<div style='display: flex; width: 100%; flex-direction: column; justify-content: center;'>
     <p style='text-align: center; margin-bottom: 20px;'>Generated URL: </p>
     <a style='text-decoration: none;' href='rssSwimmings.xml' target=_blank'>
     <div style='display: flex; width: 100%; margin-bottom: 40px; justify-content: center;'>
     <img style='width: 35px; height: 35px; margin-right: 10px;' src='images/rss.jpg' alt=''>
     <p> /rss/swimmings </p>
     </div>
     </a>
     </div>";
 }
    ?>

    <?php include "footer.php" ?>

    <script src="../controller/main.js"></script>

</body>
</html>