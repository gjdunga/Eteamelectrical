<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' | ' : ''; ?>E Team Electrical</title>
<link rel="stylesheet" href="assets/css/main.css">
<style>
/* Lightbox overlay for gallery */
.lightbox-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.92);z-index:9999;align-items:center;justify-content:center;cursor:zoom-out}
.lightbox-overlay.active{display:flex}
.lightbox-overlay img,.lightbox-overlay video{max-width:92vw;max-height:90vh;border-radius:var(--radius);box-shadow:0 20px 60px rgba(0,0,0,.7);image-orientation:from-image}
.lightbox-close{position:fixed;top:18px;right:24px;color:#fff;font-size:2rem;cursor:pointer;z-index:10000;background:rgba(0,0,0,.5);border:none;border-radius:999px;width:44px;height:44px;display:flex;align-items:center;justify-content:center}
.lightbox-nav{position:fixed;top:50%;transform:translateY(-50%);color:#fff;font-size:2.4rem;cursor:pointer;z-index:10000;background:rgba(0,0,0,.4);border:none;border-radius:999px;width:52px;height:52px;display:flex;align-items:center;justify-content:center}
.lightbox-nav.prev{left:18px}
.lightbox-nav.next{right:18px}
.lightbox-nav:hover,.lightbox-close:hover{background:rgba(255,210,74,.3)}
/* Video tile play indicator */
.tile-play{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;z-index:2;pointer-events:none}
.tile-play span{font-size:3rem;background:rgba(0,0,0,.5);border-radius:999px;width:64px;height:64px;display:flex;align-items:center;justify-content:center}
</style>
</head>
<body class="<?php echo isset($body_class) ? htmlspecialchars($body_class) : ''; ?>">

<a class="skip-link screen-reader-text" href="#content">Skip to content</a>

<header class="site-header">
    <div class="top-bar">
        <div class="container top-bar-inner">
            <div class="brand">
                <a class="site-logo" href="index.php">
                    <img src="assets/img/brand/logo.svg" alt="E Team Electrical" height="90" loading="eager">
                </a>
                <a class="site-title" href="index.php">E Team Electrical</a>
                <div class="tagline"></div>
            </div>
            <div class="top-cta">
                <a class="btn btn-ghost" href="reviews.php">Reviews</a>
                <a class="btn btn-primary" href="index.php#quote">Request a Quote</a>
            </div>
        </div>
    </div>

    <div class="nav-bar">
        <div class="container nav-bar-inner">
            <button class="nav-toggle" aria-controls="primary-menu" aria-expanded="false">
                <span class="nav-toggle-lines" aria-hidden="true"></span>
                <span class="screen-reader-text">Menu</span>
            </button>

            <nav id="primary-menu" class="primary-nav" aria-label="Primary Menu">
                <ul class="menu">
                    <li<?php if(basename($_SERVER['PHP_SELF']) === 'index.php') echo ' class="current-menu-item"'; ?>><a href="index.php">Home</a></li>
                    <li<?php if(basename($_SERVER['PHP_SELF']) === 'gallery.php') echo ' class="current-menu-item"'; ?>><a href="gallery.php">Gallery</a></li>
                    <li<?php if(basename($_SERVER['PHP_SELF']) === 'reviews.php') echo ' class="current-menu-item"'; ?>><a href="reviews.php">Reviews</a></li>
                    <li><a href="index.php#quote">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<main id="content" class="site-content">
