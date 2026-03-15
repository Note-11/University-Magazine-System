<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contributions - Magazine System</title>
    <link rel="stylesheet" href="../../assests/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../assests/css/marketing_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>

    <?php include '../../components/header.php'; ?>

    <div class="main">
        <div class="header-controls">
            <h1 style="color: var(--primary-navy); font-size: 24px;">Contributions</h1>
            
            <div class="filter-group">
                <select class="filter-select">
                    <option value="all">All Academic Years</option>
                    <option value="2025">2025/2026</option>
                </select>
                <select class="filter-select">
                    <option value="pending">Pending Review</option>
                    <option value="selected">Selected for Publication</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>
        </div>

        <div class="article-stack">
            
            <div class="article-card">
                <div class="article-info">
                    <h3>The Future of AI on Campus</h3>
                    <div class="article-meta">
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">person</span> Alex Johnson</span>
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">category</span> Technology & AI</span>
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">calendar_today</span> Mar 1, 2026</span>
                    </div>
                    <span class="status-warning">
                        <span class="material-symbols-outlined" style="font-size: 18px;">warning</span> 
                        10 Days Left to Comment
                    </span>
                </div>
                <div class="action-group">
                    <a href="review_article.php?id=101" class="btn-primary">Review & Comment</a>
                </div>
            </div>

            <div class="article-card">
                <div class="article-info">
                    <h3>Cybersecurity in 2026</h3>
                    <div class="article-meta">
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">person</span> Sarah Smith</span>
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">category</span> Technology & AI</span>
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">calendar_today</span> Feb 28, 2026</span>
                    </div>
                    <span class="status-warning">
                        <span class="material-symbols-outlined" style="font-size: 18px;">warning</span> 
                        9 Days Left to Comment
                    </span>
                </div>
                <div class="action-group">
                    <a href="review-article.php?id=102" class="btn-primary">Review & Comment</a>
                </div>
            </div>

            <div class="article-card">
                <div class="article-info">
                    <h3>Freshman Study Habits</h3>
                    <div class="article-meta">
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">person</span> David Lee</span>
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">category</span> Campus Life</span>
                        <span class="meta-item"><span class="material-symbols-outlined" style="font-size: 16px;">calendar_today</span> Feb 15, 2026</span>
                    </div>
                    <span class="status-ok">
                        <span class="material-symbols-outlined" style="font-size: 18px;">check_circle</span> 
                        Selected for Publication
                    </span>
                </div>
                <div class="action-group" style="justify-content: center; align-items: flex-end;">
                    <span style="color: var(--status-success); font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 5px;">
                        <span class="material-symbols-outlined" style="font-size: 18px;">lock</span>
                        Review Sealed
                    </span>
                    <span style="font-size: 12px; color: var(--text-light);">No further action required</span>
                </div>
            </div>

        </div>
    </div>
    <?php include '../../components/footer.php'; ?>
</body>
</html>