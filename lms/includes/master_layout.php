<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f8fafc; display: flex; }
        /* Sidebar container */
        .sidebar-wrapper { width: 260px; height: 100vh; position: fixed; }
        /* Main content area */
        .content-area { margin-left: 260px; width: calc(100% - 260px); padding: 20px; }
        /* The Card - This fixes your alignment issues */
        .page-card { background: white; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; width: 100%; }
    </style>
</head>
<body>
    <div class="sidebar-wrapper"><?php include('sidebar.php'); ?></div>
    <div class="content-area">
        <?php include('topbar.php'); ?>
        <div class="page-card">