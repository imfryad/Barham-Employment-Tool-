<?php
// Path to the uploads directory
$uploadsDir = realpath(__DIR__ . '/../uploads/');

// Get the file path from the URL parameter
$file = $_GET['file'];

// Ensure the file is within the uploads directory
$filePath = realpath($uploadsDir . '/' . $file);

if ($filePath && strpos($filePath, $uploadsDir) === 0 && file_exists($filePath)) {
    // Serve the file
    header('Content-Type: ' . mime_content_type($filePath));
    header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
    readfile($filePath);
    exit;
} else {
    // File not found or invalid
    http_response_code(404);
    echo 'File not found';
    exit;
}
