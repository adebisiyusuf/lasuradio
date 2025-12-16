<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$stationSlug = $_GET['station'] ?? 'lagos';
$station = getStationBySlug($pdo, $stationSlug);
if (!$station) $station = getStationBySlug($pdo, 'lagos');

$stmt = $pdo->prepare("SELECT * FROM shows WHERE station_id = :sid ORDER BY title");
$stmt->execute(['sid' => $station['id']]);
$shows = $stmt->fetchAll();

$pageTitle = 'Top Shows - ' . $station['name'];
$pageSlug  = 'shows';

include __DIR__ . '/../includes/header.php';

?>
<section class="shows-page">
  <header class="page-header">
    <h1>Top Shows</h1>
  </header>
  <div class="card-grid">
    <?php foreach ($shows as $s): ?>
      <article class="news-card">
        <?php if (!empty($s['image'])): ?>
          <div class="news-thumb">
            <img src="/uploads/<?= e($s['image']) ?>" alt="<?= e($s['title']) ?>">
          </div>
        <?php endif; ?>
        <div class="news-body">
          <h3><?= e($s['title']) ?></h3>
          <p><?= e(mb_substr($s['description'],0,120)) ?>...</p>
          <?php if (!empty($s['schedule'])): ?>
            <p class="news-meta"><?= e($s['schedule']) ?></p>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
