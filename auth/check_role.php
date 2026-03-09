<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userid'])) {
    header("Location: /university-magazine-system-main/pages/auth/login.html");
    exit();
}

if (isset($required_role) && $_SESSION['roleid'] != $required_role) {
    header("HTTP/1.1 403 Forbidden");
    echo "Access denied";
    exit();
}