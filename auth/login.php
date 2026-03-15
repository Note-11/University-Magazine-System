<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../pages/auth/login.html");
    exit();
}

require "../config/database.php";

$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$password = trim($_POST['password']);

$sql = "SELECT * FROM tbluser WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password_hash'])) {

    session_regenerate_id(true);

    $_SESSION['userid'] = $user['userid'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['roleid'] = $user['roleid'];

    if ($user['roleid'] == 1) {
        header("Location: ../pages/administrator/admin-dashboard.php");
        exit();
    }
    elseif ($user['roleid'] == 3) {
        header("Location: ../pages/student/student-panel.php");
        exit();
    }
    else {
        echo "Role dashboard not implemented yet";
        exit();
    }
}
else {
    echo "Invalid login";
}
?>