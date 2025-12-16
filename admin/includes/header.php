<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//session_start();

/* ✅ CORRECT DATABASE PATH */
require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/auth.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->execute([$_SESSION['admin_id']]);
$me = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="http://localhost/lasuradio957fm/admin/assets/css/admin.css">
</head>
<body>

<header class="admin-header">
    <h2>LASU Radio Admin</h2>
    <nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="news-manage.php">News</a>
        <a href="shows-manage.php">Shows</a>
        <a href="podcasts-manage.php">Podcasts</a>
        <a href="presenters-manage.php">Presenters</a>
        <a href="schedule-manage.php">Schedule</a>
        <a href="logout.php">Logout (<?= htmlspecialchars($me['username']) ?>)</a>
    </nav>
</header>

<main class="admin-main">
