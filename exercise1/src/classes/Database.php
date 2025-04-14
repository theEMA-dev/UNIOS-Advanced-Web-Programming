<?php

class Database
{
    private static $instance = null;
    private $connection = null;

    private function __construct()
    {
        $this->connection = new mysqli('localhost', 'root', 'test', 'thesis');

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $this->connection->set_charset("utf8mb4");
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function insert($table, $data)
    {
        // Check if entry with same work_link exists
        $check_sql = "SELECT COUNT(*) as count FROM {$table} WHERE work_link = '" . 
            $this->connection->real_escape_string($data['work_link']) . "'";
        $result = $this->connection->query($check_sql);
        $row = $result->fetch_assoc();
        
        if ($row['count'] > 0) {
            return true; // Skip duplicate
        }

        $columns = implode(', ', array_keys($data));
        $values = array_map(function ($value) {
            return "'" . $this->connection->real_escape_string($value) . "'";
        }, array_values($data));
        $values = implode(', ', $values);

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

        if (!$this->connection->query($sql)) {
            echo "Error inserting data: " . $this->connection->error . "\n";
            return false;
        }
        return true;
    }

    public function getAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        $result = $this->connection->query($sql);

        if (!$result) {
            echo "Error fetching data: " . $this->connection->error . "\n";
            return [];
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
