<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$slug = $_GET['slug'] ?? '';
$stmt = $pdo->prepare("SELECT a.*, s.city FROM articles a JOIN stations s ON a.station_id = s.id WHERE a.slug = ?");
$stmt->execute([$slug]);
$article = $stmt->fetch();

if (!$article) {
    die("Article not found");
}

$pageTitle = $article['title'];
$pageSlug  = 'article';

include __DIR__ . '/includes/header.php';
?>

<section class="article-page">
    <article class="article-card">
        <p class="article-meta">
            <?= strtoupper($article['category']) ?> • <?= $article['city'] ?> •
            <?= date('D, j M Y H:i', strtotime($article['published_at'])) ?>
        </p>

        <h1><?= e($article['title']) ?></h1>

        <?php if (!empty($article['image'])): ?>
            <img src="/uploads/<?= e($article['image']) ?>" class="article-image">
        <?php endif; ?>

        <div class="article-content">
            <?= nl2br(e($article['body'])) ?>
        </div>
    </article>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
