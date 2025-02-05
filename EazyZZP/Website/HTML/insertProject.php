<?php

// DB+SS
require_once "../Database/project.php";
session_start();

if (!isset($_SESSION['logged'])) {
    header("Location: ../HTML/login.php");
    exit;
}

$account_id = $_SESSION['userID'];  // hier heb ik de account id meegenomen. Deze ga je nodig hebben voor de klant pagina later voor het kijken van het project


// proberen om de request op te vangen 
try {
    // hier wordt de data opgestuurd
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $project = new Project();

        $project->insertProject(
            $_POST['projectname'],
            $_POST['description'],
            $_POST['startdate'],
            $_POST['enddate'],
            $_POST['status'],
            $_POST['total_cost'],
            $account_id
        );

        $_SESSION['INSS'] = "Project added successfully";
    }
} catch (\Throwable $th) {
    $_SESSION['INSF'] = "Project added successfully";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../CSS/insertProject.css">
    <link rel="stylesheet" href="./../CSS/body.css">
    <link rel="stylesheet" href="./../CSS/navbar.css">
    <link rel="stylesheet" href="./../CSS/feedback.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/17357/17357982.png" type="image/png">
    <title>Project Toevoegen</title>
</head>

<body>
    <!-- // feedback meldingen  -->
    <?php

    if (isset($_SESSION['INSS'])) {
        echo '<div class="mess"><p class="checkIT">' . $_SESSION['INSS'] . '</p></div>';
        unset($_SESSION['INSS']);
    } elseif (isset($_SESSION['INSF'])) {
        echo '<div class="messInvalid"><p class="checkIT">' . $_SESSION['INSF'] . '</p></div>';
        unset($_SESSION['INSF']);
    }
    ?>
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
    <div class="ctform">

        <form method="POST">
            <h2>Add Project</h2>
            <div>
                <label for="projectname"><i class="fas fa-folder-plus"></i></label>
                <input type="text" name="projectname" placeholder="Project Name" required>
            </div>
            <div>
                <label for="description"><i class="fas fa-align-left"></i></label>
                <textarea name="description" placeholder="Project Description" required></textarea>
            </div>
            <div>
                <label for="startdate"><i class="fas fa-calendar-alt"></i></label>
                <input type="date" name="startdate" required>
            </div>
            <div>
                <label for="enddate"><i class="fas fa-calendar-check"></i></label>
                <input type="date" name="enddate" required>
            </div>
            <div>
                <label for="status"><i class="fas fa-info-circle"></i></label>
                <input type="text" name="status" placeholder="Status" required>
            </div>
            <div>
                <label for="total_cost"><i class="fas fa-euro-sign"></i></label>
                <input type="number" name="total_cost" placeholder="Total Cost" required>
            </div>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./../JavaScript/feedback.js"></script>
</body>

</html>