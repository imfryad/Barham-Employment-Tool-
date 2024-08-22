<?php
// Start session
session_start();

// Redirect if not logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Correct path to include db_connect.php
include '../includes/db_connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = $_POST['open_position'];
    $description = $_POST['job_description'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("UPDATE job_info SET open_position = ?, job_description = ?, gender = ?, location = ? WHERE id = 1");
    $stmt->execute([$position, $description, $gender, $location]);

    $updateStatus = 'نوێکردنەوەکە سەرکەوتوو بوو';
}

// Fetch current job info
$stmt = $pdo->query("SELECT * FROM job_info WHERE id = 1");
$job = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch applicants data
try {
    $applicantsStmt = $pdo->query("SELECT * FROM applicants");
    $applicants = $applicantsStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $applicantsError = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Navigation Menu -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" id="update-tab" data-bs-toggle="tab" href="#update">نوێکردنەوەی زانیاری</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="view-tab" data-bs-toggle="tab" href="#view">بەبینینی داوایەکان</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-3">
            <!-- Update Job Info Section -->
            <div id="update" class="tab-pane fade show active">
                <h1>پانێڵی ئەدمین - نوێکردنەوەی زانیاریەکان</h1>
                <?php if (isset($updateStatus)): ?>
                    <div class="alert alert-success" role="alert">
                        <?= htmlspecialchars($updateStatus) ?>
                    </div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="open_position" class="form-label">بەشی کراوە:</label>
                        <input type="text" class="form-control" id="open_position" name="open_position" value="<?= htmlspecialchars($job['open_position']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="job_description" class="form-label">کورتەیەک لەسەر کارەکە:</label>
                        <textarea class="form-control" id="job_description" name="job_description" rows="3"><?= htmlspecialchars($job['job_description']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">ڕەگەزی داواکراو:</label>
                        <input type="text" class="form-control" id="gender" name="gender" value="<?= htmlspecialchars($job['gender']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">شوێنی کار:</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($job['location']) ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">نوێکردنەوە</button>
                </form>
            </div>

            <!-- View Applicants Section -->
            <div id="view" class="tab-pane fade">
                <h1>پانێڵی ئەدمین - بۆبینینی داواکاریەکان</h1>
                <?php if (isset($applicantsError)): ?>
                    <div class="alert alert-danger" role="alert">
                        Error: <?= htmlspecialchars($applicantsError) ?>
                    </div>
                <?php else: ?>
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Phone Number</th>
                                <th>Marital Status</th>
                                <th>Birth Date</th>
                                <th>Experience</th>
                                <th>Languages</th>
                                <th>Education</th>
                                <th>Seen Our Works</th>
                                <th>Suggestions</th>
                                <th>CV File Path</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($applicants as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['location']) ?></td>
                                    <td><?= htmlspecialchars($row['phone_number']) ?></td>
                                    <td><?= htmlspecialchars($row['marital_status']) ?></td>
                                    <td><?= htmlspecialchars($row['birth_date']) ?></td>
                                    <td><?= htmlspecialchars($row['experience']) ?></td>
                                    <td><?= htmlspecialchars($row['languages']) ?></td>
                                    <td><?= htmlspecialchars($row['education']) ?></td>
                                    <td><?= htmlspecialchars($row['seen_our_works']) ?></td>
                                    <td><?= htmlspecialchars($row['suggestions']) ?></td>
                                    <td><?= htmlspecialchars($row['cv_file_path']) ?></td>
                                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
