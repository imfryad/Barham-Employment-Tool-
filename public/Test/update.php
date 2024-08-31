<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}
?>

<!-- Content to be loaded dynamically -->
 <h1>نوێکردنەوەی زانیاریەکانی کار</h1>
<p>لێرە دەتوانی زانیاری لەسەر کارەکە بڵاوبکەیتەوە</p>
