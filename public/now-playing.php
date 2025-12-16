<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$stationSlug = $_GET['station'] ?? 'ph';
$station = getStationBySlug($pdo, $stationSlug);
if (!$station) $station = getStationBySlug($pdo, 'ph');

$days = ['sat','sun','mon','tue','wed','thu','fri']; // show Saturday first like sample
$currentDayKey = strtolower(substr(date('D'), 0, 3));

$pageTitle = 'Now Playing - ' . $station['name'];
$pageSlug  = 'now-playing';

include __DIR__ . '/../includes/header.php';
?>

<section class="now-playing-page">
    <header class="page-header">
        <h1>Now Playing</h1>
        <p>You are viewing content from <?= e($station['city']) ?>.</p>
    </header>

    <div class="day-tabs">
        <?php foreach ($days as $d): ?>
            <?php
            $label = ucfirst($d);
            $active = ($d === $currentDayKey) ? 'active' : '';
            ?>
            <button class="day-tab <?= $active ?>" data-day="<?= $d ?>"><?= $label ?></button>
        <?php endforeach; ?>
    </div>

    <div id="daySchedules">
        <?php foreach ($days as $d): ?>
            <?php
            $stmt = $pdo->prepare("
                SELECT sch.*, sh.title, sh.description
                FROM schedule sch
                JOIN shows sh ON sch.show_id = sh.id
                WHERE sch.station_id = :sid AND sch.day_of_week = :day
                ORDER BY sch.start_time
            ");
            $stmt->execute(['sid' => $station['id'], 'day' => $d]);
            $rows = $stmt->fetchAll();
            ?>
            <div class="day-panel <?= $d === $currentDayKey ? 'active' : '' ?>" data-day="<?= $d ?>">
                <?php foreach ($rows as $row): ?>
                    <article class="schedule-row">
                        <div class="schedule-time">
                            <?= substr($row['start_time'],0,5) ?>
                        </div>
                        <div class="schedule-body">
                            <h2><?= e($row['title']) ?></h2>
                            <p><?= e(mb_substr($row['description'], 0, 140)) ?>...</p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
