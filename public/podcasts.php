<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$stationSlug = $_GET['station'] ?? 'lagos';
$station = getStationBySlug($pdo, $stationSlug);
if (!$station) $station = getStationBySlug($pdo, 'lagos');

$stmt = $pdo->prepare("
    SELECT p.*, s.title AS show_title
    FROM podcasts p
    LEFT JOIN shows s ON p.show_id = s.id
    WHERE p.station_id = :sid
    ORDER BY p.published_at DESC
    LIMIT 40
");
$stmt->execute(['sid' => $station['id']]);
$podcasts = $stmt->fetchAll();

$pageTitle = 'Listen Again - ' . $station['name'];
$pageSlug  = 'podcasts';

include __DIR__ . '/../includes/header.php';
?>

<section class="podcasts-page">
    <header class="page-header">
        <h1>Listen Again</h1>
    </header>

    <div class="podcast-grid">
        <?php foreach ($podcasts as $p): ?>
            <article class="podcast-card">
                <?php if (!empty($p['image'])): ?>
                    <div class="podcast-thumb">
                        <img src="<?= e($p['image']) ?>" alt="<?= e($p['title']) ?>">
                    </div>
                <?php endif; ?>
                <div class="podcast-body">
                    <p class="podcast-meta">
                        <?php if ($p['show_title']): ?>
                            <?= e($p['show_title']) ?> •
                        <?php endif; ?>
                        <?= date('D, j M Y', strtotime($p['published_at'])) ?>
                    </p>
                    <h2><?= e($p['title']) ?></h2>
                    <p><?= e(mb_substr($p['description'], 0, 120)) ?>...</p>
                    <audio controls preload="none">
                        <source src="<?= e($p['audio_url']) ?>" type="audio/mpeg">
                    </audio>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
