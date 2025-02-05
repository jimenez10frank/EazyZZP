<?php

// DB+SS
require_once './../Database/user.php';
session_start();

// ingelogde users kunnen niet opnieuw inloggen !
if (isset($_SESSION['logged'])) {
    header("Location: ./user-dashboard.php"); # tijdelijke voorbeeld*
    exit;
    // aanvraag ontvangen
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($userDB->SelectUser($_POST['email'])) { # <-- controleer of de email is al in gebruik 
        header('Location: ./sign_up.php');
        return $_SESSION['USFL'] = "This email is taken, please provide different email";
        exit;
    }

    // email validatie
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['EML'] = "Invalid Email";        
        header('Location: sign_up.php');
        exit;
    }
    
    // registreren
    try {
        $userDB->registerUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['phonenumber'], $_POST['password']);
        $_SESSION['REGS'] = "Registration was successful";
        header("Location: ./login.php");
        exit;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="./../CSS/sign_up.css">
    <link rel="stylesheet" href="./../CSS/feedback.css">
    <link rel="stylesheet" href="./../CSS/body.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/17357/17357982.png" type="image/png">
</head>

<body onload="document.body.style.opacity=1">
    <?php
    // feedback 
    if (isset($_SESSION['USFL'])) {
        echo '<div class="messInvalid"><p class="checkIT">' . $_SESSION['USFL'] . '</p></div>';
        unset($_SESSION['USFL']);
    } elseif (isset($_SESSION['EML'])) {
        echo '<div class="messInvalid"><p class="checkIT">' . $_SESSION['EML'] . '</p></div>';
        unset($_SESSION['EML']);
    }
    ?>
    <div class="container">
        <a href="./homepage.html">
            <i class="overzicht">
                <img src="./../Images/Icons/vorige.png" alt="Arrow icon">
                <h2>Homepage</h2>
            </i>
        </a>
        <a href="./login.php">
            <i class="inlogOverzicht">
                <h2>Login</h2>
                <img src="./../Images/Icons/volgende.png" alt="Arrow icon">
            </i>
        </a>
        <div class="formDiv">
            <div class="lft">
                <img src="./../Images/Icons/registreren.png" alt="Login icon">
            </div>
            <form method="post" class="formS">
                <div class="title">
                    Start Your Journey
                </div>
                <div class="naam">
                    <img src="./../Images/Icons/signature.png" alt="Signature icon">
                    <input type="text" required placeholder="First Name" name="name">
                </div>
                <div class="achternaam">
                    <img src="./../Images/Icons/id-card.png" alt="ID icon">
                    <input type="text" required placeholder="Last Name" name="surname">
                </div>
                <div class="email">
                    <img src="./../Images/Icons/email.png" alt="icon">
                    <input type="email" required placeholder="Email" name="email">
                </div>
                <div class="nummer">
                    <img src="./../Images/Icons/iphone.png" alt="Phone icon">
                    <input id="telefoonNummer" value="+31 6 " type="text" name="phonenumber" required>
                </div>
                <div class="wachtwoord">
                    <img src="./../Images/Icons/password.png" alt="pwd icon">
                    <input type="password" required placeholder="Password" name="password" minlength="8">
                </div>
                <div class="knopje">
                    <input type="submit" value="Sign up " name="knop">
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./../JavaScript/feedback.js"></script>
    <script src="./../JavaScript/validations.js"></script>
</body>

</html>