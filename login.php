<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="881099561612-otl8ecqdqp1ha7ooq74jn9oork9fgchd.apps.googleusercontent.com">
    <title>Movie Design</title>
</head>

<body>

<section class="container-login forms">
    <div class="form login">
        <div class="form-content">
            <header>Giriş Yap</header>
            <form action="login.php" method="post">
                <div class="field input-field">
                    <input type="email" id="email" name="email" placeholder="Email" class="input" required>
                </div>

                <div class="field input-field">
                    <input type="password" id="password" name="password" placeholder="Password" class="password" required>
                    <i class='bx bx-hide eye-icon'></i>
                </div>

                <div class="field button-field">
                    <button type="submit">Giriş Yap</button>
                </div>
            </form>

            <div class="form-link">
                <span>Hesabın yok mu? <a href="#" class="link signup-link">Kayıt Ol</a></span>
            </div>
        </div>

        <div class="line"></div>

        <div class="media-options">
            <a href="#" class="field google">
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
            </a>
        </div>
    </div>

    <!-- Signup Form -->

    <div class="form signup">
        <div class="form-content">

            <header>Kayıt Ol</header>
            <form action="login.php" method="post">
                <div class="field input-field">
                    <input type="email" id="email" name="email" placeholder="Email" class="input">
                </div>
                <div class="field input-field">
                    <input type="text" id="name" name="name" placeholder="İsim" class="input" >
                </div>
                <div class="field input-field">
                    <input type="text" id="surname" name="surname" placeholder="Soyisim" class="input" >
                </div>

                <div class="field input-field">
                    <input type="password" id="password" name="password" placeholder="Şifre" class="password" >
                </div>

                <div class="field input-field">
                    <input type="password" id="again-password" name="again-password" placeholder="Şifre Tekrar" class="password" >
                    <i class='bx bx-hide eye-icon'></i>
                </div>
                <div class="field input-field">
                    <input type="text" id="country" name="country" placeholder="Ülke" class="password" >

                </div>
                <div class="field input-field">
                    <input type="text" id="city" name="city" placeholder="Şehir" class="password" >
                </div>


                <div id="inputContainer" class="field input-field"></div> <!-- Dinamik input alanı -->
                <div class="field button-field">
                    <button type="submit">Kayıt Ol</button>
                </div>
            </form>

            <div class="form-link">
                <span>Hesabın var mı? <a href="#" class="link login-link">Giriş Yap</a></span>
            </div>
        </div>
    </div>
</section>

<script>

    const forms = document.querySelector(".forms"),
        pwShowHide = document.querySelectorAll(".eye-icon"),
        links = document.querySelectorAll(".link");

    pwShowHide.forEach(eyeIcon => {
        eyeIcon.addEventListener("click", () => {
            let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");

            pwFields.forEach(password => {
                if (password.type === "password") {
                    password.type = "text";
                    eyeIcon.classList.replace("bx-hide", "bx-show");
                    return;
                }
                password.type = "password";
                eyeIcon.classList.replace("bx-show", "bx-hide");
            });
        });
    });

    links.forEach(link => {
        link.addEventListener("click", e => {
            e.preventDefault(); // preventing form submit
            forms.classList.toggle("show-signup");
        });
    });

    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId());
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail());
    }
</script>
<?php

include $_SERVER["DOCUMENT_ROOT"] . "/Controller/userController.php";
$info = getUsersByID([]);

$data = [];
foreach ($info as $value){
    $data[] = array(
        $value->getUserID(),
        $value->getUserName(),
        $value->getUserSurname(),
        $value->getEmail(),
        $value->getPassword(),
        $value->getCountry(),
        $value->getCity(),
        $value->getWatchList()
    );
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'])) {
        addUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['country'], $_POST['city'],"1");

    } else {
        $isValid = login($_POST['email'], $_POST['password']);

        if ($isValid) {
            echo "<script>window.location.href='index.php';</script>";
        }
    }
}
?>
<script src="app.js"></script>
</body>

</html>
