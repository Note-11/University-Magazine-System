```php
<?php
$required_role = 3;
require "../../auth/check_role.php";
require "../../config/database.php";

$sql = "SELECT categoryid, categoryname FROM tblcategory";
$stmt = $pdo->query($sql);
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazine System</title>

    <link rel="stylesheet" href="../../assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../assets/css/stud_style.css?v=<?php echo time(); ?>">

    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>

<?php include '../../components/header.php'; ?>

<?php include '../../components/header.php'; ?>
<?php if (isset($_GET['success'])): ?>
<div style="background:green;color:white;padding:10px;margin:10px;">
Article submitted successfully!
</div>
<?php endif; ?>

<div class="main">

    <div class="feed-grid">

        <!-- LEFT COLUMN -->
        <div class="feed-column">

            <!-- SUBMIT CARD -->
            <div class="card submit-card">
                <div>
                    <h2 class="widget-title" style="margin-bottom:5px;">Ready to submit?</h2>
                    <p class="widget-subtitle" style="margin:0;">
                        Upload your article and images for the upcoming issue.
                    </p>
                </div>

                <button class="cta-btn" id="openModalBtn">
                    <span class="material-symbols-outlined">cloud_upload</span>
                    Upload Contribution
                </button>
            </div>

            <!-- SUBMISSIONS -->
            <h2 class="widget-title" style="margin-top:35px;">My Previous Submissions</h2>

            <div class="card">
                <div class="post-header">
                    <div>
                        <div class="post-title">The Future of AI on Campus</div>
                        <span class="status-badge">Pending Coordinator Review</span>
                    </div>
                </div>

                <div class="post-content">
                    <p class="post-text">
                        Submitted on: March 1, 2026. Includes 1 Word document and 2 images.
                    </p>
                </div>

                <div class="post-actions">
                    <button class="cta-btn btn-sm">Edit Submission</button>
                </div>
            </div>

        </div>


        <!-- RIGHT COLUMN -->
        <div class="sidebar-column">

            <!-- DEADLINES -->
            <div class="card">
                <h2 class="widget-title" style="margin-bottom:0;">Faculty Deadlines</h2>
                <p class="widget-subtitle">Faculty of IT - 2025/2026</p>

                <div class="dark-stat-box">
                    <p>New Submissions Close In:</p>
                    <h1>14</h1>
                    <p>Days Left</p>
                </div>

                <p class="deadline-note">
                    Final Updates Close: <strong>Nov 14, 2026</strong>
                </p>
            </div>

            <!-- TRACK RECORD -->
            <div class="card">
                <h2 class="widget-title">My Track Record</h2>

                <div class="contribution-item">
                    <strong>0</strong> Approved Articles
                </div>

                <div class="contribution-item">
                    <strong>1</strong> Pending Reviews
                </div>
            </div>

        </div>

    </div>

</div>


<!-- UPLOAD MODAL -->
<div id="uploadModal" class="modal-overlay">

    <div class="modal-content">

        <div class="modal-header">
            <h2 class="widget-title" style="margin:0;">Submit New Article</h2>
            <button class="close-btn" id="closeModalBtn">&times;</button>
        </div>

        <form id="uploadForm" action="../../actions/upload-article.php" method="POST" enctype="multipart/form-data">

            <input type="text" name="title" class="submit-input"
            placeholder="Article Title" required>

            <select name="categoryid" class="submit-input" required>

                <option value="">Select Category</option>

                <?php foreach($categories as $row): ?>
                    <option value="<?php echo $row['categoryid']; ?>">
                    <?php echo $row['categoryname']; ?>
                    </option>
                <?php endforeach; ?>

            </select>

            <textarea name="description" class="submit-textarea"
            rows="2" placeholder="Brief Description (Optional)"></textarea>


            <div class="file-upload-container">

                <div class="file-upload-group">
                    <label>File 1 (Required)</label>
                    <p>Word Document (.doc, .docx)</p>

                    <input type="file"
                    name="filepath1"
                    accept=".doc,.docx"
                    required>
                </div>


                <div class="file-upload-group">
                    <label>File 2 (Optional)</label>
                    <p>Supporting Image or Doc</p>

                    <input type="file"
                    name="filepath2"
                    accept=".doc,.docx,image/*">
                </div>


                <div class="file-upload-group">
                    <label>File 3 (Optional)</label>
                    <p>Supporting Image or Doc</p>

                    <input type="file"
                    name="filepath3"
                    accept=".doc,.docx,image/*">
                </div>

            </div>


            <div class="form-footer">

                <label class="terms-label">
                    <input type="checkbox" required>
                    I agree to the <a href="#">Terms & Conditions</a>
                </label>

                <button type="submit" class="cta-btn">
                    <span class="material-symbols-outlined">send</span>
                    Submit
                </button>

            </div>

        </form>

    </div>

</div>


<?php include '../../components/footer.php'; ?>

<script src="../../assets/js/script.js"></script>

</body>
</html>
```
