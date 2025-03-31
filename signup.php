<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

// Handle signup form submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';
    
    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($repassword)) {
        $error = 'Please fill in all fields';
    } elseif ($password !== $repassword) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        // Check if email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $error = 'Email already registered';
        } else {
            // Register user
            if (registerUser($name, $email, $password)) {
                // Log in the new user
                if (loginUser($email, $password)) {
                    header('Location: dashboard.php');
                    exit;
                }
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}

$page_title = "NIRVANA - Create Account";
include 'includes/header.php';
?>

<div class="auth-container">
    <div class="auth-logo">
        <a href="index.php">NIRVANA</a>
    </div>
    <div class="auth-box">
        <h1>Create Account</h1>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="signup.php">
            <div class="form-group">
                <label for="name">Your name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="At least 6 characters" required>
                <small class="password-hint">Passwords must be at least 6 characters.</small>
            </div>
            <div class="form-group">
                <label for="repassword">Re-enter password</label>
                <input type="password" id="repassword" name="repassword" required>
            </div>
            <button type="submit" class="auth-button">Create your NIRVANA account</button>
        </form>
        <div class="auth-terms">
            By creating an account, you agree to NIRVANA's <a href="#">Conditions of Use</a> and <a href="#">Privacy Notice</a>.
        </div>
        <div class="auth-divider"></div>
        <div class="auth-existing-account">
            Already have an account? <a href="login.php">Sign in</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>