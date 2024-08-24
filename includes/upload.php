<?php
require 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['full-name']));
    $location = isset($_POST['precise-location']) ? htmlspecialchars(trim($_POST['precise-location'])) : '';
    $phoneNumber = isset($_POST['phone-number']) ? htmlspecialchars(trim($_POST['phone-number'])) : '';
    $maritalStatus = isset($_POST['marital-status']) ? htmlspecialchars(trim($_POST['marital-status'])) : '';
    $birthDate = isset($_POST['birthday']) ? htmlspecialchars(trim($_POST['birthday'])) : '';
    $experience = isset($_POST['previous-works']) ? htmlspecialchars(trim($_POST['previous-works'])) : '';
    $languages = isset($_POST['languages']) ? htmlspecialchars(trim($_POST['languages'])) : '';
    $education = isset($_POST['education']) ? htmlspecialchars(trim($_POST['education'])) : '';
    $seenOurWorks = isset($_POST['seen-works']) ? htmlspecialchars(trim($_POST['seen-works'])) : '';
    $suggestions = isset($_POST['suggestions']) ? htmlspecialchars(trim($_POST['suggestions'])) : '';
    

    // Initialize CV file path
    $cvFilePath = null;

    if (isset($_FILES['cv-upload'])) {
        $file = $_FILES['cv-upload'];

        // Validate file type
        $allowedTypes = ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];
        if (!in_array($file['type'], $allowedTypes)) {
            echo 'Invalid file type.';
            exit;
        }

        // Validate file size
        if ($file['size'] > 10 * 1024 * 1024) { // 5 MB
            echo 'قەبارەی فایلەکە نابێت لە 10 MB زیاتر بێت';
            exit;
        }

        // Create upload directory if it doesn't exist
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Generate a unique file name
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid('cv_', true) . '.' . $fileExtension;

        // Set upload path
        $uploadFile = $uploadDir . $uniqueFileName;

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            // Store file path in a variable to insert into the database later
            $cvFilePath = $uniqueFileName; // Store the unique file name, not the full path
        } else {
            // Redirect with error message
            header('Location: ../public/index.php?upload_status=error');
            exit;
        }
    }

    $stmt = $pdo->prepare("
        INSERT INTO applicants (name, location, phone_number, marital_status, birth_date, experience, languages, education, seen_our_works, suggestions, cv_file_path) 
        VALUES (:name, :location, :phone_number, :marital_status, :birth_date, :experience, :languages, :education, :seen_our_works, :suggestions, :cv_file_path)
    ");

    $stmt->execute([
        'name' => $name,
        'location' => $location,
        'phone_number' => $phoneNumber,
        'marital_status' => $maritalStatus,
        'birth_date' => $birthDate,
        'experience' => $experience,
        'languages' => $languages,
        'education' => $education,
        'seen_our_works' => $seenOurWorks,
        'suggestions' => $suggestions,
        'cv_file_path' => $cvFilePath
    ]);


    // Redirect with success message
    header('Location: ../public/success.php');
    exit;

} else {
    echo 'داواکاریەکە دروست نییە';
}

