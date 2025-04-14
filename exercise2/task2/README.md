# Exercise 2 - Task 2: XML Profile Directory

This task involves creating a PHP script that parses an XML file containing user profiles and displays them in a modern, responsive web interface.

## Features
- Parses `LV2.xml` file containing 100 user profiles
- Each profile contains:
  - ID
  - First Name (ime)
  - Last Name (prezime)
  - Email
  - Gender (spol)
  - Profile Picture (slika)
  - Resume/Biography (zivotopis)

## Implementation
- Uses PHP's SimpleXML to parse the XML file
- Displays profiles in a responsive grid layout
- Each profile card includes:
  - Circular profile picture
  - Full name
  - Clickable email address
  - Resume/biography text
- Modern CSS styling with:
  - Card design and shadows
  - Hover effects
  - Responsive grid using CSS Grid
  - Clean typography
  - Color variables for easy customization

## File Structure
```
task2/
├── bin/
│   └── LV2.xml      # XML data file with 100 profiles
├── index.php        # Main script that parses and displays profiles
└── README.md        # Project documentation
```

## Usage
1. Place the files in a PHP-enabled web server
2. Access `index.php` through your web browser
3. The profiles will be displayed in a responsive grid layout

## Requirements
- PHP with SimpleXML support
- Web server (Apache, Nginx, etc.)
- Modern web browser
