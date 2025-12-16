<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/functions.php';
include __DIR__ . '/../includes/header.php';
$pageTitle = 'Rate Card';
$pageSlug  = 'rate-card';

?>

<section class="rate-card-page">
    <h1>Advertising Rate Card</h1>

    <table class="rate-table">
        <tr>
            <th>Slot</th>
            <th>Duration</th>
            <th>Price (₦)</th>
        </tr>
        <tr>
            <td>Breakfast Show</td>
            <td>30 secs</td>
            <td>15,000</td>
        </tr>
        <tr>
            <td>Midday Show</td>
            <td>30 secs</td>
            <td>30,000</td>
        </tr>
        <tr>
            <td>Evening Drive</td>
            <td>30 secs</td>
            <td>18,000</td>
        </tr>
        <tr>
            <td>Sponsored Program</td>
            <td>60 secs</td>
            <td>150,000</td>
        </tr>
    </table>

    <p class="rate-note">
        For custom packages and long-term partnerships, please contact our sales team.
    </p>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
