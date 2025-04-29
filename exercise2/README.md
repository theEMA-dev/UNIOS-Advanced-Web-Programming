# PHP Scripts Collection

This folder contains three separate PHP tasks demonstrating different aspects of file and data handling.

## [Task 1 - Database Backup System](task1/)
A script that performs automated database backups with the following features:
- Scheduled database backups
- ZIP compression of backup files
- Configuration-based setup
- Backup rotation and cleanup

### Key Files:
- `backup_script.php` - Main backup script
- `config.php` - Configuration settings

## [Task 2 - XML Processing](task2/)
XML file manipulation script showcasing:
- XML parsing and creation
- Data transformation
- File handling

### Key Files:
- `index.php` - Main XML processing script
- `bin/LV2.xml` - Sample XML file

## [Task 3 - Secure File Upload System](task3/)
A secure file upload system with encryption featuring:
- File upload handling
- File encryption/decryption
- Secure download mechanism
- Metadata management

### Key Files:
- `index.php` - Upload interface
- `upload_handler.php` - File processing logic
- `download.php` - Secure file download
- `functions.php` - Helper functions

## Requirements
- PHP 8.2 or higher
- MySQL/MariaDB (for Task 1)
- PHP Extensions:
  - zip
  - pdo_mysql
  - openssl

## Directory Structure
```
.
├── task1/              # Database Backup System
│   ├── backups/       # Backup storage
│   └── database/      # Database schema
├── task2/             # XML Processing
│   └── bin/          # XML files
└── task3/             # File Upload System
    ├── bin/          # Sample files
    └── uploads/      # Encrypted uploads
```

## Usage
Each task has its own README with specific setup instructions and requirements.
