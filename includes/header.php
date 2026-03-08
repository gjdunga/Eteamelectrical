<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' | ' : ''; ?>E Team Electrical</title>
<meta name="description" content="E Team Electrical: Master electrician, general contractor, and handyman serving all of Colorado.">
<link rel="stylesheet" href="assets/css/main.css">
<script src="https://www.paypal.com/sdk/js?client-id=BAAUFrqYNULUD7oQreRW5hB_60OZrCYozuIvKPiCClKu1k3OkTFP_tIdsrZxX29TsDlCQhsTiuGNg1HlBk&components=hosted-buttons&enable-funding=venmo&currency=USD"></script>
</head>
<body>

<header class="site-header" id="site-header">
    <div class="container header-inner">
        <a class="brand" href="index.php">
            <div class="brand-mark">E</div>
            <div>
                <div class="brand-name">E Team Electrical</div>
                <div class="brand-sub">Licensed &bull; Colorado</div>
            </div>
        </a>

        <nav id="primary-menu" class="primary-nav">
            <ul class="menu">
                <li<?php if(basename($_SERVER['PHP_SELF'])==='index.php') echo ' class="current-menu-item"'; ?>><a href="index.php">Home</a></li>
                <li<?php if(basename($_SERVER['PHP_SELF'])==='gallery.php') echo ' class="current-menu-item"'; ?>><a href="gallery.php">Gallery</a></li>
                <li<?php if(basename($_SERVER['PHP_SELF'])==='reviews.php') echo ' class="current-menu-item"'; ?>><a href="reviews.php">Reviews</a></li>
                <li<?php if(basename($_SERVER['PHP_SELF'])==='payment.php') echo ' class="current-menu-item"'; ?>><a href="payment.php">Payment</a></li>
                <li><a href="index.php#contact">Contact</a></li>
            </ul>
        </nav>

        <button class="nav-toggle" id="nav-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<main>
