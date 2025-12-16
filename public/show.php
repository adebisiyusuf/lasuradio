<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$slug = $_GET['slug'] ?? '';

$stmt = $pdo->prepare("SELECT sh.*, s.city FROM shows sh JOIN stations s ON sh.station_id = s.id WHERE sh.slug = ?");
$stmt->execute([$slug]);
$show = $stmt->fetch();

if (!$show) {
    die("Show not found");
}

$stmt = $pdo->prepare("SELECT * FROM podcasts WHERE show_id = ? ORDER BY published_at DESC LIMIT 20");
$stmt->execute([$show['id']]);
$podcasts = $stmt->fetchAll();

$pageTitle = $show['title'];
$pageSlug  = 'show';

include __DIR__ . '/includes/header.php';
?>

<section class="show-page">
    <div class="show-header">
        <?php if (!empty($show['image'])): ?>
            <img src="/uploads/<?= e($show['image']) ?>" class="show-cover">
        <?php endif; ?>

        <div class="show-info">
            <h1><?= e($show['title']) ?></h1>
            <p class="show-meta"><?= e($show['city']) ?> • <?= e($show['schedule']) ?></p>
            <div class="show-description"><?= nl2br(e($show['description'])) ?></div>
        </div>
    </div>

    <h2>Recent Episodes</h2>

    <div class="podcast-grid">
        <?php foreach ($podcasts as $p): ?>
            <article class="podcast-card">
                <h3><?= e($p['title']) ?></h3>
                <audio controls>
                    <source src="/uploads/<?= e($p['audio_url']) ?>" type="audio/mpeg">
                </audio>
                <p><?= e(mb_substr($p['description'],0,120)) ?>...</p>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
