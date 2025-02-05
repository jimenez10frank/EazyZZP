<?php

// DB+SS
require_once './../Database/user.php';
session_start();




// ingelogd ? 
if (!isset($_SESSION['logged'])) {
    header("Location: ../HTML/login.php");
    exit;
}

// gebruiker ID
$account_id = $_SESSION['userID'];

// haal persoonlijk gegevens op
$userDetails = $userDB->personalDetails($account_id);

// Controleer of de gegevens zijn opgehaald anders krijg je een error berichtje:)
if (!$userDetails) {
    echo "Gebruiker niet gevonden.";
    exit;
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../CSS/navbar.css">
    <link rel="stylesheet" href="./../CSS/personalDetails.css">
    <link rel="stylesheet" href="./../CSS/body.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/17357/17357982.png" type="image/png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body>
<nav class="navbar">
        <div class="left">
            <a href="../HTML/dashboard.php"><img class="logo" src="./../Images/Icons/logohomepage.png" alt="logo"></a>
        </div>
        <ul>
            <li><a href="../HTML/dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="../HTML/projects.php"><i class="fas fa-clipboard-list"></i> Projects</a></li>
            <li><a href="../HTML/insertProject.php"><i class="fas fa-folder-plus"></i> Add Project</a></li>
            <li><a href="../HTML/personalDetails.php"><i class="fas fa-user"></i> Personal Details</a></li>
        </ul>
        <div class="rechts">
            <a href="../HTML/logout.php" class="logout-link"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>
    <div class="personal-details-container">
        <h1>Personal Details</h1>
        <form action="../HTML/updateDetails.php" method="POST" class="personal-details-form">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($userDetails['name']); ?>"
                    required>
            </div>

            <div class="input-group">
                <i class="fas fa-user-tag"></i>
                <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($userDetails['surname']); ?>"
                    required>
            </div>

            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($userDetails['email']); ?>"
                    required>
            </div>

            <div class="input-group">
                <i class="fas fa-phone"></i>
                <input type="text" id="phonenumber" name="phonenumber"
                    value="<?= htmlspecialchars($userDetails['phonenumber']); ?>" required>
            </div>

            <button type="submit" class="update-button">Update Details</button>
        </form>
    </div>

</body>

</html>