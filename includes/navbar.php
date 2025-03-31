<?php
require_once 'auth.php';
?>

<nav class="navbar">
    <div class="nav-logo">
        <a href="index.php">NIRVANA</a>
    </div>
    <div class="nav-search">
        <form method="GET" action="index.php">
            <select class="search-select" name="category">
                <option value="">All</option>
                <option value="Electronics">Electronics</option>
                <option value="Fashion">Fashion</option>
                <option value="Home & Kitchen">Home & Kitchen</option>
                <option value="Books">Books</option>
            </select>
            <input type="text" class="search-input" name="search" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="search-button">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <div class="nav-account">
        <?php if (isLoggedIn()): ?>
            <a href="dashboard.php" class="account-link">Hello, <?php echo $_SESSION['user_name']; ?></a>
            <span>Your Account</span>
        <?php else: ?>
            <a href="login.php" class="account-link">Hello, Sign in</a>
            <span>Account & Lists</span>
        <?php endif; ?>
    </div>
    <div class="nav-orders">
        <span>Returns</span>
        <span>& Orders</span>
    </div>
    <div class="nav-cart">
        <i class="fas fa-shopping-cart"></i>
        <span>Cart</span>
        <span class="cart-count">0</span>
    </div>
    <?php if (isLoggedIn()): ?>
        <div class="nav-logout">
            <a href="logout.php">Logout</a>
        </div>
    <?php endif; ?>
</nav>