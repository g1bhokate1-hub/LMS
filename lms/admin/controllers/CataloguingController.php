<?php
// admin/controllers/CataloguingController.php

// Connect to the database
include('../../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_marc_record'])) {
    
    // 1. Collect and sanitize General Book Metadata (Biblio Table)
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $author = mysqli_real_escape_string($conn, $_POST['marc_100_a']);
    $isbn   = mysqli_real_escape_string($conn, $_POST['marc_020_a']);
    $issn   = mysqli_real_escape_string($conn, $_POST['marc_022_a']);
    $ddc    = mysqli_real_escape_string($conn, $_POST['marc_082_a']);
    
    // Convert the entire form data array into a text string to preserve all raw MARC tags
    $raw_marc = mysqli_real_escape_string($conn, json_encode($_POST));

    // Start a transaction so that if one table fails, both stay clean
    mysqli_begin_transaction($conn);

    try {
        // 2. Insert record into `biblio` table
        $query_biblio = "INSERT INTO biblio (title, author, isbn, issn, ddc, raw_marc) 
                         VALUES ('$title', '$author', '$isbn', '$issn', '$ddc', '$raw_marc')";
        
        if (!mysqli_query($conn, $query_biblio)) {
            throw new Exception("Error saving to biblio catalog: " . mysqli_error($conn));
        }
        
        // Grab the exact unique ID generated for this book
        $biblio_id = mysqli_insert_id($conn);

        // 3. Collect and sanitize Copy Specific Fields (Items Table)
        $accession_number = mysqli_real_escape_string($conn, $_POST['accession_number']);
        $barcode          = mysqli_real_escape_string($conn, $_POST['barcode']);
        $call_number      = mysqli_real_escape_string($conn, $_POST['call_number']);
        $location         = mysqli_real_escape_string($conn, $_POST['location']);
        $rack             = mysqli_real_escape_string($conn, $_POST['rack']);
        $shelf            = mysqli_real_escape_string($conn, $_POST['shelf']);
        $status           = mysqli_real_escape_string($conn, $_POST['status']);
        $condition        = mysqli_real_escape_string($conn, $_POST['condition']);
        $vendor           = mysqli_real_escape_string($conn, $_POST['vendor']);
        $price            = !empty($_POST['price']) ? floatval($_POST['price']) : 0.00;
        $acquisition_date = !empty($_POST['acquisition_date']) ? mysqli_real_escape_string($conn, $_POST['acquisition_date']) : date('Y-m-d');

        // 4. Insert copy record into `items` table using the $biblio_id link
        $query_item = "INSERT INTO items (biblio_id, barcode, accession_number, call_number, location, rack, shelf, status, `condition`, vendor, price, acquisition_date) 
                       VALUES ('$biblio_id', '$barcode', '$accession_number', '$call_number', '$location', '$rack', '$shelf', '$status', '$condition', '$vendor', '$price', '$acquisition_date')";
        
        if (!mysqli_query($conn, $query_item)) {
            throw new Exception("Error saving to items catalog: " . mysqli_error($conn));
        }

        // Everything succeeded, commit to the database!
        mysqli_commit($conn);
        
        // FIXED: Changed to cataloguing with double 'g'
        echo "<script>alert('Success: Book successfully saved to library database!'); window.location.href='../modules/cataloguing/advanced-entry.php';</script>";

    } catch (Exception $e) {
        // Rollback the transaction if anything failed
        mysqli_rollback($conn);
        // FIXED: Changed to cataloguing with double 'g'
        echo "<script>alert('Failed to save record: " . addslashes($e->getMessage()) . "'); window.location.href='../modules/cataloguing/advanced-entry.php';</script>";
    }
} else {
    // FIXED: Changed to cataloguing with double 'g'
    header("Location: ../modules/cataloguing/advanced-entry.php");
    exit();
}
?>

<?php
// Start session for status alerts
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration connection matrix
require_once(__DIR__ . '/../../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_marc_record'])) {
    
    try {
        // Begin structural database transaction to ensure both records insert perfectly
        $conn->beginTransaction();

        // 1. Sanitize and Extract Bibliographic Metadata (MARC Fields)
        $resource_type    = trim($_POST['marc_000_type'] ?? 'Book');
        $fixed_length_data = trim($_POST['marc_008'] ?? '');
        $isbn             = trim($_POST['marc_020_a'] ?? '');
        $issn             = trim($_POST['marc_022_a'] ?? '');
        $language_code    = trim($_POST['marc_041_a'] ?? 'eng');
        $ddc_class        = trim($_POST['marc_082_a'] ?? '');
        $author_relation  = trim($_POST['marc_082_b'] ?? '');
        
        $author_name      = trim($_POST['marc_100_a'] ?? '');
        $author_dates     = trim($_POST['marc_100_d'] ?? '');
        $author_role      = trim($_POST['marc_100_e'] ?? '');
        
        $title            = trim($_POST['marc_245_a'] ?? '');
        $subtitle         = trim($_POST['marc_245_b'] ?? '');
        $responsibility   = trim($_POST['marc_245_c'] ?? '');
        $variant_title    = trim($_POST['marc_246_a'] ?? '');
        $edition          = trim($_POST['marc_250_a'] ?? '');
        
        $pub_place        = trim($_POST['marc_264_a'] ?? '');
        $publisher        = trim($_POST['marc_264_b'] ?? '');
        $pub_year         = trim($_POST['marc_264_c'] ?? '');
        
        $extent           = trim($_POST['marc_300_a'] ?? '');
        $phys_details     = trim($_POST['marc_300_b'] ?? '');
        $dimensions       = trim($_POST['marc_300_c'] ?? '');
        $rda_content      = trim($_POST['marc_336_a'] ?? 'text');
        $rda_media        = trim($_POST['marc_337_a'] ?? 'unmediated');
        $rda_carrier      = trim($_POST['marc_338_a'] ?? 'volume');
        $series           = trim($_POST['marc_490_a'] ?? '');
        $general_note     = trim($_POST['marc_500_a'] ?? '');
        $summary_note     = trim($_POST['marc_520_a'] ?? '');
        
        $subj_personal    = trim($_POST['marc_600_a'] ?? '');
        $subj_corporate   = trim($_POST['marc_610_a'] ?? '');
        $subj_topical     = trim($_POST['marc_650_a'] ?? '');
        $subj_geographic  = trim($_POST['marc_651_a'] ?? '');

        // 2. Sanitize and Extract Physical Holding Inventory Details
        $accession_number = trim($_POST['accession_number'] ?? '');
        $barcode          = trim($_POST['barcode'] ?? '');
        $call_number      = trim($_POST['call_number'] ?? '');
        $location         = trim($_POST['location'] ?? 'Main Central Library');
        $rack             = trim($_POST['rack'] ?? '');
        $shelf            = trim($_POST['shelf'] ?? '');
        $status           = trim($_POST['status'] ?? 'Available');
        $condition        = trim($_POST['condition'] ?? 'Good');
        $vendor           = trim($_POST['vendor'] ?? '');
        $price            = trim($_POST['price'] ?? '0.00');
        $acquisition_date = trim($_POST['acquisition_date'] ?? date('Y-m-d'));

        // Basic validation check for mandatory parameters
        if (empty($title) || empty($accession_number) || empty($barcode)) {
            throw new Exception("Missing crucial attributes: Title, Accession Number, and Barcode are required.");
        }

        // 3. STEP A: Insert Master Record into your Bibliographic Table
        $query = "INSERT INTO biblio (resource_type, isbn, ...
        ) VALUES (
            :resource_type, :fixed_length_data, :isbn, :issn, :language_code, :ddc_classification, :author_relation,
            :author_name, :author_dates, :author_role, :title, :subtitle, :statement_of_responsibility, :variant_title, :edition,
            :publication_place, :publisher, :publication_year, :extent, :physical_details, :dimensions,
            :rda_content, :rda_media, :rda_carrier, :series_statement, :general_note, :summary_note,
            :subject_personal, :subject_corporate, :subject_topical, :subject_geographic, NOW()
        )";

        $stmt = $conn->prepare($biblio_sql);
        $stmt->execute([
            ':resource_type' => $resource_type, ':fixed_length_data' => $fixed_length_data, ':isbn' => $isbn, ':issn' => $issn,
            ':language_code' => $language_code, ':ddc_classification' => $ddc_class, ':author_relation' => $author_relation,
            ':author_name' => $author_name, ':author_dates' => $author_dates, ':author_role' => $author_role,
            ':title' => $title, ':subtitle' => $subtitle, ':statement_of_responsibility' => $responsibility,
            ':variant_title' => $variant_title, ':edition' => $edition, ':publication_place' => $pub_place,
            ':publisher' => $publisher, ':publication_year' => $pub_year, ':extent' => $extent,
            ':physical_details' => $phys_details, ':dimensions' => $dimensions, ':rda_content' => $rda_content,
            ':rda_media' => $rda_media, ':rda_carrier' => $rda_carrier, ':series_statement' => $series,
            ':general_note' => $general_note, ':summary_note' => $summary_note, ':subject_personal' => $subj_personal,
            ':subject_corporate' => $subj_corporate, ':subject_topical' => $subj_topical, ':subject_geographic' => $subj_geographic
        ]);

        // Get the structural Auto-Increment foreign key reference id
        $biblio_id = $conn->lastInsertId();

        // 4. STEP B: Insert Copy Asset Item into your Physical Inventory Holdings Table
        $holding_sql = "INSERT INTO book_items (
            bibliographic_id, accession_number, barcode, call_number, location, rack, shelf, status, `condition`, vendor, price, acquisition_date
        ) VALUES (
            :bibliographic_id, :accession_number, :barcode, :call_number, :location, :rack, :shelf, :status, :condition, :vendor, :price, :acquisition_date
        )";

        $stmt_holding = $conn->prepare($holding_sql);
        $stmt_holding->execute([
            ':bibliographic_id' => $biblio_id,
            ':accession_number' => $accession_number,
            ':barcode'          => $barcode,
            ':call_number'      => $call_number,
            ':location'         => $location,
            ':rack'             => $rack,
            ':shelf'            => $shelf,
            ':status'           => $status,
            ':condition'        => $condition,
            ':vendor'           => $vendor,
            ':price'            => $price,
            ':acquisition_date' => $acquisition_date
        ]);

        // Commit transaction fields safely to the disk engine
        $conn->commit();

        $_SESSION['flash_success'] = "MARC Bibliographic asset record & item copy catalogued successfully!";
        header("Location: /LMS/admin/modules/cataloguing/advanced-entry.php");
        exit();

    } catch (Exception $e) {
        // Rollback all entries cleanly if a failure happens to prevent duplicate or corrupted data
        if ($conn->inTransaction()) {
            $conn->rollBack();
        }
        $_SESSION['flash_error'] = "Cataloguing Failure: " . $e->getMessage();
        header("Location: /LMS/admin/modules/cataloguing/advanced-entry.php");
        exit();
    }
} else {
    // Malicious or direct access attempts handling redirect
    header("Location: /LMS/admin/modules/cataloguing/advanced-entry.php");
    exit();
}