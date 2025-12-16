<?php
require_once __DIR__ . '/includes/header.php'; // this already loads $pdo and auth

// Handle create presenter
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $bio     = trim($_POST['bio'] ?? '');
    $twitter = trim($_POST['twitter'] ?? '');
    $station = (int)($_POST['station'] ?? 1);

    // Generate slug from name
    $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name));
    $slug = trim($slug, '-');

    // Handle image upload
    $imageName = null;
    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        $originalName = basename($_FILES['image']['name']);
        $ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $safeBase = preg_replace('/[^A-Za-z0-9_-]/', '', pathinfo($originalName, PATHINFO_FILENAME));
        if ($safeBase === '') {
            $safeBase = 'presenter';
        }

        $imageName = time() . '_' . $safeBase . '.' . $ext;

        if (is_uploaded_file($_FILES['image']['tmp_name'])) {
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        }
    }

    $stmt = $pdo->prepare("
        INSERT INTO presenters (station_id, name, slug, bio, image, twitter_handle)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$station, $name, $slug, $bio, $imageName, $twitter]);

    header("Location: presenters-manage.php?ok=1");
    exit;
}

// Fetch presenters list
$presenters = $pdo->query("
    SELECT p.*, s.city 
    FROM presenters p
    LEFT JOIN stations s ON p.station_id = s.id
    ORDER BY s.city, p.name
")->fetchAll();
?>

<h1>Manage Presenters</h1>

<?php if (!empty($_GET['ok'])): ?>
    <p class="alert success">Presenter created successfully.</p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" class="admin-form">
    <input name="name" placeholder="Presenter Name" required>

    <textarea name="bio" class="wysiwyg" placeholder="Bio"></textarea>

    <input name="twitter" placeholder="@handle (optional)">

    <select name="station">
        <option value="1">Lagos</option>
        
        <!-- adjust station IDs to match your DB -->
    </select>

    <input type="file" name="image" accept="image/*">

    <?php csrf_field(); ?>
    <button type="submit">Add Presenter</button>
</form>

<table class="admin-table">
    <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Station</th>
        <th>Twitter</th>
    </tr>
    <?php foreach ($presenters as $p): ?>
        <tr>
            <td>
                <?php if (!empty($p['image'])): ?>
                    <img src="../uploads/<?= htmlspecialchars($p['image']) ?>" alt="" style="width:50px;height:50px;object-fit:cover;border-radius:50%;">
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['city'] ?? '') ?></td>
            <td><?= htmlspecialchars($p['twitter_handle'] ?? '') ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
