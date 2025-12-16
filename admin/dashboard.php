<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/auth.php';


/* SAFETY CHECK */
if (!isset($pdo)) {
    die("Database connection not found.");
}

$newsCount = $pdo->query("SELECT COUNT(*) FROM articles")->fetchColumn();
$showsCount = $pdo->query("SELECT COUNT(*) FROM shows")->fetchColumn();
$podsCount  = $pdo->query("SELECT COUNT(*) FROM podcasts")->fetchColumn();
$presentersCount = $pdo->query("SELECT COUNT(*) FROM presenters")->fetchColumn();
?>

<h1>Dashboard</h1>

<div class="admin-grid">
    <div class="admin-card">News<br><strong><?= $newsCount ?></strong></div>
    <div class="admin-card">Shows<br><strong><?= $showsCount ?></strong></div>
    <div class="admin-card">Podcasts<br><strong><?= $podsCount ?></strong></div>
    <div class="admin-card">Presenters<br><strong><?= $presentersCount ?></strong></div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>



