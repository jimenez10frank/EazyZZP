<?php

// DB+SS
require_once './../Database/project.php';
session_start();


// Ingelogd?
if (!isset($_SESSION['logged'])) {
    header("Location: ../HTML/login.php");
    exit;
}

// ID or NOTHING :D
if (!isset($_GET['OOID'])) {
    header("Location: ./projects.php");
    exit;
}


// Haal taken en project op
try {
    $tk = $projectDB->selectTasks($_GET['OOID']);
    $pj = $projectDB->selectProject($_GET['OOID']);
} catch (\Throwable $s) {
    header("Location: projects.php");
    // error als er geen project is gevonden
    $_SESSION['PJSLERR'] = "An error occoured, please try again later";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
    <link rel="stylesheet" href="./../CSS/overview.css">
    <link rel="stylesheet" href="./../CSS/body.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/17357/17357982.png" type="image/png">
</head>

<body>
    <div class="container BOOM contain">
        <div class="overview">
            <div class="top">
                <div class="pjn">
                    <h2><?= $pj['projectname'] ?></h2>
                </div>
                <div class="dtt">
                    <h4>Start date <?= $pj['startdate'] ?></h4>
                    <h4>Deadline <?= $pj['enddate'] ?></h4>
                </div>
            </div>
            <div class="bottom">
                <div class="nestbot">
                    <div class="description">
                        <article>
                            <h3>Description</h3>
                            <p><?= $pj['description'] ?></p>
                        </article>
                        <b>
                            <p class="stat">Status: <?= $pj['status'] ?></p>
                        </b>
                    </div>

                    <div class="tkls">
                        <h3>Tasks</h3>
                        <p><em style="color:coral;">*duration of the task may vary*</em></p>

                        <div class="tasks">
                            <!--  controleer of er taken zij en print uit  -->
                            <?php if ($tk): ?>
                                <?php foreach ($tk as $task): ?>
                                    <div class="task">
                                        <h4 class="taskname"><?= $task['task_name'] ?></h4>
                                        <p>
                                            <li><?= $task['description'] ?></li>
                                        </p>
                                        <p>
                                            <li>Rate per hour: € <?= $task['rate_per_hour'] ?></li>
                                        </p>
                                        <p>
                                            <li>Duration: <?= rand(5, 20) ?> </li>
                                        </p>
                                        <p class="stat">status: <?= $task['status'] ?></p>
                                    </div>
                                <?php endforeach ?>
                                <!-- als geen taken gevonden zijn dan feedback geven -->
                            <?php else: ?>
                                <b><em><p>No tasks found.</p></em></b>
                            <?php endif; ?>
                        </div>

                    </div>
                    <div class="summary">
                        <h3>Total cost: €<?= $pj['total_cost'] ?></h3>
                        <p><em>Reminder: The total cost is an estimate and will be subject to change as the project
                                progresses. Any additional features or modifications requested by the client may affect
                                the final cost.</em></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
        <script src="./../JavaScript/effects.js"></script>
        <script src="./../JavaScript/feedback.js"></script>
        
</body>

</html>