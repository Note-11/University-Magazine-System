<?php

$required_role = 2;
require "../../auth/check_role.php";
require "../../config/database.php";

$facultyid = $_SESSION['facultyid'];

/* Fetch guests (roleid = 4) */

$sql = "SELECT userid, username, email, created_at
        FROM tbluser
        WHERE roleid = 4
        AND facultyid = :facultyid
        ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([':facultyid'=>$facultyid]);

$guests = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Guests</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<?php include '../../components/header.php'; ?>
<!-- <?php include '../../components/sidebar.php'; ?> -->

<div class="main">

<h2>Guest Accounts</h2>

<?php if(empty($guests)){ ?>
    <p>No guests in your faculty.</p>
<?php } ?>

<table style="border: 1px solid black; border-collapse: collapse;" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Registered</th>
</tr>

<?php foreach($guests as $g){ ?>

<tr>
    <td><?php echo $g['userid']; ?></td>
    <td><?php echo htmlspecialchars($g['username']); ?></td>
    <td><?php echo htmlspecialchars($g['email']); ?></td>
    <td><?php echo $g['created_at']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>