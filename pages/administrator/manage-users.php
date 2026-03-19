<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

$required_role = 1;
require "../../auth/check_role.php";
require "../../config/database.php";

/* DELETE USER */
if(isset($_POST['delete_user'])){

$userid = $_POST['userid'];

/* Prevent deleting main admin */
if($userid == 1){
die("Main administrator cannot be deleted.");
}

$sql = "DELETE FROM tbluser WHERE userid = :userid";
$stmt = $pdo->prepare($sql);
$stmt->execute([
':userid' => $userid
]);

header("Location: manage-users.php?msg=deleted");
exit();
}

/* CREATE STAFF ACCOUNT */
if(isset($_POST['create_user'])){

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$roleid = $_POST['roleid'];

$facultyid = $_POST['facultyid'] ?? null;
if($facultyid === ''){
    $facultyid = null;
}
//only one cooridinator per faculty allowed
if($roleid == 2){ // coordinator

$sql = "SELECT userid FROM tbluser 
        WHERE facultyid = :fid AND roleid = 2";

$stmt = $pdo->prepare($sql);
$stmt->execute([':fid'=>$facultyid]);

if($stmt->fetch()){
    die("This faculty already has a coordinator.");
}
}

$sql = "INSERT INTO tbluser (username,email,password_hash,roleid,facultyid)
        VALUES (:username,:email,:password,:roleid,:facultyid)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
':username'=>$username,
':email'=>$email,
':password'=>$password,
':roleid'=>$roleid,
':facultyid'=>$facultyid
]);

header("Location: manage-users.php");
exit();
}
// Notify Email to coordinator if new guest registered
if($roleid == 4){ // guest role

$sql = "SELECT email FROM tbluser 
        WHERE facultyid = :fid AND roleid = 2";

$stmt = $pdo->prepare($sql);
$stmt->execute([':fid'=>$facultyid]);

$coordinator = $stmt->fetch();

if($coordinator){
    file_put_contents("../../logs/email_log.txt",
        "New guest registered for faculty {$facultyid}\n",
        FILE_APPEND
    );
}
}

/* FETCH USERS */
$sql = "SELECT u.userid, u.username, u.email, u.roleid, f.facultyname
        FROM tbluser u
        LEFT JOIN tblfaculty f ON u.facultyid = f.facultyid";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* FETCH FACULTIES */
$sql = "SELECT facultyid, facultyname FROM tblfaculty";
$stmt = $pdo->query($sql);
$faculties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazine System - Manage Users</title>
    <link rel="stylesheet" href="../../assets/css/adm_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <?php include '../../components/header.php'; ?>
    <div class="main-container">
        <?php include '../../components/sidebar.php'; ?>
        <div class="main">
            <?php if(isset($_GET['msg']) && $_GET['msg']=="deleted"){ ?>

                <div style="background:#d4edda;
                color:#155724;
                padding:12px;
                border-radius:6px;
                margin-bottom:15px;">

                ✅ User deleted successfully.

                </div>

            <?php } ?>
            <div class="dashboard-grid" style="grid-template-columns: 1fr;">
                
                <div class="card">
                    <h2>Register University Staff</h2>
                    <form method="POST" class="form-grid">

                    <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter username" required>
                    </div>

                    <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                    </div>

                    <div class="form-group">
                    <label>Temporary Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Create a password" required>
                    </div>

                    <div class="form-group">
                    <label>Staff Role</label>
                    <select name="roleid" class="form-control" required>
                    <option value="">Select role...</option>
                    <option value="2">Marketing Coordinator</option>
                    <option value="5">Marketing Manager</option>
                    <option value="1">Administrator</option>
                    </select>
                    </div>

                    <div class="form-group full-width">
                    <label>Assign Faculty (For Coordinators)</label>
                    <select name="facultyid" class="form-control">

                        <option value="">System Wide</option>

                        <?php foreach($faculties as $faculty){ ?>

                        <option value="<?php echo $faculty['facultyid']; ?>">
                        <?php echo $faculty['facultyname']; ?>
                        </option>

                        <?php } ?>

                    </select>
                    </div>

                    <div class="form-group full-width">
                    <button type="submit" name="create_user" class="cta-btn" style="width:200px;">
                    Create Account
                    </button>
                    </div>

                </form>
                </div>

                

                <div class="card">
                    <h2>Manage Staff Accounts</h2>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Assigned Role</th>
                                    <th>Faculty</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                           <tbody>

                            <?php foreach($users as $row){ ?>

                            <tr>
                            <td><?php echo $row['userid']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>

                            <td>
                            <?php
                            if($row['roleid']==1){
                            echo '<span class="role-badge badge-admin">Administrator</span>';
                            }
                            elseif($row['roleid']==2){
                            echo '<span class="role-badge badge-coordinator">Coordinator</span>';
                            }
                            elseif($row['roleid']==3){
                            echo '<span class="role-badge badge-student">Student</span>';
                            }
                            elseif($row['roleid']==4){
                            echo '<span class="role-badge badge-guest">Guest</span>';
                            }
                             elseif($row['roleid']==5){
                            echo '<span class="role-badge badge-manager">Marketing Manager</span>';
                            }
                            ?>
                            </td>

                            <td>
                            <?php echo !empty($row['facultyname']) ? $row['facultyname'] : "System Wide"; ?>
                            </td>

                            <td>

                                <form method="POST">

                                <input type="hidden" name="userid" value="<?php echo $row['userid']; ?>">

                                <button type="submit" name="delete_user"
                                onclick="return confirm('Are you sure you want to delete this user?')"
                                class="cta-btn"
                                style="padding:5px 10px;font-size:12px;background:#d9534f;">
                                Delete
                                </button>

                                </form>

                            </td>

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
</html>