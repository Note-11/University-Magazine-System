<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

$required_role = 2;
require "../../auth/check_role.php";
require "../../config/database.php";

$contributionid = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$facultyid = $_SESSION['facultyid'];

/* FETCH ARTICLE */

$sql = "SELECT 
            c.*,
            u.username AS student_name
        FROM tblcontribution c
        JOIN tbluser u ON c.studentid = u.userid
        WHERE c.contributionid = :id
        AND u.facultyid = :facultyid";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id'=>$contributionid,
    ':facultyid'=>$facultyid
]);

$article = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$article){
    die("Access denied or article not found.");
}

/* SAFE DATE HANDLING */

$today = new DateTime();

if(!empty($article['submission_date'])){
    $submission_date = new DateTime($article['submission_date']);
    $deadline = clone $submission_date;
    $deadline->modify('+14 days');
} else {
    $deadline = clone $today; // fallback safety
}

$is_overdue = $today > $deadline;

if($is_overdue){
    $days_left = 0;
} else {
    $days_left = $today->diff($deadline)->days;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Review Article</title>

<link rel="stylesheet" href="../../assets/css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../../assets/css/marketing_style.css?v=<?php echo time(); ?>">

<link rel="stylesheet"
href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

</head>

<body>

<?php include '../../components/header.php'; ?>
<!-- <?php include '../../components/sidebar.php'; ?> -->

<div class="main">

<div style="margin-bottom:25px;">
<a href="manage-contribution.php" style="text-decoration:none;color:#777;">
← Back to Contributions
</a>
</div>

<div class="review-grid">

<!-- ARTICLE DETAILS -->
<div class="review-card">

<h2 style="margin-bottom:15px;">
<?php echo htmlspecialchars($article['title']); ?>
</h2>

<div style="margin-bottom:10px;">
<strong>Student:</strong>
<?php echo htmlspecialchars($article['student_name']); ?>
</div>

<div style="margin-bottom:15px;">
<strong>Submission Date:</strong>
<?php echo date("F d, Y", strtotime($article['submission_date'])); ?>
</div>

<div style="margin-bottom:25px;">
<strong>Description</strong>
<p style="margin-top:5px;color:#555;line-height:1.6;">
<?php echo htmlspecialchars($article['description']); ?>
</p>
</div>

<h3>Attached Files</h3>

<?php for($i=1; $i<=3; $i++){ 
    $file = $article["filepath".$i] ?? null;

    if($file){ ?>

    <div class="file-box">

        <div class="file-info">
            <span class="material-symbols-outlined">description</span>
            <?php echo htmlspecialchars($file); ?>
        </div>

        <button
            class="btn-secondary open-preview-btn"
            data-url="../../backend/preview-file.php?id=<?php echo $article['contributionid']; ?>&file=<?php echo $i; ?>">

            <span class="material-symbols-outlined">visibility</span>
            Preview File

        </button>

    </div>

<?php } } ?>

</div>


<!-- REVIEW PANEL -->
<div class="review-card" style="border-top:4px solid var(--accent-gold);">

<h2 style="margin-bottom:20px;">Coordinator Action</h2>

<?php if($is_overdue){ ?>

<p style="color:red;font-weight:600;">
Comment deadline has passed
</p>

<?php } else { ?>

<p style="margin-bottom:15px;font-size:13px;color:#777;">
<?php echo $days_left; ?> Days Left to Comment
</p>

<form action="../../backend/submit-review.php" method="POST">

<input 
type="hidden" 
name="contributionid"
value="<?php echo $article['contributionid']; ?>">

<div style="margin-bottom:20px;">
<label style="font-weight:600;">Your Feedback Comment</label>

<textarea 
name="comment_text" 
rows="6" 
required
style="width:100%;padding:10px;border:1px solid #ccc;border-radius:6px;"></textarea>
</div>

<div style="margin-bottom:20px;">
<label style="display:flex;gap:10px;align-items:center;">
<input type="checkbox" name="is_selected" value="1">
Select for publication
</label>
</div>

<div style="text-align:right;">
<button type="submit" class="btn-primary">
Submit Review
</button>
</div>

</form>

<?php } ?>

</div>

</div>
</div>


<!-- PREVIEW MODAL -->
<div id="documentPreviewModal" class="preview-modal-overlay">

<div class="preview-header">
<h3>Preview</h3>

<button 
id="closePreviewBtn"
class="preview-close">
&times;
</button>

</div>

<div class="preview-frame-container">
<iframe 
id="previewFrame"
style="width:100%;height:100%;border:none;">
</iframe>
</div>

</div>

<script src="../../assets/js/script.js"></script>

<?php include '../../components/footer.php'; ?>

</body>
</html>