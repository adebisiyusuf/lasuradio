<?php
// includes/functions.php

function getStationBySlug(PDO $pdo, $slug = 'lagos') {
    $stmt = $pdo->prepare("SELECT * FROM stations WHERE slug = :slug");
    $stmt->execute(['slug' => $slug]);
    return $stmt->fetch();
}

function getTopShows(PDO $pdo, $stationId, $limit = 7) {
    $stmt = $pdo->prepare("SELECT * FROM shows WHERE station_id = :sid AND is_top_show = 1 LIMIT :lim");
    $stmt->bindValue(':sid', $stationId, PDO::PARAM_INT);
    $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getLatestArticles(PDO $pdo, $stationId, $category = null, $limit = 6) {
    $sql = "SELECT * FROM articles WHERE station_id = :sid";
    $params = ['sid' => $stationId];

    if ($category) {
        $sql .= " AND category = :cat";
        $params['cat'] = $category;
    }

    $sql .= " ORDER BY published_at DESC LIMIT :lim";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':sid', $stationId, PDO::PARAM_INT);
    if ($category) {
        $stmt->bindValue(':cat', $category, PDO::PARAM_STR);
    }
    $stmt->bindValue(':lim', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getOnAirNow(PDO $pdo, $stationId) {
    $nowDay = strtolower(date('D')); // mon, tue…
    $map = ['mon','tue','wed','thu','fri','sat','sun'];
    $day = substr($nowDay, 0, 3);
    if (!in_array($day, $map)) {
        $day = 'mon';
    }

    $time = date('H:i:s');

    $sql = "
        SELECT s.*, sh.title AS show_title, sh.description AS show_description
        FROM schedule s
        JOIN shows sh ON s.show_id = sh.id
        WHERE s.station_id = :sid
          AND s.day_of_week = :day
          AND :time BETWEEN s.start_time AND s.end_time
        LIMIT 1
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'sid' => $stationId,
        'day' => $day,
        'time' => $time
    ]);

    return $stmt->fetch();
}

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
