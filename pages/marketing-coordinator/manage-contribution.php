<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

$required_role = 2;
require "../../auth/check_role.php";
require "../../config/database.php";

$facultyid = $_SESSION['facultyid'];

$sql = "SELECT 
            c.contributionid,
            c.title,
            c.submission_date,
            c.status,
            u.username AS student_name
        FROM tblcontribution c
        JOIN tbluser u ON c.studentid = u.userid
        WHERE u.facultyid = :facultyid
        ORDER BY c.submission_date DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([':facultyid'=>$facultyid]);
$contributions = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Contributions</title>

<link rel="stylesheet" href="/University-Magazine-System-main/assets/css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="/University-Magazine-System-main/assets/css/marketing_style.css?v=<?php echo time(); ?>">

<link rel="stylesheet"
href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

</head>
<body>

<?php include '../../components/header.php'; ?>
<!-- <?php include '../../components/sidebar.php'; ?> -->

<div class="main">

<div class="header-controls">
<h1 style="color: var(--primary-navy); font-size: 24px;">Contributions</h1>
</div>

<div class="article-stack">

<?php if(empty($contributions)){ ?>

<div style="padding:20px;background:#fff;border-radius:6px;">
No contributions submitted yet.
</div>

<?php } ?>

<?php 
$today = new DateTime();

foreach($contributions as $row){

$submission_date = new DateTime($row['submission_date']);
$deadline = clone $submission_date;
$deadline->modify('+14 days');

$is_overdue = $today > $deadline;

if($is_overdue){
    $days_left = 0;
} else {
    $days_left = $today->diff($deadline)->days;
}
?>

<div class="article-card">

<div class="article-info">

<h3><?php echo htmlspecialchars($row['title']); ?></h3>

<div class="article-meta">

<span class="meta-item">
<span class="material-symbols-outlined">person</span>
<?php echo htmlspecialchars($row['student_name']); ?>
</span>

<span class="meta-item">
<span class="material-symbols-outlined">calendar_today</span>
<?php echo date("M d, Y", strtotime($row['submission_date'])); ?>
</span>

</div>

<?php if($row['status']=="selected"){ ?>

<span class="status-ok">
<span class="material-symbols-outlined">check_circle</span>
Selected for Publication
</span>

<?php } elseif($row['status']=="reviewed"){ ?>

<span class="status-info">
<span class="material-symbols-outlined">rate_review</span>
Reviewed
</span>

<?php } elseif($is_overdue){ ?>

<span class="status-danger">
<span class="material-symbols-outlined">error</span>
Comment Period Closed
</span>

<?php } else { ?>

<span class="status-warning">
<span class="material-symbols-outlined">warning</span>
<?php echo $days_left; ?> Days Left to Comment
</span>

<?php } ?>

</div>

<div class="action-group">

<?php if(!$is_overdue && $row['status']!="selected"){ ?>

<a href="review-article.php?id=<?php echo $row['contributionid']; ?>" class="btn-primary">
Review & Comment
</a>

<?php } else { ?>

<span style="font-size:12px;color:#888;">
Review Closed
</span>

<?php } ?>

</div>

</div>

<?php } ?>

</div>

</div>

<?php include '../../components/footer.php'; ?>

</body>
</html>