# Exercise 2 - Task 3: Secure File Upload System

This folder contains a secure file upload system that encrypts documents and images before storage and decrypts them for download.

## Requirements

1. PHP 8.2 or higher
2. Web server (e.g., PHP's built-in development server)
3. Write permissions for the uploads directory

## Features

1. File upload support for:
   - PDF documents
   - JPEG images
   - PNG images
2. File encryption using XOR encryption with SHA-256 key hashing
3. Secure file storage with metadata tracking
4. Automated decryption during download

## Script Structure

### Files

- `index.php` - Main interface for file upload and listing
- `functions.php` - Core encryption/decryption functionality
- `upload_handler.php` - Handles file uploads and encryption
- `download.php` - Handles file decryption and downloads
- `uploads/` - Directory for encrypted files and metadata
- `bin/` - Test files directory

### Components

1. FileEncryption Class:
   - Encryption and decryption methods
   - File type validation
   - Metadata management
   - File listing functionality

2. Upload Process:
   - File type validation
   - Content encryption
   - Metadata storage
   - Secure file storage

3. Download Process:
   - Metadata retrieval
   - Content decryption
   - Original file restoration
   - Secure file serving

## Usage

1. Start the PHP development server:
```bash
php -S localhost:8000
```

2. Access the application:
- Open http://localhost:8000 in a web browser
- Use the upload form to select and upload files
- View the list of uploaded files
- Download and automatically decrypt files

## File Storage

Encrypted files are stored in the `uploads` directory with:
- Unique encrypted filenames (format: encrypted_[unique_id].enc)
- Metadata file (metadata.json) tracking:
  - Original filename
  - Encrypted filename
  - File type
  - Upload date

## Test Files

Sample files for testing are provided in the `bin` directory:
- test_document.pdf
- test_image.jpg
