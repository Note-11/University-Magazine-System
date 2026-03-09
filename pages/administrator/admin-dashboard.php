<?php
$required_role = 1;
require "../../auth/check_role.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazine System - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/adm_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
  
    <?php include '../../components/header.php'; ?>

    <div class="main-container">
        
        <?php include '../../components/sidebar.php'; ?>
        
        <div class="main">
            <div class="box-container">
                <div class="box">
                    <div class="text">
                        <h2 class="topic-heading">342</h2>
                        <h2 class="topic">Total Registered Users</h2>
                    </div>
                </div>
                <div class="box">
                    <div class="text">
                        <h2 class="topic-heading">8</h2>
                        <h2 class="topic">Configured Faculties</h2>
                    </div>
                </div>
                <div class="box">
                    <div class="text">
                        <h2 class="topic-heading">2025/26</h2>
                        <h2 class="topic">Active Academic Year</h2>
                    </div>
                </div>
                <div class="box">
                    <div class="text">
                        <h2 class="topic-heading">6</h2>
                        <h2 class="topic">Pending Role Approvals</h2>
                    </div>
                </div>
            </div>

            <div class="dashboard-grid">
                
                <div class="card project-overview">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; flex-wrap: wrap; gap: 10px;">
                        <h2 style="margin-bottom: 0;">System Users Overview</h2>
                        <a href="manage-users.php" class="btn-secondary">
                            <span class="material-symbols-outlined" style="margin-right: 5px; font-size: 18px;">group_add</span> Manage All Users
                        </a>
                    </div>
                    <p>Distribution of registered user roles within the system.</p>
                    <div class="progress-bar">
                      <div class="progress-fill" style="width: 85%;"></div>
                    </div>
                    <ul class="task-list">
                      <li class="success">Students <span>290 Accounts</span></li>
                      <li class="pending">Marketing Coordinators <span>8 Accounts</span></li>
                      <li class="pending">Marketing Managers <span>2 Accounts</span></li>
                      <li class="overdue">Guests <span>40 Accounts</span></li>
                    </ul>
                </div>
              
                <div class="card milestone-tracking">
                    <h2>Academic Year Config</h2>
                    <p>Current timeline settings for the active Academic Year.</p>
                    <ul class="task-list">
                      <li class="success">2025-2026 Year <span>Active</span></li>
                      <li class="pending">Submission Closure <span>14 Days Left</span></li>
                      <li class="overdue">Final Closure <span>Not Set</span></li>
                    </ul>
                </div>
              
                <div class="card task-management">
                    <h2>Faculty Setup</h2>
                    <p>Quick view of configured faculties and assigned coordinators.</p>
                    <ul class="task-list">
                      <li class="success">Faculty of Science <span>Configured</span></li>
                      <li class="success">Faculty of Arts <span>Configured</span></li>
                      <li class="pending">Faculty of IT <span>Missing Coordinator</span></li>
                    </ul>
                </div>

                <div class="card resource-allocation">
                    <h2>Recent Role Assignments</h2>
                    <p>Latest changes to user roles and access permissions.</p>
                    <ul class="resource-list">
                        <li>J. Doe <span>Assigned: M. Coordinator</span></li>
                        <li>S. Smith <span>Assigned: Guest</span></li>
                        <li>A. Johnson <span>Assigned: Admin</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</body>
</html>