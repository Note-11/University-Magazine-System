<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: ../pages/auth/login.html");
    exit();
}

require "../config/database.php";

$studentid = $_SESSION['userid'];
$facultyid = $_SESSION['facultyid'];

$title = trim($_POST['title']);
$description = trim($_POST['description']);
$categoryid = intval($_POST['categoryid']);

/* ✅ GET ACTIVE ACADEMIC YEAR */
$sql = "SELECT academicyearid 
        FROM tblacademicyear 
        WHERE is_active = 1 
        LIMIT 1";

$stmt = $pdo->query($sql);
$academicyearid = $stmt->fetchColumn();

if(!$academicyearid){
    die("No active academic year found.");
}

/* FILE UPLOAD */
$upload_dir = __DIR__ . "/../uploads/articles/";

function uploadFile($input, $upload_dir){

    if (!isset($_FILES[$input]) || $_FILES[$input]['error'] == 4) {
        return null;
    }

    $file = $_FILES[$input];

    $allowed = [
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "application/octet-stream",
        "image/jpeg",
        "image/png"
    ];

    if (!in_array($file['type'], $allowed)) {
        die("Invalid file type");
    }

    $filename = time() . "_" . basename($file['name']);
    $target = $upload_dir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $target)) {
        die("File upload failed");
    }

    return $filename;
}

$file1 = uploadFile("filepath1", $upload_dir);
$file2 = uploadFile("filepath2", $upload_dir);
$file3 = uploadFile("filepath3", $upload_dir);

/* INSERT CONTRIBUTION */
$sql = "INSERT INTO tblcontribution
(studentid, facultyid, categoryid, academicyearid, title, description, submission_date, status, filepath1, filepath2, filepath3)
VALUES (?, ?, ?, ?, ?, ?, CURDATE(), 'submitted', ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $studentid,
    $facultyid,
    $categoryid,
    $academicyearid,
    $title,
    $description,
    $file1,
    $file2,
    $file3
]);

header("Location: ../pages/student/student-panel.php?success=1");
exit();
/* simulate email notification */

$sql = "SELECT email FROM tbluser 
        WHERE facultyid = :fid AND roleid = 2";

$stmt = $pdo->prepare($sql);
$stmt->execute([':fid'=>$facultyid]);

$coordinator = $stmt->fetch();

if($coordinator){
    // simulate email (log instead)
    file_put_contents("../logs/email_log.txt",
        "New submission for faculty {$facultyid} sent to {$coordinator['email']}\n",
        FILE_APPEND
    );
}