<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Magazine System</title>
    <link rel="stylesheet" href="/University-Magazine-System-main/assets/css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/University-Magazine-System-main/assets/css/layout.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <header>
        <div class="logosec">
            <div class="logo">UniMag System</div>
            <span class="material-symbols-outlined menuicn" id="menuicn">menu</span>
        </div>

        <div class="message">

            <div class="last-login-container">
                <span class="login-label">Last login:</span>
                <span class="login-timestamp">21 Feb 2026, <br> 08:00 AM</span>
            </div>
            
            <div class="notification-icon">
                <div class="circle"></div>
                <span class="material-symbols-outlined notif-icon">notifications</span>
            </div>

            <div class="user-profile-container">
                <button class="profile-btn" id="profileDropdownBtn">
                    <span class="material-symbols-outlined profile-icon">account_circle</span>
                    <span class="material-symbols-outlined" style="font-size: 18px;">expand_more</span>
                </button>

                <div class="profile-dropdown-menu" id="profileDropdownMenu">
                    <div class="dropdown-header">
                        <strong>My Account</strong>
                    </div>
                    <a href="#" class="dropdown-item">
                        <span class="material-symbols-outlined">person</span> View Profile
                    </a>
                    <hr class="dropdown-divider">
                    <a href="../../auth/logout.php" class="dropdown-item text-danger">
                        <span class="material-symbols-outlined">logout</span> Logout
                    </a>
                </div>
            </div>
        </div>
    </header>
</body>
<script >
    document.addEventListener('DOMContentLoaded', function() {
    const profileBtn = document.getElementById('profileDropdownBtn');
    const dropdownMenu = document.getElementById('profileDropdownMenu');

    if (profileBtn && dropdownMenu) {
        
        profileBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        window.addEventListener('click', function(event) {
            if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }
    });
</script>
</html>