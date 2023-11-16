<?php include 'head.php';?>

<body class="bodyBg">
<?php include 'navbar.php';?>
    <div class="localAttractionSection">
        <div class="intro">
            <h1>Local Attractions</h1>
            <p>
            Welcome to the enchanting world of "WildScape Adventures"! Nestled in the heart of the untouched wilderness, our mission is to provide you with extraordinary outdoor experiences that will leave you in awe of Mother Nature. Whether you're a seasoned explorer or a novice adventurer, our pristine landscapes offer something for everyone. Immerse yourself in the crystalline waters of Azure Lake, where you can take in the serenity of its surroundings. Discover the mystique of Whispering Woods, home to a myriad of unique flora and fauna. Ascend the majestic peaks of Eagle's Perch for panoramic views that will steal your breath away. Venture into the secrets of Crystal Caverns, a subterranean world waiting to be explored. Or delve into the rich history of Hidden Hamlet, where stories of the past await your discovery. Your journey with us is about embracing the beauty of our planet while preserving its essence. So, come on an unforgettable adventure with WildScape Adventures – where nature beckons, and memories are made.
            </p>
        </div>
    
            <div class="localAttractionCard">
                <img src="images/swimming2.jpg" alt="">
                <div class="localAttractionContent">
                    <h2>Azure Lake</h2>
                    <p> Dive into the pristine waters of Azure Lake, a hidden gem where the crystal-clear lake mirrors the endless sky. Its tranquil shores are the perfect escape for those seeking serenity and relaxation.<a href="https://www.google.com/maps/place/M.S.T+College/@16.7835527,96.1590541,18z/data=!4m6!3m5!1s0x30c1ec8817795cc3:0xb06372cdad1a36f!8m2!3d16.784223!4d96.1587251!16s%2Fg%2F1tdk7hg4?entry=ttu"><i class='bx bx-map'></i> Check Local Attraction</a>
                    </p>
                    </p>
                </div>
                
            </div>
                <div class="localAttractionCard">
                    <img src="images/slide3.jpg" alt="">
                    <div class="localAttractionContent">
                        <h2>Whispering Woods</h2>
                        <p>A wilderness alive with secrets, Whispering Woods beckons you to explore its enchanting trails. Meander through a lush forest inhabited by creatures big and small, and listen to the whispers of the ancient trees.<a href="https://www.google.com/maps/place/M.S.T+College/@16.7835527,96.1590541,18z/data=!4m6!3m5!1s0x30c1ec8817795cc3:0xb06372cdad1a36f!8m2!3d16.784223!4d96.1587251!16s%2Fg%2F1tdk7hg4?entry=ttu"><i class='bx bx-map'></i> Check Local Attraction</a>
                        </p>
                </div>
                    
                </div>
                <div class="localAttractionCard">
                    <img src="images/nature2.jpg" alt="">
                    <div class="localAttractionContent">
                        <h2>Eagle's Perch</h2>
                        <p>Conquer the towering peaks of Eagle's Perch and be rewarded with breathtaking panoramic views. Witness the world from above, where the rugged landscapes stretch as far as the eye can see.<a href="https://www.google.com/maps/place/M.S.T+College/@16.7835527,96.1590541,18z/data=!4m6!3m5!1s0x30c1ec8817795cc3:0xb06372cdad1a36f!8m2!3d16.784223!4d96.1587251!16s%2Fg%2F1tdk7hg4?entry=ttu"><i class='bx bx-map'></i> Check Local Attraction</a>
                        </p>
                        </p>
                    </div>
                        
                </div>

                <div class="localAttractionCard">
                    <img src="images/swim3.jpg" alt="">
                    <div class="localAttractionContent">
                        <h2>Coral Cove</h2>
                        <p>Dive into the vibrant world beneath the waves at Coral Cove. Snorkel alongside colorful coral formations and tropical fish in this underwater paradise, where every stroke is a brushstroke of nature's finest artwork.<a href="https://www.google.com/maps/place/M.S.T+College/@16.7835527,96.1590541,18z/data=!4m6!3m5!1s0x30c1ec8817795cc3:0xb06372cdad1a36f!8m2!3d16.784223!4d96.1587251!16s%2Fg%2F1tdk7hg4?entry=ttu"><i class='bx bx-map'></i> Check Local Attraction</a>
                        </p>
                        </p>
                    </div>
                        
                </div>

                <div class="localAttractionCard">
                    <img src="images/swim6.jpg" alt="">
                    <div class="localAttractionContent">
                        <h2>Sunset Lagoon</h2>
                        <p>Experience the magic of a swim at Sunset Lagoon. As the day fades into twilight, the lagoon's waters take on the warm hues of the setting sun. Enjoy a leisurely swim in this idyllic setting as you witness the sky's breathtaking transformation.<a href="https://www.google.com/maps/place/M.S.T+College/@16.7835527,96.1590541,18z/data=!4m6!3m5!1s0x30c1ec8817795cc3:0xb06372cdad1a36f!8m2!3d16.784223!4d96.1587251!16s%2Fg%2F1tdk7hg4?entry=ttu"><i class='bx bx-map'></i> Check Local Attraction</a>
                        </p>
                        </p>
                    </div>
                        
                </div>

    </div>

    <div id="searchContainer">
        <input class="searchControl" type="text" placeholder="Enter City Name" id="searchInput">
        <button class="searchControl" id="searchBtn">Go!</button>
            <div id="weatherDescription">
                <h1 id="cityHeader"></h1>
                <div id="weatherMain">
                    <div id="temperature"></div>
                    <div id="weatherDescriptionHeader"></div>
                </div>
                <hr>
                <div id="windSpeed" class="bottom-details"></div>
                <div id="humidity" class="bottom-details"></div>
        </div>
    </div>

    </div>

    
    
    <?php include 'footer.php';?>

<marquee behavior="scroll" direction="right">
| This is Local Attractions Page |
</marquee>



    <script>
        let appId = 'e893b4164a9b8f8ae333117915cec81e';
let units = 'metric';
let searchMethod; // q means searching as a string.

function getSearchMethod(searchTerm) {
    if (searchTerm.length === 5 && Number.parseInt(searchTerm) + '' === searchTerm)
        searchMethod = 'zip';
    else
        searchMethod = 'q';
}

function searchWeather(searchTerm) {
    getSearchMethod(searchTerm);
    fetch(`http://api.openweathermap.org/data/2.5/weather?${searchMethod}=${searchTerm}&APPID=${appId}&units=${units}`)
        .then((result) => {
            return result.json();
        }).then((res) => {
            init(res);
        });
}

function init(resultFromServer) {

    let weatherDescriptionHeader = document.getElementById('weatherDescriptionHeader');
    let temperatureElement = document.getElementById('temperature');
    let humidityElement = document.getElementById('humidity');
    let windSpeedElement = document.getElementById('windSpeed');
    let cityHeader = document.getElementById('cityHeader');


    let resultDescription = resultFromServer.weather[0].description;
    weatherDescriptionHeader.innerText = resultDescription.charAt(0).toUpperCase() + resultDescription.slice(1);
    temperatureElement.innerHTML = Math.floor(resultFromServer.main.temp) + '&#176;';
    windSpeedElement.innerHTML = 'Wind Speed: ' + Math.floor(resultFromServer.wind.speed) + ' meter/s';
    cityHeader.innerHTML = resultFromServer.name;
    humidityElement.innerHTML = 'Humidity levels: ' + resultFromServer.main.humidity + '%';

    setPositionForWeatherInfo();
}

function setPositionForWeatherInfo() {
    let weatherContainer = document.getElementById('weatherContainer');
    let weatherContainerHeight = weatherContainer.clientHeight;
    let weatherContainerWidth = weatherContainer.clientWidth;

    weatherContainer.style.left = `calc(50% - ${weatherContainerWidth / 2}px)`;
    weatherContainer.style.top = `calc(50% - ${weatherContainerHeight / 1.3}px)`;
    weatherContainer.style.visibility = 'visible';
}

document.getElementById('searchBtn').addEventListener('click', () => {
    let searchTerm = document.getElementById('searchInput').value;
    if (searchTerm)
        searchWeather(searchTerm);
});
    </script>
</body>
</html>