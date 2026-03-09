<?php
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

header("Location: ../pages/auth/login.html");
exit();
?>