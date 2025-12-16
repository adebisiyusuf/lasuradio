<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
include __DIR__ . '/../includes/header.php';

$stationSlug = $_GET['station'] ?? 'lagos';
$station = getStationBySlug($pdo, $stationSlug);
if (!$station) $station = getStationBySlug($pdo, 'lagos');

$stmt = $pdo->prepare("SELECT * FROM presenters WHERE station_id = :sid ORDER BY name");
$stmt->execute(['sid' => $station['id']]);
$presenters = $stmt->fetchAll();

$pageTitle = 'Presenters - ' . $station['name'];
$pageSlug  = 'presenters';

?>
<section class="presenters-page">
  <header class="page-header">
    <h1>Presenters</h1>
  </header>
  <div class="card-grid">
    <?php foreach ($presenters as $p): ?>
      <article class="news-card">
        <?php if (!empty($p['image'])): ?>
          <div class="news-thumb">
          <img src="<?= htmlspecialchars($baseUrl . 'uploads/' . $p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy"
          >
          
          </div>
        <?php endif; ?>
        <div class="news-body">
          <h3><?= e($p['name']) ?></h3>
          <p><?= e(mb_substr($p['bio'],0,120)) ?>...</p>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
