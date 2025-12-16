<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
include __DIR__ . '/../includes/header.php';

//$slug = $_GET['slug'] ?? '';

//$stmt = $pdo->prepare("SELECT p.*, s.city FROM presenters p JOIN stations s ON p.station_id = s.id WHERE p.slug = ?");
//$stmt->execute([$slug]);
//$presenter = $stmt->fetch();

$slug = $_GET['slug'] ?? '';

$stmt = $pdo->prepare("
    SELECT p.*, s.city 
    FROM presenters p
    LEFT JOIN stations s ON p.station_id = s.id
    WHERE p.slug = ?
");
$stmt->execute([$slug]);
$presenter = $stmt->fetch();

if (!$presenter) {
    die("Presenter not found");
}


$pageTitle = $presenter['name'];
$pageSlug  = 'presenter';


?>

<section class="presenter-page">
    <div class="presenter-card">
        
        <img src="uploads/<?= htmlspecialchars($presenter['image']) ?>" class="presenter-photo">
        <div class="presenter-info">
            <h1><?= e($presenter['name']) ?></h1>
            <p class="presenter-meta"><?= e($presenter['city']) ?></p>

            <div class="presenter-bio">
                <?= nl2br(e($presenter['bio'])) ?>
            </div>

            <?php if (!empty($presenter['twitter_handle'])): ?>
                <p>
                    <a href="https://twitter.com/<?= e($presenter['twitter_handle']) ?>" target="_blank">
                        Follow on X
                    </a>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
