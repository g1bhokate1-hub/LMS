<?php 
include('../../../includes/header.php'); 
include('../../../includes/db.php'); 

// Fetch all bibliographic records
$query = "SELECT * FROM biblio ORDER BY biblio_id DESC";
$result = mysqli_query($conn, $query);
?>

<div class="wrapper" style="display: flex; min-height: 100vh;">
    <?php include('../../../includes/sidebar.php'); ?>

    <div class="main-content" style="flex: 1; margin-left: 260px; padding: 20px; background: #f8fafc;">
        <?php include('../../../includes/topbar.php'); ?>
        
        <div class="content">
            <div class="glass-card" style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <div class="page-header" style="margin-bottom: 20px;">
                    <h1>Manage Library Collection</h1>
                    <p>Edit or remove existing catalog records.</p>
                </div>

                <form method="GET" action="manage-books.php" style="margin-bottom: 20px;">
    <input type="text" name="search" placeholder="Search by title or author..." 
           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" 
           style="padding: 10px; width: 300px; border-radius: 8px; border: 1px solid #ccc;">
    <button type="submit" style="padding: 10px 20px; border-radius: 8px ">Search</button>
</form>

<?php
// Update the query to handle search
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$whereClause = $search ? "WHERE title LIKE '%$search%' OR author LIKE '%$search%'" : "";
$query = "SELECT * FROM biblio $whereClause ORDER BY biblio_id DESC";
$result = mysqli_query($conn, $query);
?>
                <table class="dashboard-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f1f5f9; text-align: left;">
                            <th style="padding: 12px;">Title</th>
                            <th style="padding: 12px;">Author</th>
                            <th style="padding: 12px;">ISBN</th>
                            <th style="padding: 12px;">Status</th>
                            <th style="padding: 12px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tbody>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;"><?php echo htmlspecialchars($row['title']); ?></td>
        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;"><?php echo htmlspecialchars($row['author']); ?></td>
        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;"><?php echo htmlspecialchars($row['isbn']); ?></td>
        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">
            <span class="badge"><?php echo isset($row['status']) ? htmlspecialchars($row['status']) : 'Available'; ?></span>
        </td>
        <td style="padding: 12px; border-bottom: 1px solid #e2e8f0;">
            <a href="edit-book.php?id=<?php echo $row['biblio_id']; ?>" style="color: #2563eb; margin-right: 10px;">Edit</a>
            <a href="/LMS/admin/controllers/BooksController.php?delete_id=<?php echo $row['biblio_id']; ?>" 
               style="color: #ef4444;" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('../../../includes/footer.php'); ?>