<?php
// require the database connection
require '../includes/db_connect.php';

// Fetch data from the database
$stmt = $pdo->query("SELECT * FROM job_info WHERE id = 1"); // Assuming id=1 holds the default values
$data = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if upload status is set
$uploadStatus = isset($_GET['upload_status']) ? $_GET['upload_status'] : '';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فۆڕمی دامەزراندن</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">فۆڕمی دامەزراندن</h1>
        <h2 class="text-center">بەخێربێیت بۆ خێزانی بەرهەم کڵاس</h2>
    </div>
    <div class="container mt-4">
        <!-- Display status messages -->
        <?php if ($uploadStatus === 'success'): ?>
            <div class="alert alert-success" role="alert">
                فایلەکە سەرکەوتوانە بەرزکرایە
            </div>
        <?php elseif ($uploadStatus === 'error'): ?>
            <div class="alert alert-danger" role="alert">
                کێشەیەک هەبوو لە بەرزکردنەوەی فایلەکەدا
            </div>
        <?php endif; ?>

        <form action="../includes/upload.php" method="post" enctype="multipart/form-data">
    <div class="container mt-4">
        <h2>زانیاری کار</h2>

        <!-- Admin-Managed Section -->
        <div class="p-3 mb-4" style="border: 1px solid #ccc; background-color: #f9f9f9; border-radius: 5px;">
            <p class="text-muted">زانیاریەکانی کار بۆ بەرچاوڕوونی دانراون و ناتوانی دەستکاریان بکەیت..</p>
            
            <div class="mb-3">
                <label for="open-position" class="form-label">بەشی کراوە:</label>
                <input type="text" disabled class="form-control" id="open-position" value="<?php echo htmlspecialchars($data['open_position']); ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="job-description" class="form-label">کورتەیەک لەسەر کارەکە:</label>
                <input type="text" disabled class="form-control" id="job-description" value="<?php echo htmlspecialchars($data['job_description']); ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">ڕەگەزی داواکراو:</label>
                <input type="text" disabled   class="form-control" id="gender" value="<?php echo htmlspecialchars($data['gender']); ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="location"  class="form-label">شوێنی کارکردن:</label>
                <input type="text" disabled  class="form-control" id="location" value="<?php echo htmlspecialchars($data['location']); ?>" readonly>
            </div>
        </div>
        <!-- End of Admin-Managed Section -->            

            <div class="container mt-4">
                <div>   
                    <img src="../assets/images/Personal_information.png" alt="Personal Information" class="img-fluid">
                </div>
                <br>
                <h2>زانیاریە کەسیەکان</h2>
                
                <div class="mb-3">
                    <label for="full-name" class="form-label">ناوی سیانی:</label>
                    <input type="text" class="form-control" id="full-name" placeholder="تکایە بە کوردی" name="full-name">
                </div>
            
                <div class="mb-3">
                    <label for="precise-location" class="form-label">شوێنی نیشتەجێبوون:</label>
                    <input type="text" class="form-control" id="precise-location" name="precise-location" placeholder="نمونە: سلێمانی - قەڵادزێ - ئاشتی" required>
                </div>

            
                <div class="mb-3">
                    <label for="phone-number" class="form-label">ژمارەی مۆبایل:</label>
                    <input type="text" class="form-control" id="phone-number" name="phone-number" placeholder="ژمارەیەک کە بەردەوام کارا بێت" required>
                </div>

            
                <div class="mb-3">
                    <label for="marital-status" class="form-label">باری خێزانداری :</label>
                    <div>
                        <input type="radio" id="marital-status-single" name="marital-status" value="سەڵت">
                        <label for="marital-status-single">سەڵت</label>
                    </div>
                    <div>
                        <input type="radio" id="marital-status-married" name="marital-status" value="خێزاندار">
                        <label for="marital-status-married">خێزاندار</label>
                    </div>
                </div>
                
            
                <div class="mb-3">
                    <label for="birthday" class="form-label">بەرواری لە دایک بوون:</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>

            </div>

            <div class="container mt-4">
                <div>   
                    <img src="../assets/images/Skills.png" alt="Skills" class="img-fluid">
                </div>
                <br>
                <h2>لێهاتوویەکان</h2>
                
                <div class="mb-3">
                    <label for="previous-works" class="form-label">ئەزموونی پیشەیی و ڕۆڵی خۆت لە پیشەکەدا باس بکە:</label>
                    <textarea class="form-control" id="previous-works" name="previous-works" rows="3" placeholder="نمونە: کۆمپانیای KCT - پڕۆگرامەر" required></textarea>
                </div>

            
                <div class="mb-3">
                    <label for="languages" class="form-label">زمانزانی:</label>
                    <textarea class="form-control" id="languages" name="languages" rows="2" placeholder="نمونە: ئینگلیزی - بەباشی قسەی پی دەکەم، کوردی - هەردوو دیالێکتی سۆرانی و بادینی دەزانم، عربی - ئەتوانم کەمێک قسەی پێ بکەم" required></textarea>
                </div>


                <div class="mb-3">
                    <label for="education" class="form-label">ئەگەر شەهادەی زانکۆ و پەیمانگا یان کۆرست هەیە لێرە بینووسە:</label>
                    <textarea class="form-control" id="education" name="education" rows="3" placeholder="ئەگەر شەهادەت نەبوو بەتاڵ جێیی بهێڵە" required></textarea>
                </div>

            
                <div class="mb-3">
                    <label for="cv-upload" class="form-label">ئەگەر سیڤیت هەیە تکایە لێرە دایبنێ، جۆری فایلی قبوڵکراو: (pdf, docx, image)</label>
                    <input type="file" class="form-control" id="cv-upload" name="cv-upload" accept=".pdf, .docx, .jpg, .jpeg, .png">
                </div>
                
            </div>
            <div class="container mt-4">
                <div>
                    <img src="../assets/images/YourNote.png" alt="Your Note" class="img-fluid">
                </div>
                
                <br>
                <h2>ڕاو سەرنج</h2>
                
                <div class="mb-3">
                    <label for="seen-our-works" class="form-label">ئایە پێشتر کارەکانی ئێمەت بینیوە؟ </label>
                    <div>
                        <input type="radio" id="seen-works-yes" name="seen-works" value="بەڵێ">
                        <label for="seen-works-yes">بەڵێ</label>
                    </div>
                    <div>
                        <input type="radio" id="seen-works-no" name="seen-works" value="نەخێر">
                        <label for="seen-works-no">نەخێر</label>
                    </div>
                </div>
                
                
                <div class="mb-3">
                    <label for="suggestions" class="form-label">پێشنیار بکە بۆ بەرهەم کڵاس:</label>
                    <textarea class="form-control" id="suggestions" name="suggestions" rows="2" placeholder="بە گرنگیەوە دەیخوێنینەوە"></textarea>
                </div>

            
                <button type="submit" class="btn btn-primary">فۆڕمەکە بنێرە</button>
                <br>
                <br>
            </div>
        </form>
    </div>
</footer>
    <footer class="container mt-4 text-center" style="border-top: 1px solid #ddd; padding-top: 10px; direction: ltr;">
        <p>&copy; 2024 KCT. All rights reserved.</p>
        <p>
            <a href="https://www.facebook.com/kct70" target="_blank">
                <i class="bi bi-facebook" style="font-size: 1.5rem; margin: 0 10px;"></i>
            </a>
            <a href="https://www.instagram.com/kct.102/" target="_blank">
                <i class="bi bi-instagram" style="font-size: 1.5rem; margin: 0 10px;"></i>
            </a>
            <a href="https://www.youtube.com/@KCT102" target="_blank">
                <i class="bi bi-youtube" style="font-size: 1.5rem; margin: 0 10px;"></i>
            </a>
        </p>
    </footer>
    <script src="public/submit_handler.js"></script>
</body>
</html>
