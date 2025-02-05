<?php

// DB+SS
require_once './../Database/user.php';
session_start();


// ingelogd ? 
if (!isset($_SESSION['logged'])) {
    header("Location: ../HTML/login.php");
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
    <link rel="stylesheet" href="./../CSS/dashboard.css">
    <link rel="stylesheet" href="./../CSS/body.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/17357/17357982.png" type="image/png">
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
    <div class="dashboard-container">
        <div class="welcome-section">
            <h1>Welcome Back!</h1>
            <p>Check the latest statistics and updates from your dashboard.</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <i class="fas fa-project-diagram"></i>
                <h3>Number of Projects</h3>
                <p>3</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-tasks"></i>
                <h3>Active Tasks</h3>
                <p>3</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-calendar-check"></i>
                <h3>Tasks to Complete</h3>
                <p>2</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3>Team Members</h3>
                <p>8</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-comment-dots"></i>
                <h3>New Messages</h3>
                <p>4</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-clock"></i>
                <h3>Hours Worked</h3>
                <p>120</p>
            </div>
        </div>

        <div class="task-list">
            <h2>Current Tasks</h2>
            <ul>
                <li><span class="task-name">Finish Project 1</span> - <span class="due-date">Due Date: 12/01/2025</span>
                </li>
                <li><span class="task-name">Update Documentation</span> - <span class="due-date">Due Date:
                        15/01/2025</span></li>
                <li><span class="task-name">Onboard New Client</span> - <span class="due-date">Due Date:
                        20/01/2025</span></li>
                <li><span class="task-name">Website Update</span> - <span class="due-date">Due Date: 22/01/2025</span>
                </li>
            </ul>
        </div>

        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="actions">
                <div class="action-card">
                    <i class="fas fa-plus-circle"></i>
                    <a class="geen" href="../HTML/insertProject.php">
                        <h4>Add Project</h4>
                    </a>
                </div>
                <div class="action-card">
                    <i class="fas fa-users-cog"></i>
                    <h4>Manage Team</h4>
                </div>
                <div class="action-card">
                    <i class="fas fa-comments"></i>
                    <h4>Messages</h4>
                </div>
                <div class="action-card">
                    <i class="fas fa-chart-line"></i>
                    <h4>View Performance</h4>
                </div>
            </div>
        </div>

        <div class="recent-activity">
            <h2>Recent Activity</h2>
            <ul>
                <li><i class="fas fa-check-circle"></i> Project 2 approved by client.</li>
                <li><i class="fas fa-comment-alt"></i> New feedback received for Project 1.</li>
                <li><i class="fas fa-cogs"></i> New task added for Website Update.</li>
                <li><i class="fas fa-bell"></i> Reminder set for task completion.</li>
            </ul>
        </div>

    </div>

</body>

</html>