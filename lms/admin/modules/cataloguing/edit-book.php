<?php 
include('../../../includes/header.php'); 
include('../../../includes/db.php'); 

// Fetch the existing book data
$id = intval($_GET['id']);
$query = "SELECT * FROM biblio WHERE biblio_id = $id";
$result = mysqli_query($conn, $query);
$book = mysqli_fetch_assoc($result);
?>

<div class="wrapper">
    <?php include('../../../includes/sidebar.php'); ?>

    <div class="main-content" style="
    body { margin: 0; padding: 0; }
    
    .main-content {
        display: flex;
        flex-direction: column;
        padding-top: 0 !important;
        margin-top: 0 !important;
    }

    .glass-card {
        margin-top: 20px !important; /* Control the gap here */
        margin-left: 20px;
        margin-right: 20px;
    }
    flex: 1; 
    margin-left: 260px; 
    padding: 0;           /* Remove global padding */
    margin-top: 0;        /* Force to top */
    background: #f8fafc; 
    min-height: 100vh;">
        <?php include('../../../includes/topbar.php'); ?>
        
        <div class="content-container" style="padding: 30px; max-width: 800px; margin: 0 auto;">
            <div class="glass-card" style="background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(12px); border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.25); padding: 40px;">
                
                <div class="page-header" style="margin-bottom: 30px;">
                    <h1 style="font-size: 2rem; color: #1a1a1a;">Edit Record</h1>
                    <p style="color: #666;">Updating: <strong><?php echo htmlspecialchars($book['title']); ?></strong></p>
                </div>

                <form action="../../controllers/BooksController.php" method="POST">
                    <input type="hidden" name="biblio_id" value="<?php echo $book['biblio_id']; ?>">
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Title</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" 
                               style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Author</label>
                        <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" 
                               style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ccc;">
                    </div>

                    <button type="submit" name="update_book" 
                            style="background: #007aff; color: #fff; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer;">
                        Update Record
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../../../includes/footer.php'); ?>