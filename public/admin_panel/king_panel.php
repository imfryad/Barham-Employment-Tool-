<?php
require_once 'auth.php'; // require admin authentication
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پانێڵی ئەدمین</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Navigation Menu -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="update-tab" data-bs-toggle="tab" href="#update">نوێکردنەوەی زانیارییەکان</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="view-tab" data-bs-toggle="tab" href="#view">بینینی داواکارییەکان</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3">
            <?php require 'update_job_section.php'; ?>
            <?php require 'view_applicants_section.php'; ?>
        </div>
    </div>
    
    <!-- require the external JavaScript file -->
    <script src="toggle_columns.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
