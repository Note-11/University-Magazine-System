<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                    <h2>Add New Faculty</h2>
                    <form class="form-grid">
                        <div class="form-group">
                            <label>Faculty Name</label>
                            <input type="text" class="form-control" placeholder="Enter faculty name">
                        </div>
                        <div class="form-group">
                            <label>Faculty Description</label>
                            <input type="text" class="form-control" placeholder="e.g. Department of Computer Science">
                        </div>
                        <div class="form-group full-width">
                            <label>Assign Coordinator (Optional)</label>
                            <select class="form-control">
                                <option>Select a Coordinator...</option>
                                <option>Jane Smith</option>
                                <option>Alan Turing</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <button type="submit" class="cta-btn" style="width: 200px;">Register Faculty</button>
                        </div>
                    </form>
                </div>
                
                <div class="card">
                    <h2>Current Faculties</h2>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Faculty ID</th>
                                    <th>Faculty Name</th>
                                    <th>Assigned Coordinator</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>FAC-01</td>
                                    <td>Faculty of IT</td>
                                    <td>Jane Smith</td>
                                    <td><span class="role-badge badge-coordinator">Active</span></td>
                                </tr>
                                <tr>
                                    <td>FAC-02</td>
                                    <td>Faculty of Business</td>
                                    <td>Pending Assignment</td>
                                    <td><span class="role-badge badge-manager">Pending</span></td>
                                </tr>
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