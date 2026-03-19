<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
echo "ROLE:" . ($_SESSION['roleid'] ?? 'NOT SET'); // DEBUG
$current_page = basename($_SERVER['PHP_SELF']);
$role = $_SESSION['roleid'] ?? null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../../assets/css/layout.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../../assets/css/adm_style.css?v=<?php echo time(); ?>">

<link rel="stylesheet"
href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

<title>Sidebar</title>
</head>

<body>

<div class="navcontainer">
<nav class="nav">
<div class="nav-upper-options">

<!-- ================= ADMIN ================= -->
<?php if($role == 1){ ?>

<a href="../../pages/administrator/admin-dashboard.php"
class="nav-option <?php echo ($current_page == 'admin-dashboard.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">dashboard</span>
<h3>Dashboard</h3>
</a>

<a href="../../pages/administrator/manage-users.php"
class="nav-option <?php echo ($current_page == 'manage-users.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">manage_accounts</span>
<h3>Manage Users</h3>
</a>

<a href="../../pages/administrator/assign-roles.php"
class="nav-option <?php echo ($current_page == 'assign-roles.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">badge</span>
<h3>Assign Roles</h3>
</a>

<a href="../../pages/administrator/manage-academic-years.php"
class="nav-option <?php echo ($current_page == 'manage-academic-years.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">calendar_month</span>
<h3>Academic Years</h3>
</a>

<a href="../../pages/administrator/manage-faculties.php"
class="nav-option <?php echo ($current_page == 'manage-faculties.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">account_balance</span>
<h3>Faculties</h3>
</a>

<?php } ?>

<!-- ================= COORDINATOR ================= -->
<?php if($role == 2){ ?>

<a href="../../pages/marketing-coordinator/manage-contribution.php"
class="nav-option <?php echo ($current_page == 'manage-contribution.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">article</span>
<h3>Contributions</h3>
</a>

<a href="../../pages/marketing-coordinator/manage-guests.php"
class="nav-option <?php echo ($current_page == 'manage-guests.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">group</span>
<h3>Guests</h3>
</a>

<?php } ?>

<!-- ================= STUDENT ================= -->
<?php if($role == 3){ ?>

<a href="../../pages/student/student-panel.php"
class="nav-option <?php echo ($current_page == 'student-panel.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">dashboard</span>
<h3>Dashboard</h3>
</a>

<?php } ?>

<!-- ================= MANAGER ================= -->
<?php if($role == 5){ ?>

<a href="../../pages/marketing-manager/manager-dashboard.php"
class="nav-option <?php echo ($current_page == 'manager-dashboard.php') ? 'option1' : ''; ?>">
<span class="material-symbols-outlined">insights</span>
<h3>Manager Panel</h3>
</a>

<?php } ?>

<!-- ================= LOGOUT ================= -->
<a href="../../auth/logout.php" class="nav-option logout">
<span class="material-symbols-outlined">logout</span>
<h3>Logout</h3>
</a>

</div>
</nav>
</div>

</body>
</html>