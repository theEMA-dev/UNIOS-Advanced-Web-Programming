<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Directory</title>
    <style>
        :root {
            --primary-color: #4a90e2;
            --bg-color: #f5f7fa;
            --card-bg: #ffffff;
            --text-color: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .profile-card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            transition: transform 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
            border: 3px solid var(--primary-color);
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .profile-email {
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 1rem;
            transition: opacity 0.2s;
        }

        .profile-email:hover {
            opacity: 0.8;
        }

        .profile-bio {
            text-align: center;
            font-size: 0.95rem;
            color: #666;
            margin-top: 0.5rem;
        }

        header {
            background: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Profile Directory</h1>
    </header>

    <div class="container">
        <?php
        $xml = simplexml_load_file('bin/LV2.xml');

        if ($xml === false) {
            die('Error loading XML file');
        }

        foreach ($xml->record as $person) {
            echo '<div class="profile-card">';
            echo '<img src="' . htmlspecialchars($person->slika) . '" alt="Profile image" class="profile-image">';
            echo '<h2 class="profile-name">' . htmlspecialchars($person->ime . ' ' . $person->prezime) . '</h2>';
            echo '<a href="mailto:' . htmlspecialchars($person->email) . '" class="profile-email">' . 
                htmlspecialchars($person->email) . '</a>';
            echo '<p class="profile-bio">' . htmlspecialchars($person->zivotopis) . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
