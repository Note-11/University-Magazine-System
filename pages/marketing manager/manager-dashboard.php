<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Manager Dashboard - Magazine System</title>
    <link rel="stylesheet" href="../../assests/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../assests/css/marketing_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>

    <?php include '../../components/header.php'; ?>

    <div class="main">
        <div class="header-controls">
            <div>
                <h1>Marketing Manager Overview</h1>
                <p class="section-subtitle">Monitor statistics, view exceptions, and download final publications across all faculties.</p>
            </div>
            
            <div class="filter-group">
                <select class="filter-select">
                    <option value="2025">Academic Year: 2025/2026</option>
                    <option value="2024">Academic Year: 2024/2025</option>
                </select>
            </div>
        </div>

        <div class="export-banner">
            <div class="export-banner-info">
                <h2>
                    <span class="material-symbols-outlined">folder_zip</span>
                    Final Publication Export
                </h2>
                <p>Download all selected articles and attachments for the current academic year in a single ZIP archive.</p>
            </div>
            <form action="../../backend/export_zip.php" method="POST">
                <input type="hidden" name="academic_year" value="2025">
                <button type="submit" class="btn-export">
                    <span class="material-symbols-outlined">download</span>
                    Download ZIP
                </button>
            </form>
        </div>

        <h2 class="section-title">Statistical Reports</h2>
        <div class="stats-grid three-col">
            <div class="stat-card">
                <h3 class="stat-card-title">Contributions by Faculty</h3>
                <div id="contributionsChart" class="chart-placeholder">
                    {put the chart here from backend}
                </div>
            </div>
            <div class="stat-card">
                <h3 class="stat-card-title">Contributors by Faculty</h3>
                <div id="contributorsChart" class="chart-placeholder">
                    {put the chart here from backend}
                </div>
            </div>
            <div class="stat-card">
                <h3 class="stat-card-title">Total Uploads</h3>
                <div class="stat-big-number">142</div>
                <p class="stat-subtitle">Across all university departments</p>
            </div>
        </div>

        <h2 class="section-title">Exception Reports</h2>
        <div class="exception-panel">
            <div class="exception-header">
                <span class="material-symbols-outlined">warning</span>
                <div>
                    <h3>Missing Coordinator Comments</h3>
                    <p>Articles pending feedback past the 14-day deadline.</p>
                </div>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Article Title</th>
                            <th>Faculty</th>
                            <th>Submitted Date</th>
                            <th>Overdue By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>The Ethics of Code</strong></td>
                            <td>Faculty of IT</td>
                            <td>Feb 10, 2026</td>
                            <td class="text-overdue">10 Days</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section-header-flex">
            <h2 class="section-title">All Selected Contributions</h2>
            <span class="section-subtitle">Read-only view for published articles</span>
        </div>
        
        <div class="article-stack">
            <div class="article-card">
                <div class="article-info">
                    <div class="article-title-row">
                        <span class="faculty-badge">Faculty of IT</span>
                        <h3>Freshman Study Habits</h3>
                    </div>
                    <div class="article-meta">
                        <span class="meta-item"><span class="material-symbols-outlined">person</span> David Lee</span>
                        <span class="meta-item"><span class="material-symbols-outlined">calendar_today</span> Feb 15, 2026</span>
                    </div>
                    <span class="status-ok">
                        <span class="material-symbols-outlined">check_circle</span> Approved for Publication
                    </span>
                </div>
                <div class="action-group">
                    <a href="../../backend/read_article.php?id=098" target="_blank" class="btn-secondary">
                        <span class="material-symbols-outlined">visibility</span> Read Article
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../components/footer.php'; ?>

</body>
</html>