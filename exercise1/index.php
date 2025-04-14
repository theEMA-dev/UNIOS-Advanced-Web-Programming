<?php

require_once __DIR__ . '/src/classes/GraduateThesis.php';

// Initialize scraper
$scraper = new Scraper();

// Fetch and save theses from pages 2-6
for ($page = 2; $page <= 6; $page++) {
    echo "Fetching page {$page}...\n";
    
    // Get page HTML
    $html = $scraper->fetchPage($page);
    echo "Received HTML length: " . strlen($html) . "\n";
    
    // Parse theses from HTML
    $thesesData = $scraper->parseHTML($html);
    echo "Found " . count($thesesData) . " theses on page {$page}\n";
    
    // Create and save thesis objects
    foreach ($thesesData as $thesisData) {
        echo "Processing thesis: " . $thesisData['work_name'] . "\n";
        $thesis = new GraduateThesis();
        $thesis->create($thesisData);
        $thesis->save();
    }
}

echo "\nReading all saved theses:\n";
echo "------------------------\n\n";

// Read and display all saved theses
$thesis = new GraduateThesis();
$allTheses = $thesis->read();

if (empty($allTheses)) {
    echo "No theses found in storage.\n";
} else {
    foreach ($allTheses as $thesis) {
        echo "Title: " . $thesis->getWorkName() . "\n";
        echo "Link: " . $thesis->getWorkLink() . "\n";
        echo "ID Number: " . $thesis->getIdentificationNumber() . "\n";
        echo "Text Preview: " . substr($thesis->getWorkText(), 0, 200) . "...\n";
        echo "------------------------\n\n";
    }
}
