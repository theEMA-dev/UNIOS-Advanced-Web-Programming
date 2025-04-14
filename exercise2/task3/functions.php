<?php
class FileEncryption {
    private $key = "exerciseEncryptionKey123"; // In real application, this should be stored securely

    public function encrypt($data) {
        $key = substr(hash('sha256', $this->key, true), 0, 32);
        $encrypted = '';
        for($i = 0; $i < strlen($data); $i++) {
            $encrypted .= chr(ord($data[$i]) ^ ord($key[$i % 32]));
        }
        return base64_encode($encrypted);
    }

    public function decrypt($encryptedData) {
        $key = substr(hash('sha256', $this->key, true), 0, 32);
        $data = base64_decode($encryptedData);
        $decrypted = '';
        for($i = 0; $i < strlen($data); $i++) {
            $decrypted .= chr(ord($data[$i]) ^ ord($key[$i % 32]));
        }
        return $decrypted;
    }

    public function validateFileType($file) {
        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        return in_array($file['type'], $allowedTypes);
    }

    public function saveMetadata($originalName, $encryptedName, $fileType) {
        $metadata = [
            'original_name' => $originalName,
            'encrypted_name' => $encryptedName,
            'file_type' => $fileType,
            'upload_date' => date('Y-m-d H:i:s')
        ];
        
        $metadataFile = 'uploads/metadata.json';
        $existingMetadata = [];
        
        if (file_exists($metadataFile)) {
            $existingMetadata = json_decode(file_get_contents($metadataFile), true) ?? [];
        }
        
        $existingMetadata[] = $metadata;
        file_put_contents($metadataFile, json_encode($existingMetadata, JSON_PRETTY_PRINT));
    }

    public function getFileMetadata($encryptedName) {
        $metadataFile = 'uploads/metadata.json';
        if (!file_exists($metadataFile)) {
            return null;
        }

        $metadata = json_decode(file_get_contents($metadataFile), true) ?? [];
        foreach ($metadata as $file) {
            if ($file['encrypted_name'] === $encryptedName) {
                return $file;
            }
        }
        return null;
    }

    public function getAllFiles() {
        $metadataFile = 'uploads/metadata.json';
        if (!file_exists($metadataFile)) {
            return [];
        }
        return json_decode(file_get_contents($metadataFile), true) ?? [];
    }
}
?>
