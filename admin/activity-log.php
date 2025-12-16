
<?php
require_once "../config/db.php";
require_once "includes/header.php";

$logs = $pdo->query("SELECT * FROM activity_logs ORDER BY created_at DESC")->fetchAll();
?>

<h2>Activity Logs</h2>
<table class="admin-table">
<tr><th>Admin</th><th>Action</th><th>Date</th></tr>
<?php foreach($logs as $l): ?>
<tr><td><?= $l['admin_id'] ?></td><td><?= $l['action'] ?></td><td><?= $l['created_at'] ?></td></tr>
<?php endforeach; ?>
</table>

<?php require_once "includes/footer.php"; ?>
