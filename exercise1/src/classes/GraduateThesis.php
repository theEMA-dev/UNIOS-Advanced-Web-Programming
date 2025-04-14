<?php

require_once __DIR__ . '/../interfaces/iRadio.php';
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Scraper.php';

class GraduateThesis implements iRadio {
    private $work_name;
    private $work_text;
    private $work_link;
    private $identification_number;
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function create($data) {
        $this->work_name = $data['work_name'];
        $this->work_text = $data['work_text'];
        $this->work_link = $data['work_link'];
        $this->identification_number = $data['identification_number'];
        return $this;
    }

    public function save() {
        $data = [
            'work_name' => $this->work_name,
            'work_text' => $this->work_text,
            'work_link' => $this->work_link,
            'identification_number' => $this->identification_number
        ];

        return $this->db->insert('graduate_theses', $data);
    }

    public function read() {
        $data = $this->db->getAll('graduate_theses');
        $theses = [];
        
        foreach ($data as $row) {
            $thesis = new GraduateThesis();
            $thesis->create([
                'work_name' => $row['work_name'],
                'work_text' => $row['work_text'],
                'work_link' => $row['work_link'],
                'identification_number' => $row['identification_number']
            ]);
            $theses[] = $thesis;
        }
        
        return $theses;
    }

    // Getters
    public function getWorkName() {
        return $this->work_name;
    }

    public function getWorkText() {
        return $this->work_text;
    }

    public function getWorkLink() {
        return $this->work_link;
    }

    public function getIdentificationNumber() {
        return $this->identification_number;
    }
}
