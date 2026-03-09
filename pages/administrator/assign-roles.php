<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$required_role = 1;
require "../../auth/check_role.php";
require "../../config/database.php";

/* UPDATE ROLE */
if(isset($_POST['update_role'])){
    $userid = $_POST['userid'];
    $roleid = $_POST['roleid'];

    $sql = "UPDATE tbluser SET roleid = :roleid WHERE userid = :userid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':roleid' => $roleid,
        ':userid' => $userid
    ]);

    header("Location: assign-roles.php");
    exit();
}

/* FETCH USERS */
$sql = "SELECT userid, username, email, roleid FROM tbluser";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazine System</title>
    <link rel="stylesheet" href="../../assets/css/adm_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
    <?php include '../../components/header.php'; ?>
    <div class="main-container">
        <?php include '../../components/sidebar.php'; ?>
        <div class="main">
            <div class="dashboard-grid" style="grid-template-columns: 1fr;">
                <div class="card">
                    <h2>Assign System Roles</h2>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Current Role</th>
                                    <th>Change Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                           <tbody>

                            <?php foreach($users as $row) { ?>

                            <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>

                            <td>
                            <?php
                            if($row['roleid']==1){
                                echo '<span class="role-badge badge-admin">Admin</span>';
                            }
                            elseif($row['roleid']==2){
                                echo '<span class="role-badge badge-manager">Marketing Manager</span>';
                            }
                            elseif($row['roleid']==3){
                                echo '<span class="role-badge badge-coordinator">Coordinator</span>';
                            }
                            elseif($row['roleid']==4){
                                echo '<span class="role-badge badge-student">Student</span>';
                            }
                            else{
                                echo '<span class="role-badge badge-guest">Guest</span>';
                            }
                            ?>
                            </td>

                            <td>
                            <form method="POST">

                            <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">

                            <select name="roleid" class="form-control">
                            <option value="1" <?php if($row['roleid']==1) echo "selected"; ?>>Admin</option>
                            <option value="2" <?php if($row['roleid']==2) echo "selected"; ?>>Marketing Manager</option>
                            <option value="3" <?php if($row['roleid']==3) echo "selected"; ?>>Marketing Coordinator</option>
                            <option value="4" <?php if($row['roleid']==4) echo "selected"; ?>>Student</option>
                            <option value="5" <?php if($row['roleid']==5) echo "selected"; ?>>Guest</option>
                            </select>

                            </td>

                            <td>
                            <button type="submit" name="update_role" class="cta-btn">Update</button>
                            </td>

                            </form>

                            </tr>

                            <?php } ?>

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../../components/footer.php'; ?>
</body>