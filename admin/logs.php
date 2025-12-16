<?php
require_once __DIR__ . '/includes/header.php';
require_role($pdo, 'super');
$logs = $pdo->query("SELECT l.*, a.username FROM activity_logs l JOIN admins a ON l.admin_id = a.id ORDER BY l.created_at DESC LIMIT 200")->fetchAll();
?>
<h1>Activity Logs</h1>
<table class="admin-table">
  <tr><th>Time</th><th>Admin</th><th>Action</th><th>Details</th></tr>
  <?php foreach($logs as $log): ?>
    <tr>
      <td><?= htmlspecialchars($log['created_at']) ?></td>
      <td><?= htmlspecialchars($log['username']) ?></td>
      <td><?= htmlspecialchars($log['action']) ?></td>
      <td><?= htmlspecialchars($log['details']) ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
