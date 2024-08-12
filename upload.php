<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['cv-upload'])) {
        $file = $_FILES['cv-upload'];

        // Validate file
        $allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
        if (!in_array($file['type'], $allowedTypes)) {
            echo 'Invalid file type.';
            exit;
        }

        if ($file['size'] > 5 * 1024 * 1024) {
            echo 'File size exceeds 5 MB.';
            exit;
        }

        // Save the file
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $uploadFile = $uploadDir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo 'File successfully uploaded.';
        } else {
            echo 'Failed to upload file.';
        }
    } else {
        echo 'No file uploaded.';
    }
} else {
    echo 'Invalid request method.';
}
