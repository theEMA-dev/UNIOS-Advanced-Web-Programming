<?php
require_once 'functions.php';
$encryption = new FileEncryption();
$files = $encryption->getAllFiles();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure File Upload System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .upload-form { background: #f5f5f5; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
        .file-list { background: #fff; padding: 20px; border-radius: 5px; border: 1px solid #ddd; }
        .file-item { padding: 10px; border-bottom: 1px solid #eee; }
        .file-item:last-child { border-bottom: none; }
        .error { color: red; margin: 10px 0; }
        .success { color: green; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Secure File Upload System</h1>
        
        <div class="upload-form">
            <h2>Upload New File</h2>
            <form action="upload_handler.php" method="post" enctype="multipart/form-data">
                <p>Allowed file types: PDF, JPEG, PNG</p>
                <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png">
                <input type="submit" value="Upload File">
            </form>
            <?php
            if (isset($_GET['error'])) {
                echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            if (isset($_GET['success'])) {
                echo '<p class="success">' . htmlspecialchars($_GET['success']) . '</p>';
            }
            ?>
        </div>

        <div class="file-list">
            <h2>Uploaded Files</h2>
            <?php if (empty($files)): ?>
                <p>No files uploaded yet.</p>
            <?php else: ?>
                <?php foreach ($files as $file): ?>
                    <div class="file-item">
                        <strong><?php echo htmlspecialchars($file['original_name']); ?></strong>
                        <br>
                        Uploaded: <?php echo htmlspecialchars($file['upload_date']); ?>
                        <br>
                        <a href="download.php?file=<?php echo urlencode($file['encrypted_name']); ?>">Download</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
