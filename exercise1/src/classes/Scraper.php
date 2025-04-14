<?php

class Scraper {
    private function execCurl($url) {
        $command = sprintf(
            'curl -s -A "%s" -H "Accept: text/html" -L --insecure "%s"',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            $url
        );
        return shell_exec($command);
    }

    public function fetchPage($number) {
        $url = "https://stup.ferit.hr/zavrsni-radovi/page/{$number}/";
        $html = $this->execCurl($url);
        
        if (empty($html)) {
            echo "Error fetching URL: " . $url . "\n";
            return '';
        }
        
        return $html;
    }

    public function parseHTML($html) {
        $theses = [];
        
        // Find thesis entries by looking for article or post elements
        preg_match_all('/<article[^>]*class="[^"]*\bpost\b[^"]*".*?<h2[^>]*>.*?<a\s+href="([^"]+)"[^>]*>([^<]+)<\/a>.*?<\/article>/s', $html, $articles);
        
        if (empty($articles[1])) {
            // Alternative pattern if articles not found
            preg_match_all('/<h2[^>]*class="[^"]*\bentry-title\b[^"]*".*?<a\s+href="([^"]+)"[^>]*>([^<]+)<\/a>/s', $html, $articles);
        }
        
        for ($i = 0; $i < count($articles[1]); $i++) {
            $url = $articles[1][$i];
            $title = trim(html_entity_decode($articles[2][$i], ENT_QUOTES));
            
            // Skip navigation links and admin entries
            if (strpos($url, '/page/') !== false || 
                strpos($url, '/author/') !== false || 
                strpos($title, 'admin') !== false ||
                strpos($url, 'mailto:') !== false) {
                continue;
            }
            
            // Get work text from the link
            $work_text = $this->fetchWorkText($url);
            
            // Extract identification number from URL if possible
            $identification_number = '';
            if (preg_match('/\/(\d{8,})/', $url, $matches)) {
                $identification_number = $matches[1];
            }
            
            // Create thesis data array
            $theses[] = [
                'work_name' => $title,
                'work_text' => $work_text,
                'work_link' => $url,
                'identification_number' => $identification_number
            ];
        }
        
        return $theses;
    }

    private function fetchWorkText($url) {
        $html = $this->execCurl($url);
        
        if (empty($html)) {
            echo "Error fetching thesis URL: " . $url . "\n";
            return '';
        }

        // Extract the main content
        preg_match('/<div[^>]*class="[^"]*\bpost-content\b[^"]*"[^>]*>(.*?)<\/div>/s', $html, $matches);
        $text = $matches[1] ?? '';
        
        // Clean up the text
        $text = strip_tags($text);
        $text = trim(preg_replace('/\s+/', ' ', $text));
        
        return $text;
    }
}
