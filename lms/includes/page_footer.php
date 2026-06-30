</div> </div> </div> ```

### 3. Update your pages to use the wrapper
Now, update `manage-books.php` and `advanced-entry.php` to look exactly like this:

```php
<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/LMS/includes/page_header.php'); 
?>

<h1>Title of this page</h1>
<p>The content will now be perfectly aligned with every other page.</p>

<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/LMS/includes/page_footer.php'); 
?>