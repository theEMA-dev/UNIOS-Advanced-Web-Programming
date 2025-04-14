# Database Structure

This folder contains the database schema for the Graduate Thesis Management System.

## Setup

1. Create a MySQL database named `thesis`
2. Execute the schema.sql file to create the required table
3. Make sure your MySQL credentials match those in the Database.php class:
   - Host: localhost
   - User: root
   - Password: test
   - Database: thesis

## Table Structure

### graduate_theses

| Column               | Type         | Description                    |
|---------------------|--------------|--------------------------------|
| id                  | INT          | Auto-incrementing primary key  |
| work_name           | VARCHAR(255) | Title of the thesis           |
| work_text          | TEXT        | Full text/description         |
| work_link          | VARCHAR(255) | URL to the thesis page        |
| identification_number| VARCHAR(50) | Thesis identification number  |

Note: The `work_link` column has a unique index to prevent duplicate entries.
