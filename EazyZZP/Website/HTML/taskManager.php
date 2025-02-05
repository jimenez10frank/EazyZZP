<?php

// DB+SS
require_once './../Database/project.php';
session_start();


// Ingelogd?
if (!isset($_SESSION['logged'])) {
    header("Location: ../HTML/login.php");
    exit;
}

// geen project id geen toegang !
if (!isset($_GET['id'])) {
    header("Location: ./projects.php");
    exit;
}

// ID van project en gebruiker opslaan
$pjID = $_GET['id'];
$usID = $_SESSION['userID'];

// als we allebei id's hebben dan halen we project en taken op
$pj = $projectDB->pdo->run("SELECT * FROM project WHERE id = :projectID AND account_id = :accID", ["projectID" => $pjID, "accID" => $usID]);
$pjTSK = $projectDB->pdo->run("SELECT * FROM task WHERE project_id = :projectID", ["projectID" => $pjID]);

// taken verwijderen
if (isset($_GET['DLLTSD'])) {
    echo $_GET['DLLTSD'];
    try {
        if ($projectDB->deleteTask($_GET['DLLTSD'])) {
            $_SESSION['DLLTSD'] = "Task deleted successfully";
        }
        header("Location: ?id=$pjID");
        exit;
    } catch (\Throwable) {
        $_SESSION['DLLTSD'] = "Task deletion failed, Please try again";
    }
}


// Formulier ontvangen
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // registreren
    try {
        $taskData = $projectDB->insertTask($_GET['id'], $_POST['name'], $_POST['rate'], $_POST['description'], $_POST['status']);
        $_SESSION['DONZO'] = "Task inserted sucessfully ";
        header("Location: taskManager.php?id=$pjID");
        exit;
    } catch (PDOException $e) {
        $_SESSION['YIKES'] = "Failed adding Task. Our apologies";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="./../CSS/taskManager.css">
    <link rel="stylesheet" href="./../CSS/navbar.css">
    <link rel="stylesheet" href="./../CSS/body.css">
    <link rel="stylesheet" href="./../CSS/feedback.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/17357/17357982.png" type="image/png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body onload="document.body.style.opacity=1">
    <!-- // feedback meldingen  -->
    <?php

    if (isset($_SESSION['DONZO'])) {
        echo '<div class="mess"><p class="checkIT">' . $_SESSION['DONZO'] . '</p></div>';
        unset($_SESSION['DONZO']);
    } elseif (isset($_SESSION['YIKES'])) {
        echo '<div class="messInvalid"><p class="checkIT">' . $_SESSION['YIKES'] . '</p></div>';
        unset($_SESSION['YIKES']);
    } elseif(isset($_SESSION['DLLTSD'])){
        echo '<div class="mess"><p class="checkIT">' . $_SESSION['DLLTSD'] . '</p></div>';
        unset($_SESSION['DLLTSD']);
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
    <div class="container">

        <div class="left">

            <div class="info">
                <!-- gekozen project gegevens weergeven voor de zekerheid voor de gebruiker  -->
                <?php foreach ($pj as $project): ?>
                    <div class="title">
                        <h3>Project: <?= $project['projectname'] ?></h3>
                    </div>
                    <div class="descr">
                        <article>

                            <p><em><b>Description: </b></em><?= $project['description'] ?></p>
                        </article>
                    </div>
                    <div class="tasks">
                        <b><em>
                                <h3>Task(s)</h3>
                            </em></b>
                        <div class="diss">
                            <!-- zijn er taken ?  -->
                            <em>*For further details visit overview page*</em>
                            <?php foreach ($pjTSK as $task): ?>
                                <li class="wrapitup">
                                    <?= $task['task_name'] ?><a href="taskManager.php?id=<?= $pjID ?>&DLLTSD=<?= $task['id'] ?>" class="edit-btn remove  confT"><i class="fas fa-remove"></i>
                                        REMOVE
                                    </a>
                                    <br>
                                    <em>
                                        <?= $task['description'] ?>
                                    </em>
                                </li>
                            <?php endforeach; ?>
                        </div>

                    </div>
                    <div class="dates">
                        <li>Start date: <?= $project['startdate'] ?></li>
                        <li>Deadline: <?= $project['enddate'] ?></li>
                    </div>
                    <div class="cost">
                        <em>
                            Total cost: €<?= $project['total_cost'] ?>
                        </em>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="right">
            <div class="form">
                <form method="POST">
                    <div class="title">
                        <h4>
                            Add task to the project
                        </h4>
                    </div>
                    <div class="name">
                        <img src="./../Images/Icons/task.png" alt="">
                        <input type="name" required placeholder="Task name" name="name" required>
                    </div>
                    <div class="rate">
                        <img src="./../Images/Icons/rate.png" alt="">
                        <input type="price" required placeholder="Rate Per Hour" name="rate" required>
                    </div>
                    <div class="stat">
                        <img src="./../Images/Icons/pending.png" alt="">
                        <select name="status" id="" required>
                            <option class="dis" value="" disabled selected>Select Status</option>
                            <option value="Pending">Not started</option>
                            <option value="Pending">Pending</option>
                            <option value="In-progress">In-progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="desc">
                        <img src="./../Images/Icons/text.png" alt="">
                        <textarea placeholder="Task description" name="description" rows="10" required></textarea>
                    </div>
                    <div class="submit">
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- jq + feedback  -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./../JavaScript/feedback.js"></script>
    <script src="./../JavaScript/confirm.js"></script>

</body>

</html>