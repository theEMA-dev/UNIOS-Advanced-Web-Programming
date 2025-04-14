<?php
require_once 'functions.php';

if (!isset($_GET['file'])) {
    header('Location: index.php?error=No file specified.');
    exit;
}

$encryption = new FileEncryption();
$encryptedName = $_GET['file'];

// Get file metadata
$metadata = $encryption->getFileMetadata($encryptedName);
if (!$metadata) {
    header('Location: index.php?error=File not found.');
    exit;
}

// Check if encrypted file exists
$encryptedPath = 'uploads/' . $encryptedName;
if (!file_exists($encryptedPath)) {
    header('Location: index.php?error=File not found.');
    exit;
}

try {
    // Read encrypted content
    $encryptedContent = file_get_contents($encryptedPath);
    
    // Decrypt content
    $decryptedContent = $encryption->decrypt($encryptedContent);
    
    if ($decryptedContent === false) {
        throw new Exception('Decryption failed');
    }
    
    // Set appropriate headers for download
    header('Content-Type: ' . $metadata['file_type']);
    header('Content-Disposition: attachment; filename="' . $metadata['original_name'] . '"');
    header('Content-Length: ' . strlen($decryptedContent));
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
    
    // Output decrypted content
    echo $decryptedContent;
    exit;
    
} catch (Exception $e) {
    header('Location: index.php?error=Error decrypting file.');
    exit;
}
?>
