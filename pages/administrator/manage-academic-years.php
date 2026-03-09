<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$required_role = 1;
require "../../auth/check_role.php";
require "../../config/database.php";

/* CREATE ACADEMIC YEAR */
if(isset($_POST['save_year'])){

    $yearname = $_POST['yearname'];
    $submission_date = $_POST['submission_date'];
    $final_date = $_POST['final_date'];

    $sql = "INSERT INTO tblacademicyear 
            (yearname, submission_closure_date, final_closure_date)
            VALUES (:yearname, :submission_date, :final_date)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':yearname'=>$yearname,
        ':submission_date'=>$submission_date,
        ':final_date'=>$final_date
    ]);

    header("Location: manage-academic-years.php?msg=added");
    exit();
}

/* FETCH ACADEMIC YEARS */
$sql = "SELECT * FROM tblacademicyear ORDER BY yearname DESC";
$stmt = $pdo->query($sql);
$years = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>

<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Magazine System - Academic Years</title>

<link rel="stylesheet" href="../../assets/css/adm_style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>

<?php include '../../components/header.php'; ?>

<div class="main-container">

<?php include '../../components/sidebar.php'; ?>

<div class="main">

<?php if(isset($_GET['msg']) && $_GET['msg']=="added"){ ?>

<div style="background:#d4edda;color:#155724;padding:12px;border-radius:6px;margin-bottom:15px;">
✅ Academic year saved successfully.
</div>
<?php } ?>

<div class="dashboard-grid" style="grid-template-columns:1fr;">

<!-- CARD 1 : CREATE ACADEMIC YEAR -->

<div class="card">

<h2>Configure Academic Year Details</h2>

<form method="POST" class="form-grid">

<div class="form-group full-width">
<label>Academic Year Name</label>
<input type="text" name="yearname" class="form-control" placeholder="e.g. 2025/2026" required>
</div>

<div class="form-group">
<label>Submission Closure Date</label>
<input type="date" name="submission_date" class="form-control" required>
</div>

<div class="form-group">
<label>Final Closure Date</label>
<input type="date" name="final_date" class="form-control" required>
</div>

<div class="form-group full-width">
<button type="submit" name="save_year" class="cta-btn" style="width:200px;">
Save Configuration
</button>
</div>

</form>

</div>

<!-- CARD 2 : SHOW ACADEMIC YEARS -->

<div class="card">

<h2>Academic Years</h2>

<div class="admin-table-container">

<table class="admin-table">

<thead>
<tr>
<th>Year</th>
<th>Submission Closure</th>
<th>Final Closure</th>
</tr>
</thead>

<tbody>

<?php foreach($years as $year){ ?>

<tr>
<td><?php echo $year['yearname']; ?></td>
<td><?php echo $year['submission_closure_date']; ?></td>
<td><?php echo $year['final_closure_date']; ?></td>
</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php include '../../components/footer.php'; ?>

</body>
</html>
