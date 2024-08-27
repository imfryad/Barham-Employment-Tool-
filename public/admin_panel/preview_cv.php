<?php
// preview_cv.php

// Ensure a file is specified
if (isset($_GET['file']) && !empty($_GET['file'])) {
    $file = basename($_GET['file']); // Extract the file name
    $filePath = '../../uploads/' . $file; // Construct the file path

    // Check if file exists
    if (file_exists($filePath)) {
        $fileInfo = pathinfo($filePath);
        $fileExtension = strtolower($fileInfo['extension']);
        
        switch ($fileExtension) {
            case 'pdf':
                header('Content-Type: application/pdf');
                break;
            case 'jpg':
            case 'jpeg':
                header('Content-Type: image/jpeg');
                break;
            case 'png':
                header('Content-Type: image/png');
                break;
            case 'docx':
                // For DOCX files, provide a download link or use an online viewer.
                echo "<p>فایلی وۆرد ناتوانرێ ڕاستەوخۆ ببینرێت.  <a href=\"$filePath\" download>فایلەکە دابەزێنە</a></p>";
                exit;
            default:
                echo "ئەم فایلە پشتگیریلێکراو نیە";
                exit;
        }
        
        // Serve the file
        header('Content-Disposition: inline; filename="' . $file . '"');
        readfile($filePath);
        exit;
    } else {
        echo "فایلەکە نەدۆزرایەوە";
        exit;
    }
} else {
    echo "هیچ فایلێک دەستنیشان نەکراوە";
}
