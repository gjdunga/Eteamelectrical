<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' | ' : ''; ?>E Team Electrical</title>
<meta name="description" content="E Team Electrical: Journeyman electrician, general contractor, and handyman serving Colorado. Electrical, construction, concrete, remodels, and more.">
<link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<a class="skip-link" href="#content">Skip to content</a>

<header class="site-header">
    <div class="container header-inner">
        <div class="brand">
            <a class="site-logo" href="index.php">
                <img src="assets/img/brand/logo.svg" alt="E Team Electrical" height="52" loading="eager">
            </a>
            <div class="brand-text">
                <a class="site-title" href="index.php">E Team Electrical</a>
                <div class="tagline">Journeyman Electrician &bull; General Contractor</div>
            </div>
        </div>

        <nav id="primary-menu" class="primary-nav" aria-label="Primary Menu">
            <ul class="menu">
                <li<?php if(basename($_SERVER['PHP_SELF']) === 'index.php') echo ' class="current-menu-item"'; ?>><a href="index.php">Home</a></li>
                <li<?php if(basename($_SERVER['PHP_SELF']) === 'gallery.php') echo ' class="current-menu-item"'; ?>><a href="gallery.php">Gallery</a></li>
                <li<?php if(basename($_SERVER['PHP_SELF']) === 'reviews.php') echo ' class="current-menu-item"'; ?>><a href="reviews.php">Reviews</a></li>
                <li><a href="index.php#contact">Contact</a></li>
            </ul>
        </nav>

        <div class="header-cta">
            <a class="btn btn-primary btn-sm" href="index.php#contact">Get a Quote</a>
        </div>

        <button class="nav-toggle" aria-controls="primary-menu" aria-expanded="false">
            <span class="nav-toggle-lines" aria-hidden="true"></span>
            <span class="sr-only">Menu</span>
        </button>
    </div>
</header>

<main id="content">
