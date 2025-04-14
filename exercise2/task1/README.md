# Exercise 2 - Task 1: Database Backup Script

This folder contains a script for backing up MySQL databases with automatic ZIP compression.

## Requirements

1. PHP with mysqli extension enabled
2. PowerShell (for ZIP compression)
3. MySQL/MariaDB server
4. Command-line execution permissions

## Usage

Run the script from command line:
```bash
php backup_script.php database_name
```

## Script Structure

### Files

- `backup_script.php` - Main backup script
- `config.php` - Database configuration
- `backups/` - Directory for backup files (created automatically)

### Output Format

The script generates SQL INSERT statements in the following format:
```sql
INSERT INTO `table_name` (`column1`, `column2`, `column3`) 
VALUES ('value1', 'value2', 'value3');
```

### Backup Process

1. Connects to the specified database
2. Retrieves all tables
3. For each table:
   - Gets column names
   - Generates INSERT statements for all rows
4. Saves statements to a timestamped .txt file
5. Compresses the file using PowerShell's Compress-Archive
6. Cleans up temporary files

## Output Files

Backup files are saved in the `backups` directory with the naming format:
- `backup_YYYY-MM-DD_HH-mm-ss.zip`

Each ZIP file contains a text file with the same name containing SQL INSERT statements.
