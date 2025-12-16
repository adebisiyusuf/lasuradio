<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$stationSlug = $_GET['station'] ?? 'lagos';
$station = getStationBySlug($pdo, $stationSlug);
if (!$station) $station = getStationBySlug($pdo, 'lagos');

$category = $_GET['category'] ?? null;
if (!in_array($category, ['news','talk','sports'])) {
    $category = null;
}

$articles = getLatestArticles($pdo, $station['id'], $category, 30);

$pageTitle = 'News - ' . $station['name'];
$pageSlug  = 'news';

include __DIR__ . '/../includes/header.php';
?>

<section class="news-page">
    <header class="page-header">
        <h1>
            <?php
            if ($category === 'talk') echo 'Talk';
            elseif ($category === 'sports') echo 'Sports';
            else echo 'News';
            ?>
        </h1>
        <div class="filters">
            <a href="?station=<?= e($station['slug']) ?>" class="<?= $category===null?'active':'' ?>">All</a>
            <a href="?station=<?= e($station['slug']) ?>&category=news" class="<?= $category==='news'?'active':'' ?>">News</a>
            <a href="?station=<?= e($station['slug']) ?>&category=talk" class="<?= $category==='talk'?'active':'' ?>">Talk</a>
            <a href="?station=<?= e($station['slug']) ?>&category=sports" class="<?= $category==='sports'?'active':'' ?>">Sports</a>
        </div>
    </header>

    <div class="news-list">
        <?php foreach ($articles as $article): ?>
            <article class="news-row">
                <?php if (!empty($article['image'])): ?>
                    <div class="news-row-thumb">
                        <img src="<?= e($article['image']) ?>" alt="<?= e($article['title']) ?>">
                    </div>
                <?php endif; ?>
                <div class="news-row-body">
                    <p class="news-meta">
                        <?= strtoupper($article['category']) ?> •
                        <?= date('D, j M Y H:i', strtotime($article['published_at'])) ?>
                    </p>
                    <h2>
                        <a href="/article.php?slug=<?= e($article['slug']) ?>">
                            <?= e($article['title']) ?>
                        </a>
                    </h2>
                    <p><?= e(mb_substr($article['excerpt'], 0, 180)) ?>...</p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
