<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../pages/auth/register.html");
    exit();
}

require "../config/database.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$faculty = $_POST['faculty'];
$role = $_POST['role'];

$password_hash = password_hash($password, PASSWORD_DEFAULT);

/* faculty mapping */

$faculty_map = [
    "computing" => 1,
    "business" => 2,
    "education" => 3,
    "engineering" => 4
];

$facultyid = $faculty_map[$faculty] ?? null;

/* role mapping */

$role_map = [
    "student" => 3,
    "guest" => 4
];

$roleid = $role_map[$role];
$check = $pdo->prepare("SELECT * FROM tbluser WHERE email = ?");
$check->execute([$email]);

if ($check->rowCount() > 0) {
    echo "Email already registered";
    exit();
}

$sql = "INSERT INTO tbluser (facultyid, roleid, username, email, password_hash)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$facultyid, $roleid, $username, $email, $password_hash]);
/* =========================
   EMAIL NOTIFICATION (ONLY FOR GUEST)
   ========================= */

if($roleid == 4){ // guest only

    require "../backend/send-mail.php";

    // get coordinator email for same faculty
    $sql = "SELECT email 
            FROM tbluser
            WHERE facultyid = ? AND roleid = 2
            LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$facultyid]);

    $coordinator = $stmt->fetch(PDO::FETCH_ASSOC);

    if($coordinator){

        $subject = "New Guest Registered";

        $body = "
            <h3>New Guest Account Created</h3>
            <p><strong>Name:</strong> {$username}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p>A guest has registered in your faculty.</p>
        ";

        sendMail($coordinator['email'], $subject, $body);
    }
}

/* ========================= */

header("Location: ../pages/auth/login.html");
exit();
?>