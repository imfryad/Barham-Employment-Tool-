<?php
session_start([
    'cookie_lifetime' => 86400,  // 1 day
    'cookie_secure' => true,      // Only send cookies over HTTPS
    'cookie_httponly' => true,    // Prevent JavaScript access to session cookies
    'use_strict_mode' => true,    // Prevent session fixation
    'use_only_cookies' => true,   // Use only cookies for sessions
]);

require_once '../../includes/db_connect.php'; // Connect to the database

$error = ""; // Initialize error variable

$status = htmlspecialchars($_GET['status'] ?? '');

if ($status === 'success') {
    echo '<div class="alert alert-success">ناوی بەکارهێنەر نوێکرایەوە.</div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Prepare and execute the SQL query to find the user by username
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password_hash'])) {
            // Password is correct, set session variables
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $user['id'];  // Store the user ID in the session

            // Regenerate session ID to prevent session fixation
            session_regenerate_id(true);

            // Redirect to the admin panel
            header('Location: admin.php');
            exit;
        } else {
            // Incorrect password
            $error = "تێپەڕەوشە هەڵەیە";
        }
    } else {
        // User not found
        $error = "بەکارهێنەر یان تێپەڕەوشە هەڵەیە";
    }
}
?>

<!DOCTYPE html>
<html lang="ku">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>چوونەژوورەوە</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="adminstyles.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center mb-4">چوونەژوورەوە</h2>
                
                <!-- Only display the error message if there is an error -->
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <form method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">ناوی بەکارهێنەر</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">تێپەڕەوشە</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">چوونە ژوورەوە</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
