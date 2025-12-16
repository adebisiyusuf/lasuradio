<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$stationSlug = $_GET['station'] ?? 'lagos';
$station = getStationBySlug($pdo, $stationSlug);
if (!$station) $station = getStationBySlug($pdo, 'lagos');

$pageTitle = 'Listen Live - ' . $station['name'];
$pageSlug  = 'player';

include __DIR__ . '/../includes/header.php';
?>

<section class="player-page">
    <h1>Listen Live</h1>

    <div class="player-container">
        <audio id="livePlayerMain" controls autoplay>
            <source src="https://your-stream-url.example.com/stream" type="audio/mpeg">
        </audio>
        <button id="muteToggle" class="btn-primary">Mute</button>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
