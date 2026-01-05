<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    protected function sanitize($data)
    {
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }

    protected function uploadFile($file, $path = 'images/', $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'])
    {
        if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (!in_array($fileExt, $allowedTypes)) {
            return false;
        }
        
        if ($fileSize > 5000000) { // 5MB max
            return false;
        }
        
        $fileNameNew = uniqid('', true) . '.' . $fileExt;
        $fileDestination = '../public/' . $path . $fileNameNew;
        
        if (!file_exists('../public/' . $path)) {
            mkdir('../public/' . $path, 0777, true);
        }
        
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
            return $path . $fileNameNew;
        }
        
        return false;
    }

    protected function deleteFile($filePath)
    {
        if (file_exists('../public/' . $filePath)) {
            unlink('../public/' . $filePath);
            return true;
        }
        return false;
    }
}
