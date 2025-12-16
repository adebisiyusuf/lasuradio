<?php
// includes/header.php

if (!isset($station)) {
    $station = ['name' => 'LASU Radio 95.7 FM, Solidly Uniques Radio!', 'slug' => 'lagos'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    $baseUrl .= "://" . $_SERVER['HTTP_HOST'];
    $baseUrl .= rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';

    // normalize when using public folder
    $baseUrl = preg_replace('#/public/?$#', '', $baseUrl);
    ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/global.css">
    <?php if (!empty($pageSlug)): ?>
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/<?= htmlspecialchars($pageSlug) ?>.css">
    <?php endif; ?>

    

    
</head>
<body class="<?= e($pageSlug ?? '') ?>">

<header class="site-header">
    <div class="header-top">
        <div class="logo">
            <a href="index.php?station=<?= e($station['slug']) ?>">
                LASU Radio<span>FM</span>
            </a>
        </div>

       

        <button class="mobile-menu-toggle" id="menuToggle">
            ☰
        </button>

        <a href="player.php?station=<?= e($station['slug']) ?>" class="btn-listen-live">
            Listen Live
        </a>
    </div>

    
    <nav class="main-nav" id="mainNav">
        <ul>
            <li><a href="index.php?station=<?= e($station['slug']) ?>&category=news"">Home</a></li>
            <li class="dropdown">
                <a href="news.php">News</a>
            </li>
            <li><a href="rate-card.php?station=<?= e($station['slug']) ?>">Rate Card</a></li>
            <li><a href="now-playing.php?station=<?= e($station['slug']) ?>">Now Playing</a></li>
            <li><a href="shows.php?station=<?= e($station['slug']) ?>">Top Shows</a></li>
            <li><a href="presenters.php?station=<?= e($station['slug']) ?>">Presenters</a></li>
            <li><a href="podcasts.php?station=<?= e($station['slug']) ?>">Listen Again</a></li>
            <li><a href="contact.php?station=<?= e($station['slug']) ?>">Contact Us</a></li>
            <li><a href="news.php?station=<?= e($station['slug']) ?>&category=sports">Sports</a></li>
            
            <li><a href="about.php?station=<?= e($station['slug']) ?>">About Us</a></li>

        </ul>
    </nav>
</header>

<main class="site-main">
