<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require "../config/database.php";

/* AUTH CHECK */
if (!isset($_SESSION['userid'])) {
    die("Unauthorized");
}

$contributionid = $_GET['id'] ?? null;
$fileIndex = $_GET['file'] ?? null; // NEW: which file (1,2,3)

$facultyid = $_SESSION['facultyid'];

if (!$contributionid || !$fileIndex) {
    die("Invalid request");
}

/*
FETCH CONTRIBUTION + FACULTY CHECK VIA JOIN
*/
$sql = "SELECT 
            c.filepath1,
            c.filepath2,
            c.filepath3,
            u.facultyid
        FROM tblcontribution c
        JOIN tbluser u ON c.studentid = u.userid
        WHERE c.contributionid = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $contributionid]);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$row) {
    die("File not found");
}

/* FACULTY SECURITY CHECK */
if ($row['facultyid'] != $facultyid) {
    die("Access denied");
}

/*
SELECT FILE BASED ON INDEX
*/
$allowedIndexes = ['1','2','3'];

if (!in_array($fileIndex, $allowedIndexes)) {
    die("Invalid file selection");
}

$fileColumn = "filepath" . $fileIndex;
$filename = $row[$fileColumn] ?? null;

if (!$filename) {
    die("File not available");
}

/*
SECURE PATH
*/
$baseDir = realpath(__DIR__ . "/../uploads/articles/");
$filePath = realpath($baseDir . "/" . $filename);

/* PREVENT DIRECTORY TRAVERSAL */
if (!$filePath || strpos($filePath, $baseDir) !== 0) {
    die("Invalid file path");
}

/* CHECK EXISTENCE */
if (!file_exists($filePath)) {
    die("File missing");
}

/*
DETECT MIME TYPE
*/
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $filePath);

/*
ALLOWED TYPES
*/
$allowedTypes = [
    "image/jpeg",
    "image/png",
    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
];

if (!in_array($mime, $allowedTypes)) {
    die("File type not allowed");
}

/*
STREAM FILE
*/
header("Content-Type: " . $mime);
header("Content-Disposition: inline; filename=\"" . basename($filePath) . "\"");

readfile($filePath);
exit();