<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/LMS/includes/db.php');

// ADD BOOK
if (isset($_POST['add_book'])) {
    $stmt = $conn->prepare("INSERT INTO biblio (title, author, isbn) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $_POST['title'], $_POST['author'], $_POST['isbn']);
    $stmt->execute();
    header("Location: /LMS/admin/modules/cataloguing/advanced-entry.php?msg=added");
}

// UPDATE BOOK
if (isset($_POST['update_book'])) {
    $stmt = $conn->prepare("UPDATE biblio SET title=?, author=?, isbn=? WHERE biblio_id=?");
    $stmt->bind_param("sssi", $_POST['title'], $_POST['author'], $_POST['isbn'], $_POST['biblio_id']);
    $stmt->execute();
    header("Location: /LMS/admin/modules/cataloguing/manage-books.php?msg=updated");
}

// DELETE BOOK
if (isset($_GET['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM biblio WHERE biblio_id=?");
    $stmt->bind_param("i", $_GET['delete_id']);
    $stmt->execute();
    header("Location: /LMS/admin/modules/cataloguing/manage-books.php?msg=deleted");
}
exit();
?>