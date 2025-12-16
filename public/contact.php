<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';

$stationSlug = $_GET['station'] ?? 'lagos';
$station = getStationBySlug($pdo, $stationSlug);
if (!$station) $station = getStationBySlug($pdo, 'lagos');

$errors = [];
$sent = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '')   $errors[] = 'Name is required.';
    if ($email === '')  $errors[] = 'Email is required.';
    if ($message === '')$errors[] = 'Message is required.';

    if (!$errors) {
        // In real app, save to DB or send email
        $sent = true;
    }
}

$pageTitle = 'Contact Us - ' . $station['name'];
$pageSlug  = 'contact';

include __DIR__ . '/../includes/header.php';
?>

<section class="contact-page">
    <header class="page-header">
        <h1>Contact Us</h1>
        <p>Get in touch with LASU Radio 95.7FM <?= e($station['city']) ?>.</p>
    </header>

    <div class="contact-layout">
        <div class="contact-form-card">
            <?php if ($sent): ?>
                <div class="alert success">
                    Thank you for reaching out. We will get back to you shortly.
                </div>
            <?php endif; ?>

            <?php if ($errors): ?>
                <div class="alert error">
                    <ul>
                        <?php foreach ($errors as $err): ?>
                            <li><?= e($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="field">
                    <label for="name">Full Name</label>
                    <input id="name" name="name" type="text" value="<?= e($_POST['name'] ?? '') ?>">
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="<?= e($_POST['email'] ?? '') ?>">
                </div>

                <div class="field">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5"><?= e($_POST['message'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn-primary">Send Message</button>
            </form>
        </div>

        <aside class="contact-info">
            <h2>Studio Contacts</h2>
            <p>Call: 0812 320 9760</p>
            <p>SMS / WhatsApp: 0805 5555 957</p>
            <h3>Address</h3>
            <p>Lagos State University Ojo, Lagos, Nigeria.</p>
        </aside>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
