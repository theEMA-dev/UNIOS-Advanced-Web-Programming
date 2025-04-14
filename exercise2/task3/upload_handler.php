<?php
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Create uploads directory if it doesn't exist
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

$encryption = new FileEncryption();

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    header('Location: index.php?error=Upload failed. Please try again.');
    exit;
}

$file = $_FILES['file'];

// Validate file type
if (!$encryption->validateFileType($file)) {
    header('Location: index.php?error=Invalid file type. Only PDF, JPEG, and PNG files are allowed.');
    exit;
}

try {
    // Read file content
    $fileContent = file_get_contents($file['tmp_name']);
    
    // Generate unique encrypted filename
    $encryptedName = uniqid('encrypted_', true) . '.enc';
    
    // Encrypt file content
    $encryptedContent = $encryption->encrypt($fileContent);
    
    // Save encrypted file
    file_put_contents('uploads/' . $encryptedName, $encryptedContent);
    
    // Save metadata
    $encryption->saveMetadata(
        $file['name'],
        $encryptedName,
        $file['type']
    );
    
    header('Location: index.php?success=File uploaded and encrypted successfully!');
    
} catch (Exception $e) {
    header('Location: index.php?error=An error occurred while processing the file.');
}
?>
