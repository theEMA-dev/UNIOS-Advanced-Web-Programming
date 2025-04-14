# Exercise 1: Graduate Thesis Management System

A PHP application that scrapes and manages thesis data from stup.ferit.hr.

## Project Structure

```
exercise1/
├── database/           # Database related files
│   ├── README.md      # Database documentation
│   └── schema.sql     # Database schema
├── src/               # Source code
│   ├── interfaces/    # PHP interfaces
│   │   └── iRadio.php # Base interface for thesis management
│   └── classes/       # PHP classes
│       ├── Database.php       # Database connection handling
│       ├── GraduateThesis.php # Thesis management class
│       └── Scraper.php       # Web scraping functionality
└── index.php          # Main application file
```

## Requirements

- PHP 8.2 or higher
- MySQL/MariaDB
- PHP Extensions:
  - mysqli
  - curl

## Setup

1. Database Setup:
   ```bash
   cd database
   mysql -u root -ptest < schema.sql
   ```

2. Run the Application:
   ```bash
   php index.php
   ```

## Features

- Scrapes thesis data from stup.ferit.hr (pages 2-6)
- Stores thesis information in MySQL database
- Prevents duplicate entries
- Displays stored thesis data

## Implementation Details

- Uses iRadio interface for standardized thesis management
- GraduateThesis class implements create, save, and read operations
- Database class handles MySQL connections and queries
- Scraper class handles web scraping with proper error handling
