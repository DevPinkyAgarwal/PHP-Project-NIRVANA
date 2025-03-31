<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$page_title = "NIRVANA - Online Shopping";
include 'includes/header.php';
include 'includes/navbar.php';

// Get products from database with optional search/filter
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$query = "SELECT * FROM products";
$conditions = [];
$params = [];
$types = '';

if (!empty($search)) {
    $conditions[] = "name LIKE ?";
    $params[] = "%$search%";
    $types .= 's';
}

if (!empty($category)) {
    $conditions[] = "category = ?";
    $params[] = $category;
    $types .= 's';
}

if (!empty($conditions)) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$products = $stmt->get_result();
?>






<!-- html -->
<!-- Hero Banner -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'NIRVANA - Online Shopping'; ?></title>
    <!-- Reference to styles.css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
<div class="hero-banner">
    <div class="hero-content">
        <h1>Welcome to NIRVANA</h1>
        <p>Your one-stop shop for everything</p>
        <a href="#hredddd" class="shop-now-btn">Shop Now</a>
    </div>
</div>

<!-- Product Categories -->
<div class="categories">
    <h2>Shop by Category</h2>
    <div class="category-grid">
        <div class="category-card" id="hredddd">
            <img src="https://images-eu.ssl-images-amazon.com/images/G/31/IMG15/Irfan/GATEWAY/MSO/Appliances-QC-PC-186x116--B08RDL6H79._SY116_CB667322346_.jpg" alt="Electronics">
            <h3>Electronics</h3>
        </div>
        <div class="category-card">
            <img src="https://images-eu.ssl-images-amazon.com/images/G/31/img22/Fashion/Gateway/BAU/BTF-Refresh/May/PC_WF/WF1-186-116._SY116_CB636048992_.jpg" alt="Fashion">
            <h3>Fashion</h3>
        </div>
        <div class="category-card">
            <img src="https://m.media-amazon.com/images/G/31/img18/HomeImprovement/GW/home-makeover/Halo-Tiles_02._SS300_QL85_.jpg" alt="Home & Kitchen">
            <h3>Home & Kitchen</h3>
        </div>
        <div class="category-card">
            <img src="https://m.media-amazon.com/images/I/712K3sdLlRL._AC_UY327_FMwebp_QL65_.jpg" alt="Books">
            <h3>Books</h3>
        </div>
    </div>
</div>


</head>
<body>

<?php include 'includes/footer.php'; ?>