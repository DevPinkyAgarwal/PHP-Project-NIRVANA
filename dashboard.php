<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

// Redirect if not logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = getCurrentUser();
$page_title = "NIRVANA - My Account";
include 'includes/header.php';
include 'includes/navbar.php';
?>
<link rel="stylesheet" href="style.css">

<div class="dashboard-container">
    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?></h1>
    
    <div class="dashboard-grid">
        <div class="dashboard-card">
            <h2>Your Orders</h2>
            <p>Track, return, or buy things again</p>
            <a href="#" class="dashboard-link">View Orders</a>
        </div>
        <div class="dashboard-card">
            <h2>Login & Security</h2>
            <p>Edit login, name, and mobile number</p>
            <a href="#" class="dashboard-link">Edit Profile</a>
        </div>
        <div class="dashboard-card">
            <h2>Your Addresses</h2>
            <p>Edit addresses for orders and gifts</p>
            <a href="#" class="dashboard-link">Manage Addresses</a>
        </div>
        <div class="dashboard-card">
            <h2>Payment Options</h2>
            <p>Edit or add payment methods</p>
            <a href="#" class="dashboard-link">Manage Payments</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>