<?php
include $_SERVER["DOCUMENT_ROOT"] . "/Controller/movieController.php";
$infos = getMoviesByID([]);

$datas = [];
foreach ($infos as $values){
    $datas[] = array(
        $values->getMovieID(),
        $values->getMovieTitle(),
        $values->getCategory(),
        $values->getMovieImage(),
        $values->getMovieTrailer(),
        $values->getActors(),
        $values->getRating()
    );
}
// Film verilerini al
$info = getMoviesByID([$_GET['id']]);

// Her bir film için gerekli bilgileri içeren bir dizi oluştur
$data = [];
foreach ($info as $value){
    $data[] = array(
        $value->getMovieID(),
        $value->getMovieTitle(),
        $value->getCategory(),
        $value->getMovieImage(),
        $value->getMovieTrailer(),
        $value->getActors(),
        $value->getRating()
    );
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Movie Design</title>
</head>

<body>
<div class="navbar">
    <div class="navbar-container">
        <div class="logo-container">
            <h1 class="logo" style="font-family: 'Arial Black',sans-serif">IMDb</h1>
        </div>
        <div class="menu-container">
            <ul class="menu-list">
                <li class="menu-list-item active"><a class="menu-list-item-link" href="#">Menu</a></li>
                <li class="menu-list-item active ">
                    <div class="search-container">
                        <input type="text" placeholder="Ara..." id="searchBox" list="movies">
                        <datalist id="movies">
                            <?php foreach ($data as $value): ?>
                            <option value="<?php echo $value[1]; ?>" data-id="<?php echo $value[0]; ?>">
                                <?php endforeach; ?>
                        </datalist>
                        <button onclick="toggleDropdown()" id="dropdownButton">All ▼</button>
                        <div id="dropdown" class="dropdown-content">
                            <a href="#">All</a>
                            <a href="#">Titles</a>
                            <a href="#">Actors</a>
                            <a href="#">Categories</a>
                            <a href="#">TV Episodes</a>
                            <a href="#">Companies</a>
                        </div>
                    </div>
                </li>
                <li class="menu-list-item active"><a class="menu-list-item-link " href="#">IMDb<span style="color: aqua">pro</span></a></li>
                <li class="menu-list-item active "><a class="menu-list-item-link " href="#" id="Watchlist1"><i class="fas fa-bookmark"></i> Watchlist</a></li>

            </ul>
        </div>
        <div class="profile-container">

                <a href="login.php" class="sign_btn">
                    <button>Sign in</button>
                </a>
                <img class="profile-picture" src="img/no-profile-picture.jpg" alt="">
                <div class="profile-text-container">
                    <span id="profile" class="profile-text">Profile</span>
                    <i class="fas fa-caret-down"></i>
                    <div id="profile-dropdown" class="custom-dropdown">
                        <a href="#">Logout</a>
                    </div>
                </div>

            <div class="profile-text-container">
                <span id="language" class="profile-text">EN</span>
                <i class="fas fa-caret-down"></i>
                <div id="language-dropdown" class="custom-dropdown">
                    <a href="#">EN</a>
                    <a href="#">FR</a>
                    <a href="#">ES</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="play-text">
        <h1><?php echo $data[0][1]; ?></h1>
        <p class="fas fa-star"><span class="rating"><?php echo $data[0][6]; ?></span></p>
        <p><strong>Actors:</strong>
            <?php
            $actors = explode(',', $data[0][5]);
            foreach ($actors as $key => $actor) {
                echo trim($actor);
                if ($key < count($actors) - 1) {
                    echo ', ';
                }
            } ?>
        </p>
        <p><strong>Categories:</strong>  <?php echo $data[0][2]; ?></p>
        <br>
    </div>
    <div class="play-container">
        <img src="img/<?php echo $data[0][3]; ?>" class="play-img">
        <div class="video-box">
            <video id="myvideo" src="videos/<?php echo $data[0][4]; ?>" controls></video>
        </div>
    </div>
</div>
<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("dropdown");
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }
    window.onclick = function(event) {
        if (!event.target.matches('#dropdownButton')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
    document.addEventListener('DOMContentLoaded', function () {
        var profile = document.getElementById('profile');
        var profileDropdown = document.getElementById('profile-dropdown');
        var language = document.getElementById('language');
        var languageDropdown = document.getElementById('language-dropdown');

        profile.addEventListener('click', function() {
            profileDropdown.style.display = profileDropdown.style.display === 'block' ? 'none' : 'block';
        });

        language.addEventListener('click', function() {
            languageDropdown.style.display = languageDropdown.style.display === 'block' ? 'none' : 'block';
        });

        // Close the dropdown if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (!event.target.matches('.profile-text') && !event.target.matches('.fas')) {
                profileDropdown.style.display = 'none';
                languageDropdown.style.display = 'none';
            }
        });
    });
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }

    const dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            const selectedValue = this.textContent;

            console.log('Seçilen değer:', selectedValue);


        });
    });
    document.getElementById("searchBox").addEventListener("input", function() {
        var searchText = this.value.trim(); // Arama metnini al
        if (searchText !== "") {
            var movieOptions = document.getElementById("movies").querySelectorAll("option");
            var movieId;
            movieOptions.forEach(function(option) {
                if (option.value === searchText) {
                    movieId = option.getAttribute("data-id");
                }
            });
            if (movieId) {
                window.location.href = "playpage.php?id=" + movieId + "&query=" + encodeURIComponent(searchText);
            }
        }
    });


    function changeLanguage(language) {

        document.documentElement.lang = language;

        // Metinleri güncelle
        if (language === 'tr') {
            document.getElementById("pageTitle").textContent = "IMDb'de bu haftanın en iyi 10'u";
            document.getElementById("Watchlist").textContent = "İstek Listesi";
            document.getElementById("Watchlist1").textContent = "İstek Listesi";

        } else if (language === 'en') {
            document.getElementById("pageTitle").textContent = "Top 10 on IMDb this week";
            document.getElementById("Watchlist").textContent = "Watchlist";
            document.getElementById("Watchlist1").textContent = "Watchlist";

        }

        // Seçilen dilin metnini güncelle
        document.getElementById("language").textContent = language.toUpperCase();
    }



</script>


<script src="app.js"></script>
</body>
</html>
