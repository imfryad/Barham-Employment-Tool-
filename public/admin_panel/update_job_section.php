<?php
// Update job information logic
require '../../includes/db_connect.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $position = $_POST['open_position'];
    $description = $_POST['job_description'];
    $gender = $_POST['gender'];
    $location = $_POST['location'];

    if (empty($position) || empty($description) || empty($gender) || empty($location)) {
        $error = "هەموو خانەکان پڕبکەوە.";
    } else {
        $stmt = $pdo->prepare("UPDATE job_info SET open_position = ?, job_description = ?, gender = ?, location = ? WHERE id = 1");
        if ($stmt->execute([$position, $description, $gender, $location])) {
            $updateStatus = 'نوێکردنەوەکە سەرکەوتوو بوو';
        } else {
            $updateStatus = 'نوێکردنەوەکە سەرکەوتوو نەبوو. تکایە دووبارە هەوڵ بدەوە.';
        }
    }
}

// Fetch current job info
$stmt = $pdo->query("SELECT * FROM job_info WHERE id = 1");
$job = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- Update Job Info Section -->
<div id="update" class="tab-pane fade show active">
    <h1>پانێڵی ئەدمین - نوێکردنەوەی زانیاریەکان</h1>
    
    <?php if (isset($error)): ?>
        <div id="feedback-message" class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php elseif (isset($updateStatus)): ?>
        <div id="feedback-message" class="alert alert-success" role="alert">
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

<!-- JavaScript to hide the feedback message after 5 seconds -->
<script>
    setTimeout(function() {
        var feedbackMessage = document.getElementById('feedback-message');
        if (feedbackMessage) {
            feedbackMessage.style.display = 'none';
        }
    }, 5000); // 5000ms = 5 seconds
</script>
