<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Article - Magazine System</title>
    <link rel="stylesheet" href="../../assests/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../assests/css/marketing_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>

    <?php include '../../components/header.php'; ?>

    <div class="main">
        
        <div style="margin-bottom: 25px;">
            <a href="manage-contribution.php" style="color: var(--text-light); text-decoration: none; display: inline-flex; align-items: center; gap: 5px; font-size: 14px; font-weight: 500;">
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span>
                Back to Faculty Contributions
            </a>
        </div>

        <div class="review-grid">
            
            <div class="review-card">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px;">
                    <h2 style="margin: 0; color: var(--primary-navy);">Submission Details</h2>
                    <span class="status-warning" style="background-color: var(--bg-page); padding: 5px 12px; border-radius: 20px; border: 1px solid #ffd700;">Pending Review</span>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Article Title</div>
                    <div class="detail-value" style="font-size: 18px; font-weight: 600;">The Future of AI on Campus</div>
                </div>

                <div class="detail-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <div class="detail-label">Student Author</div>
                        <div class="detail-value">Alex Johnson</div>
                    </div>
                    <div>
                        <div class="detail-label">Submission Date</div>
                        <div class="detail-value">March 1, 2026</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-label">Student's Description</div>
                    <div class="detail-value" style="font-size: 14px; line-height: 1.6; color: var(--text-light);">
                        An overview of how artificial intelligence is changing study habits and research methodologies among first-year IT students.
                    </div>
                </div>

                <h3 style="font-size: 15px; color: var(--primary-navy); margin: 25px 0 15px;">Attached Files</h3>
                
                <div class="file-box">
                    <div class="file-info">
                        <span class="material-symbols-outlined">description</span>
                        Main_Article_AI.docx
                    </div>
                    <button type="button" class="btn-secondary open-preview-btn" style="padding: 6px 15px; font-size: 12px; background-color: var(--bg-white);">
                        <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span> Preview File
                    </button>
                </div>

                <div class="file-box">
                    <div class="file-info">
                        <span class="material-symbols-outlined">image</span>
                        Campus_AI_Lab.jpg
                    </div>
                    <button type="button" class="btn-secondary open-preview-btn" style="padding: 6px 15px; font-size: 12px; background-color: var(--bg-white);">
                        <span class="material-symbols-outlined" style="font-size: 16px;">visibility</span> Preview Image
                    </button>
                </div>
            </div>

            <div class="review-card" style="border-top: 4px solid var(--accent-gold);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                    <h2 style="margin: 0; color: var(--primary-navy);">Coordinator Action</h2>
                    <span style="font-size: 13px; font-weight: 600; color: var(--status-overdue);">
                        <span class="material-symbols-outlined" style="font-size: 16px; vertical-align: text-bottom;">timer</span>
                        10 Days Left
                    </span>
                </div>
                
                <form action="../../backend/submit_review.php" method="POST">
                    <input type="hidden" name="contributionid" value="101">
                    
                    <div style="margin-bottom: 25px;">
                        <label style="font-weight: 600; color: var(--text-dark); display: block; margin-bottom: 8px;">Your Feedback Comment</label>
                        <p style="font-size: 12px; color: var(--text-light); margin-bottom: 12px;">This feedback will be visible to the student to help them improve their work.</p>
                        <textarea name="comment_text" rows="6" placeholder="Write your required feedback here..." required style="width: 100%; padding: 15px; border: 1px solid var(--secondary-light-blue); border-radius: 6px; resize: vertical; font-family: inherit; font-size: 14px; outline: none;"></textarea>
                    </div>

                    <div style="background-color: var(--bg-page); padding: 20px; border-radius: 8px; border: 1px solid var(--secondary-light-blue); margin-bottom: 25px;">
                        <h3 style="font-size: 14px; margin-bottom: 10px; color: var(--primary-navy);">Publication Decision</h3>
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="checkbox" name="is_selected" value="1" style="margin-top: 3px; width: 16px; height: 16px;">
                            <div>
                                <span style="font-weight: 600; font-size: 14px; color: var(--text-dark); display: block;">Select this article for publication</span>
                                <span style="font-size: 12px; color: var(--text-light); line-height: 1.4; display: block; margin-top: 4px;">Checking this box will make the article available for the Marketing Manager to download in the final ZIP file.</span>
                            </div>
                        </label>
                    </div>

                    <div style="display: flex; gap: 15px; justify-content: flex-end;">
                        <button type="button" class="btn-secondary">Save Draft</button>
                        <button type="submit" class="btn-primary">
                            <span class="material-symbols-outlined" style="font-size: 18px;">send</span> Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="documentPreviewModal" class="preview-modal-overlay">
        <div class="preview-header">
            <h3 style="margin: 0; font-weight: 500;" id="previewTitle">Secure Document Preview</h3>
            <button class="preview-close" id="closePreviewBtn">&times;</button>
        </div>
        <div class="preview-frame-container">
            <div class="mockup-viewer">
                <span class="material-symbols-outlined" style="font-size: 48px; color: var(--secondary-light-blue); margin-bottom: 15px;">visibility</span>
                <h2>Document Rendering...</h2>
                <p>The backend will embed the requested Word document or image here for safe, read-only viewing.</p>
            </div>
        </div>
    </div>
    <script src="../../assests/js/script.js"></script>
    <?php include '../../components/footer.php'; ?>
</body>
</html>