<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require "../config/database.php";

if(!isset($_SESSION['userid'])){
header("Location: ../pages/auth/login.html");
exit();
}

$coordinatorid = $_SESSION['userid'];
$facultyid = $_SESSION['facultyid'];

$contributionid = $_POST['contributionid'];
$comment = $_POST['comment_text'];
$is_selected = isset($_POST['is_selected']) ? 1 : 0;
if($is_selected){
    $status = "selected";
} else {
    $status = "submitted"; // NOT rejected
}


/* faculty ownership check */

$sql = "SELECT facultyid, submission_date
        FROM tblcontribution
        WHERE contributionid = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute([':id'=>$contributionid]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$row || $row['facultyid'] != $facultyid){
die("Unauthorized action.");
}

/* DEADLINE CHECK (14 days from submission) */

if(empty($row['submission_date'])){
    die("Invalid submission date.");
}

$submission_date = new DateTime($row['submission_date']);
$deadline = clone $submission_date;
$deadline->modify('+14 days');

$today = new DateTime();

if($today > $deadline){
    die("Review deadline passed.");
}


/* save review */

$sql = "INSERT INTO tblreview
        (contributionid, coordinatorid, comment_text, is_selected)
        VALUES (:cid, :uid, :comment, :selected)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
':cid'=>$contributionid,
':uid'=>$coordinatorid,
':comment'=>$comment,
':selected'=>$is_selected
]);


/* update article status */

$status = $is_selected ? 'selected' : 'submitted'; // NOT rejected, just not selected yet

$sql = "UPDATE tblcontribution
        SET status = :status
        WHERE contributionid = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
':status'=>$status,
':id'=>$contributionid
]);


header("Location: ../pages/marketing-coordinator/manage-contribution.php?success=1");
exit();

?>