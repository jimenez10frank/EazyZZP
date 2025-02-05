<?php
require "../Database/project.php";

session_start();

if (!isset($_SESSION['logged'])) {
    header("Location: ../HTML/login.php");
    exit;
}

// Project verwijderen
if (isset($_GET['delID'])) {
    try {
        if ($projectDB->deleteProject($_GET['delID'])) {
            $_SESSION['DELSS'] = "Project deleted successfully";
        }
        header('Location: ./projects.php');
        exit;
    } catch (\Throwable) {
        $_SESSION['DELSS'] = "Project deletion failed, Please try again";
    }
}

$account_id = $_SESSION['userID'];  // Account ID van de ingelogde gebruiker

$projects = $projectDB->getProjects($account_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../CSS/navbar.css">
    <link rel="stylesheet" href="./../CSS/project.css">
    <link rel="stylesheet" href="./../CSS/body.css">
    <link rel="stylesheet" href="./../CSS/feedback.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/17357/17357982.png" type="image/png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <title>Projecten</title>
</head>

<body>
    <?php

    // Error weergeven als project niet goed werd gehaald op de overview pagina
    if (isset($_SESSION['PJSLERR'])) {
        echo '<div class="messInvalid"><p class="checkIT">' . $_SESSION['PJSLERR'] . '</p></div>';
        unset($_SESSION['PJSLERR']);
    } elseif (isset($_SESSION['DELSS'])) {
        echo '<div class="mess"><p class="checkIT">' . $_SESSION['DELSS'] . '</p></div>';
        unset($_SESSION['DELSS']);
    } elseif (isset($_SESSION['DLSFF'])) {
        echo '<div class="messInvalid"><p class="checkIT">' . $_SESSION['DELSS'] . '</p></div>';
        unset($_SESSION['DELSS']);
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

    <div class="project-list contain">
        <h2>My Projects</h2>
        <?php if ($projects): ?>
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Cost</th>
                        <th style="text-align:center;" colspan="3">Actions</th> <!-- New column for editing -->
                        <em style="color:green;">*Click <b>overview</b> to view project details*</em><br>
                    </tr>
                </thead>
                <tbody>
                    <!-- projecten doorloopen -->
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?= htmlspecialchars($project['projectname']); ?></td>
                            <td><?= htmlspecialchars($project['startdate']); ?></td>
                            <td><?= htmlspecialchars($project['enddate']); ?></td>
                            <td><?= htmlspecialchars($project['status']); ?></td>
                            <td><?= htmlspecialchars($project['total_cost']); ?></td>
                            <td class="conf">
                                <!-- Edit button -->
                                <a href="./projects.php?delID=<?= $project['id']; ?>" class="edit-btn remove">
                                    <i class="fas fa-remove"></i> Remove
                                </a>
                            </td>
                            <td>
                                <!-- Nieuw project button -->
                                <a href="taskManager.php?id=<?= $project['id']; ?>" class="edit-btn manage">
                                    <i class="fas fa-add"></i>Manage
                                </a>
                            </td>
                            <td>
                                <a href="overview.php?OOID=<?= $project['id']; ?>" class="edit-btn overview">
                                    <i class="fas fa-search"></i>Overview
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- als geen project is gevonden  -->
        <?php else: ?>
            <p>No projects found.</p>
            <a href="./insertProject.php"><button class="new">Add project</button></a>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./../JavaScript/feedback.js"></script>
    <script src="./../JavaScript/confirm.js"></script>
</body>

</html>