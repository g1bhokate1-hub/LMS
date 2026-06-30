<?php
// admin/dashboard.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ── CONNECT TO DATABASE ──────────────────────────────────────────────
$possible_db_paths = [
    __DIR__ . '/includes/db.php',
    __DIR__ . '/../includes/db.php',
    __DIR__ . '/db.php'
];

$db_loaded = false;
foreach ($possible_db_paths as $path) {
    if (file_exists($path)) {
        require_once($path);
        $db_loaded = true;
        break;
    }
}

// ── GET LIVE COUNTS ──────────────────────────────────────────────────
$count_biblio  = 0;
$count_items   = 0;

if (isset($conn)) {
    // Tally biblio table
    $res_biblio = @mysqli_query($conn, "SELECT COUNT(*) as total FROM biblio");
    if ($res_biblio) { 
        $row = mysqli_fetch_assoc($res_biblio); 
        $count_biblio = $row['total']; 
    }

    // Tally items table
    $res_items = @mysqli_query($conn, "SELECT COUNT(*) as total FROM items");
    if ($res_items) { 
        $row = mysqli_fetch_assoc($res_items); 
        $count_items = $row['total']; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibTool LMS - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        
        /* Fixed Left Sidebar Container */
        .koha-sidebar {
            width: 260px;
            height: 100vh;
            background-color: #0b1325;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            box-sizing: border-box;
            z-index: 999;
        }
        .sidebar-brand h2 {
            color: #ffffff;
            margin: 0;
            padding: 0 24px 20px 24px;
            font-size: 1.4rem;
            border-bottom: 1px solid #1e293b;
        }
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
        }
        .sidebar-menu li {
            margin: 4px 0;
        }
        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.2s;
        }
        .menu-link:hover, .menu-link.active {
            color: #ffffff;
            background-color: #1e293b;
        }
        .menu-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }
        .menu-section {
            display: block;
            padding: 15px 24px 5px 24px;
            color: #64748b;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .submenu-link {
            display: block;
            padding: 8px 24px 8px 45px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .submenu-link:hover {
            color: #3b82f6;
        }

        /* Right Content Area */
        .main-content-area {
            margin-left: 260px;
            padding: 40px;
            box-sizing: border-box;
        }
        .dashboard-header h1 {
            font-size: 1.8rem;
            margin: 0 0 5px 0;
            color: #0f172a;
        }
        .dashboard-header p {
            margin: 0 0 30px 0;
            color: #64748b;
            font-size: 0.95rem;
        }

        /* Stat Grid Layout */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
        }
        .stat-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .stat-card.blue { border-left: 5px solid #2563eb; }
        .stat-card.green { border-left: 5px solid #10b981; }
        
        .stat-icon {
            font-size: 2.2rem;
        }
        .stat-card.blue .stat-icon { color: #2563eb; }
        .stat-card.green .stat-icon { color: #10b981; }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            color: #0f172a;
        }
        .stat-label {
            margin: 2px 0 0 0;
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Quick Launch Box */
        .launchpad-box {
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
        .launchpad-box h2 {
            font-size: 1.2rem;
            margin: 0 0 20px 0;
            color: #0f172a;
        }
        .launchpad-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #334155;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .launchpad-btn:hover {
            background: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
        }
    </style>
</head>
<body>

    <div class="koha-sidebar">
        <div class="sidebar-brand">
            <h2><i class="fas fa-university" style="color: #3b82f6; margin-right: 8px;"></i>LibTool LMS</h2>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="/LMS/admin/dashboard.php" class="menu-link active">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            
            <span class="menu-section">Cataloguing</span>
            <li>
                <a href="/LMS/admin/modules/cataloguing/advanced-entry.php" class="submenu-link">
                    <i class="fas fa-plus-circle"></i> Advanced Entry
                </a>
            </li>
            <li>
                <a href="#" class="submenu-link" style="opacity: 0.5; cursor: not-allowed;">
                    <i class="fas fa-tasks"></i> Manage Books
                </a>
            </li>

            <span class="menu-section">Circulation</span>
            <li><a href="#" class="submenu-link" style="opacity: 0.5; cursor: not-allowed;"><i class="fas fa-hand-holding"></i> Issue</a></li>
            <li><a href="#" class="submenu-link" style="opacity: 0.5; cursor: not-allowed;"><i class="fas fa-undo"></i> Return</a></li>
        </ul>
    </div>

    <div class="main-content-area">
        
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <p>System Desk Status Overview | <?php echo date('l, F d, Y'); ?></p>
        </div>

        <div class="metrics-grid">
            
            <div class="stat-card blue">
                <div class="stat-icon"><i class="fas fa-book"></i></div>
                <div>
                    <h3 class="stat-number"><?php echo $count_biblio; ?></h3>
                    <p class="stat-label">Catalog Records</p>
                </div>
            </div>

            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-barcode"></i></div>
                <div>
                    <h3 class="stat-number"><?php echo $count_items; ?></h3>
                    <p class="stat-label">Total Item Copies</p>
                </div>
            </div>

        </div>

        <div class="launchpad-box">
            <h2><i class="fas fa-rocket" style="color: #3b82f6; margin-right: 8px;"></i> Library Quick Access</h2>
            <a href="/LMS/admin/modules/cataloguing/advanced-entry.php" class="launchpad-btn">
                <i class="fas fa-plus-circle" style="color: #2563eb;"></i> Go to Advanced MARC Entry
            </a>
        </div>

    </div>

</body>
</html>