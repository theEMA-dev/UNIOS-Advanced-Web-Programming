<?php
require_once 'config.php';

// Check if database name is provided as argument
if ($argc != 2) {
    die("Usage: php backup_script.php <database_name>\n");
}

$database = $argv[1];

// Create backups directory if it doesn't exist
if (!file_exists('backups')) {
    mkdir('backups');
}

try {
    // Connect to MySQL using mysqli
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, $database);

    // Check connection
    if ($mysqli->connect_error) {
        throw new Exception("Connection failed: " . $mysqli->connect_error);
    }

    // Get all tables in the database
    $tables = [];
    $result = $mysqli->query("SHOW TABLES");
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        $tables[] = $row[0];
    }
    
    $date = date('Y-m-d_H-i-s');
    $filename = "backups/backup_{$date}.txt";
    $zipname = "backups/backup_{$date}.zip";
    
    // Open file for writing
    $file = fopen($filename, 'w');
    
    // Process each table
    foreach ($tables as $table) {
        // Get all rows from the table
        $result = $mysqli->query("SELECT * FROM `{$table}`");
        
        // Get column names
        $columns = [];
        $fields = $result->fetch_fields();
        foreach ($fields as $field) {
            $columns[] = $field->name;
        }
        
        // Generate INSERT statements for each row
        while ($row = $result->fetch_assoc()) {
            $values = array_map(function($value) use ($mysqli) {
                if ($value === null) return 'NULL';
                return "'" . $mysqli->real_escape_string($value) . "'";
            }, array_values($row));
            
            $sql = "INSERT INTO `{$table}` (`" . 
                   implode("`, `", $columns) . 
                   "`) VALUES (" . implode(", ", $values) . ");\n";
            
            fwrite($file, $sql);
        }
        
        fwrite($file, "\n"); // Add spacing between tables
        $result->free();
    }
    
    fclose($file);
    
    // Create ZIP archive using PowerShell
    $command = sprintf('powershell -Command "Compress-Archive -Path \"%s\" -DestinationPath \"%s\" -Force"', $filename, $zipname);
    $output = [];
    $returnValue = 0;
    
    exec($command, $output, $returnValue);
    
    if ($returnValue === 0) {
        // Delete the temporary .txt file
        unlink($filename);
        
        echo "Backup completed successfully!\n";
        echo "Backup saved to: {$zipname}\n";
    } else {
        throw new Exception("Failed to create zip file. Error: " . implode("\n", $output));
    }
    
} catch (Exception $e) {
    die("Error: " . $e->getMessage() . "\n");
} finally {
    if (isset($mysqli)) {
        $mysqli->close();
    }
}
