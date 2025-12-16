<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';


$stationSlug = $_GET['station'] ?? 'lagos';
$station     = getStationBySlug($pdo, $stationSlug);
if (!$station) {
    $station = getStationBySlug($pdo, 'lagos');
}

$onAir   = getOnAirNow($pdo, $station['id'] ?? 1);
$latestNews   = getLatestArticles($pdo, $station['id'], null, 6);
$latestTalk   = getLatestArticles($pdo, $station['id'], 'talk', 3);
$latestSports = getLatestArticles($pdo, $station['id'], 'sports', 3);
$topShows     = getTopShows($pdo, $station['id'], 7);

$pageTitle = $station['name'] . ' - LASU Radio, Solidly Unique Campus Radio!';
$pageSlug  = 'home';

include __DIR__ . '/../includes/header.php';
?>

<section class="hero">
    <div class="hero-left">
        <h1><?= e($station['name']) ?></h1>
        <?php if ($onAir): ?>
            <p class="on-air-label">On Air Now</p>
            <h2 class="on-air-show"><?= e($onAir['show_title']) ?></h2>
            <p class="on-air-time">
                <?= substr($onAir['start_time'],0,5) ?> - <?= substr($onAir['end_time'],0,5) ?>
            </p>
            <p class="on-air-desc">
                <?= e(mb_substr($onAir['show_description'], 0, 120)) ?>...
            </p>
        <?php else: ?>
            <p class="on-air-label">On Air Now</p>
            <h2 class="on-air-show">Live Programming</h2>
            <p class="on-air-time">24/7</p>
        <?php endif; ?>

        <a href="/player.php?station=<?= e($station['slug']) ?>" class="btn-primary">
            Listen Live
        </a>
    </div>

    <div class="hero-right">
        <div class="player-card">
            <h3>Live Stream</h3>
            <audio id="livePlayer" controls>
                <!-- Replace with your real streaming URL -->
                <source src="https://your-stream-url.example.com/stream" type="audio/mpeg">
                Your browser does not support HTML5 audio.
            </audio>
            <div class="player-contact">
                <p>Call: 0812 320 9760</p>
                <p>WhatsApp: 0805 5555 957</p>
            </div>
        </div>
    </div>
</section>

<section class="home-latest-news">
    <div class="section-header">
        <h2>Latest News</h2>
        <a href="/news.php?station=<?= e($station['slug']) ?>" class="view-all">View all</a>
    </div>
    <div class="card-grid">
        <?php foreach ($latestNews as $article): ?>
            <article class="news-card">
                <?php if (!empty($article['image'])): ?>
                    <div class="news-thumb">
                        <img src="<?= e($article['image']) ?>" alt="<?= e($article['title']) ?>">
                    </div>
                <?php endif; ?>
                <div class="news-body">
                    <p class="news-meta">
                        <?= strtoupper($article['category']) ?> •
                        <?= date('D, j M Y', strtotime($article['published_at'])) ?>
                    </p>
                    <h3>
                        <a href="/article.php?slug=<?= e($article['slug']) ?>">
                            <?= e($article['title']) ?>
                        </a>
                    </h3>
                    <p><?= e(mb_substr($article['excerpt'], 0, 120)) ?>...</p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="home-columns">
    <div class="col">
        <div class="section-header">
            <h2>Talk</h2>
            <a href="/news.php?station=<?= e($station['slug']) ?>&category=talk" class="view-all">View all</a>
        </div>
        <?php foreach ($latestTalk as $article): ?>
            <article class="mini-article">
                <h3>
                    <a href="/article.php?slug=<?= e($article['slug']) ?>">
                        <?= e($article['title']) ?>
                    </a>
                </h3>
                <p><?= e(mb_substr($article['excerpt'], 0, 90)) ?>...</p>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="col">
        <div class="section-header">
            <h2>Sports</h2>
            <a href="/news.php?station=<?= e($station['slug']) ?>&category=sports" class="view-all">View all</a>
        </div>
        <?php foreach ($latestSports as $article): ?>
            <article class="mini-article">
                <h3>
                    <a href="/article.php?slug=<?= e($article['slug']) ?>">
                        <?= e($article['title']) ?>
                    </a>
                </h3>
                <p><?= e(mb_substr($article['excerpt'], 0, 90)) ?>...</p>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="col">
        <div class="section-header">
            <h2>Top Shows</h2>
            <a href="/shows.php?station=<?= e($station['slug']) ?>" class="view-all">View all</a>
        </div>
        <ul class="show-list">
            <?php foreach ($topShows as $show): ?>
                <li>
                    <a href="/show.php?slug=<?= e($show['slug']) ?>">
                        <?= e($show['title']) ?>
                    </a>
                    <?php if (!empty($show['schedule'])): ?>
                        <span class="show-time"><?= e($show['schedule']) ?></span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
