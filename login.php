<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

// Handle login form submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (loginUser($email, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid email or password';
    }
}

$page_title = "NIRVANA - Login";
include 'includes/header.php';
?>
<link rel="stylesheet" href="style.css">
<div class="auth-container">
    <div class="auth-logo">
        <a href="index.php">NIRVANA</a>
    </div>
    <div class="auth-box">
        <h1>Sign-In</h1>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email or mobile phone number</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="auth-button">Continue</button>
        </form>
        <div class="auth-terms">
            By continuing, you agree to NIRVANA's <a href="#">Conditions of Use</a> and <a href="#">Privacy Notice</a>.
        </div>
        <div class="auth-help">
            <a href="#"><i class="fas fa-caret-right"></i> Need help?</a>
        </div>
    </div>
    <div class="auth-divider">
        <span>New to NIRVANA?</span>
    </div>
    <a href="signup.php" class="auth-create-account">Create your NIRVANA account</a>
</div>

<?php include 'includes/footer.php'; ?>