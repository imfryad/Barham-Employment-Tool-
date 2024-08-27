<?php
// Fetch applicants data
require '../../includes/db_connect.php'; // Database connection

try {
    $applicantsStmt = $pdo->query("SELECT * FROM applicants");
    $applicants = $applicantsStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $applicantsError = $e->getMessage();
}
?>

<!-- View Applicants Section -->
<div id="view" class="tab-pane fade">
    <h1>پانێڵی ئەدمین - بۆبینینی داواکاریەکان</h1>
    

    <div style="margin: 30px;">




        <div>
            <button id="toggleCheckboxes" class="btn btn-primary" >پشاندانی چێک بۆکسەکان</button>
        </div>



        <div id="checkboxContainer" style="margin-top: 10px; display: none;" >
            <label><input type="checkbox" class="toggle-column" data-column="1" checked>ID</label>
            <label><input type="checkbox" class="toggle-column" data-column="2" checked>ناو</label>
            <label><input type="checkbox" class="toggle-column" data-column="3" checked>شوێن</label>
            <label><input type="checkbox" class="toggle-column" data-column="4" checked>موبایل</label>
            <label><input type="checkbox" class="toggle-column" data-column="5" checked>دۆخی هاوسەرگیری</label>
            <label><input type="checkbox" class="toggle-column" data-column="6" checked>لەدایک بوون</label>
            <label><input type="checkbox" class="toggle-column" data-column="7" checked>ئەزموون</label>
            <label><input type="checkbox" class="toggle-column" data-column="8" checked>زمان</label>
            <label><input type="checkbox" class="toggle-column" data-column="9" checked>خوێندن</label>
            <label><input type="checkbox" class="toggle-column" data-column="10" checked>کارەکانمانی بینیوە</label>
            <label><input type="checkbox" class="toggle-column" data-column="11" checked>پێشنیار</label>
            <label><input type="checkbox" class="toggle-column" data-column="12" checked>سیڤی</label>
            <label><input type="checkbox" class="toggle-column" data-column="13" checked>بەرواری دروستکردن</label>
        </div>

        <div class="btn-group btn-group-toggle" data-toggle="buttons" style="margin-top: 10px;">
            <label class="btn btn-secondary active" id="checkAll"> هەموویان دیاربکە </label>
            <label class="btn btn-secondary" id="uncheckAll"> هەموویان بشارەوە </label>
        </div>

    </div>
    

    <?php if (isset($applicantsError)): ?>
        <div class="alert alert-danger" role="alert">
            Error: <?= htmlspecialchars($applicantsError) ?>
        </div>
    <?php else: ?>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ناو</th>
                    <th>شوێن</th>
                    <th>موبایل</th>
                    <th>دۆخی هاوسەرگیری</th>
                    <th>لەدایک بوون</th>
                    <th>ئەزموون</th>
                    <th>زمان</th>
                    <th>خوێندن</th>
                    <th>کارەکانمانی بینیوە</th>
                    <th>پێشنیار</th>
                    <th>سیڤی</th>
                    <th>بەرواری ناردن</th>
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
                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($row['birth_date']))) ?></td>
                        <td><?= htmlspecialchars($row['experience']) ?></td>
                        <td><?= htmlspecialchars($row['languages']) ?></td>
                        <td><?= htmlspecialchars($row['education']) ?></td>
                        <td><?= htmlspecialchars($row['seen_our_works']) ?></td>
                        <td><?= htmlspecialchars($row['suggestions']) ?></td>
                        <td>
                            <a href="preview_cv.php?file=<?= urlencode(basename($row['cv_file_path'])) ?>" target="_blank">سیڤی ببینە</a>
                        </td>
                        <td><?= htmlspecialchars(date('d/m/Y', strtotime($row['created_at']))) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>


