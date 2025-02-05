<?php

// DB+SS
require_once './../Database/user.php';
session_start();



// ingelogde users kunnen niet opnieuw inloggen !
if (isset($_SESSION['logged'])) {
    header("Location: ../HTML/dashboard.php"); # tijdelijke voorbeeld*
    exit;
    // aanvraag ontvangen
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dt = $userDB->loginUser($_POST['email']); # <--- Deze retourneert lijst met gegevens als er user bestaat
    // Als er een user op een email bestaat
    if ($dt) {
        // wachtwoord verificatie
        if (password_verify($_POST['password'], $dt['password'])) {
            $_SESSION['logged'] = true;
            $_SESSION['userID'] = $dt['id'];
            $_SESSION['name'] = $dt['name'];
            $_SESSION['surename'] = $dt['surename'];
            $_SESSION['email'] = $dt['email'];
            $_SESSION['phonenumber'] = $dt['phonenumber'];

            header("Location: ./dashboard.php"); # tijdelijke dashboard*
        } else {
            $_SESSION['LOGFL'] = "Invalid credentials"; # tijdelijke voorbeeld*
        }
    } else {
        $_SESSION['LOGFL'] = "No matching account was found for this email"; # tijdelijke voorbeeld*
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./../CSS/login.css">
    <link rel="stylesheet" href="./../CSS/feedback.css">
    <link rel="stylesheet" href="./../CSS/body.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/17357/17357982.png" type="image/png">
</head>

<!-- Fade effect  -->

<body onload="document.body.style.opacity=1">
    <div class="container">
        <a href="./homepage.html">
            <i class="overzicht">
                <img src="./../Images/Icons/vorige.png" alt="Arrow icon">
                <h2>Homepage</h2>
            </i>
        </a>
        <div class="formDiv">
            <div class="lft">
                <img src="./../Images/Icons/login.png" alt="Login icon">
            </div>
            <form method="post" class="formS">
                <div class="title">
                    Authenticate
                </div>
                <div class="naam">
                    <img src="./../Images/Icons/email.png" alt="Email icon">
                    <input type="email" required placeholder="Email" name="email">
                </div>
                <div class="wachtwoord">
                    <img src="./../Images/Icons/password.png" alt="">
                    <input type="password" required placeholder="Password" name="password">
                </div>
                <div class="knopje">
                    <input type="submit" value="Login" name="knop">
                </div>
                <div class="register">
                    <button><a href="sign_up.php">Register</a></button>
                    <button><a href="#">Forgot password</a></button>
                </div>
            </form>
        </div>
    </div>

    <!-- // feedback meldingen  -->
    <?php

    if (isset($_SESSION['LOGFL'])) {
        echo '<div class="messInvalid"><p class="checkIT">' . $_SESSION['LOGFL'] . '</p></div>';
        unset($_SESSION['LOGFL']);
    } elseif (isset($_SESSION['REGS'])) {
        echo '<div class="mess"><p class="checkIT">' . $_SESSION['REGS'] . '</p></div>';
        unset($_SESSION['REGS']);
    }
    
    ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./../JavaScript/feedback.js"></script>
</body>


</html>