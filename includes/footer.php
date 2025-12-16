<?php // includes/footer.php ?>
</main>

<footer class="site-footer">
    <div class="footer-top">
        <div class="footer-about">
            <h4>LASU Radio 95.7FM</h4>
            <p>Your Lively and Solidly Unique Radio Station.</p>
        </div>
        <div class="footer-links">
            <h4>Navigation</h4>
            <ul>
                <li><a href="index.php?station=<?= e($station['slug']) ?>">Home</a></li>
                <li><a href="news.php?station=<?= e($station['slug']) ?>">News</a></li>
                <li><a href="shows.php?station=<?= e($station['slug']) ?>">Top Shows</a></li>
                <li><a href="podcasts.php?station=<?= e($station['slug']) ?>">Podcasts</a></li>
                <li><a href="contact.php?station=<?= e($station['slug']) ?>">Contact</a></li>
            </ul>
        </div>
        <div class="footer-social">
            <h4>Follow Us</h4>
            <div class="social-icons">
                <a href="#" aria-label="Facebook">Facebook</a>
                <a href="#" aria-label="X">X</a>
                <a href="#" aria-label="Instagram">Instagram</a>
                <a href="#" aria-label="YouTube">Youtube</a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> LASU Radio 95.7 FM. All Rights Reserved.</p>
    </div>
</footer>

<?php
$basePath = strpos($_SERVER['REQUEST_URI'], '/admin') !== false ? '../' : '';
?>

<?php if ($pageSlug === 'about'): ?>
<script src="public/assets/js/about-animate.js"></script>
<?php endif; ?>

<script src="<?= $baseUrl ?>public/assets/js/main.js"></script>
<script src="<?= $baseUrl ?>public/assets/js/player.js"></script>



</body>
</html>
