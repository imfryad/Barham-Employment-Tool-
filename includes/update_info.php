<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $open_position = $_POST['open_position'];
    $job_description = $_POST['job_description'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];

    // File path where the data will be saved
    $dataFile = 'includes/job_info.json';

    // Data to be saved
    $data = [
        'open_position' => $open_position,
        'job_description' => $job_description,
        'gender' => $gender,
        'location' => $location,
    ];

    // Save data to the file
    if (file_put_contents($dataFile, json_encode($data))) {
        echo 'The information has been updated successfully.';
    } else {
        echo 'Failed to update the information.';
    }
} else {
    echo 'Invalid request method.';
}

