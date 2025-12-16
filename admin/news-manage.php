<?php
require_once "../config/db.php";
require_once "includes/header.php";

if ($_POST) {
    $title = $_POST['title'];
    $slug = strtolower(str_replace(' ','-',$title));
    $excerpt = $_POST['excerpt'];
    $body = $_POST['body'];
    $category = $_POST['category'];
    $station = $_POST['station'];
    $date = date("Y-m-d H:i:s");

    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/" . $img);

    $stmt = $pdo->prepare("INSERT INTO articles 
    (station_id,category,title,slug,excerpt,body,image,published_at)
    VALUES (?,?,?,?,?,?,?,?)");

    $stmt->execute([$station,$category,$title,$slug,$excerpt,$body,$img,$date]);
}

$rows = $pdo->query("SELECT * FROM articles ORDER BY id DESC")->fetchAll();
?>

<h2>Manage News</h2>

<form method="post" enctype="multipart/form-data" class="admin-form">
    <input name="title" placeholder="Title" required>
    <textarea name="excerpt" placeholder="Excerpt"></textarea>
    <textarea name="body" placeholder="Full content"></textarea>

    <select name="category">
        <option value="news">News</option>
        <option value="talk">Talk</option>
        <option value="sports">Sports</option>
    </select>

    <select name="station">
        <option value="1">Lagos, Ojo</option>        
    </select>

    <input type="file" name="image">
    <button type="submit">Post News</button>
</form>

<table class="admin-table">
<tr><th>Title</th><th>Category</th><th>Delete</th></tr>
<?php foreach($rows as $r): ?>
<tr>
<td><?= $r['title'] ?></td>
<td><?= $r['category'] ?></td>
<td>
    <a href="?delete=<?= $r['id'] ?>" class="danger">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</table>

<?php
if(isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM articles WHERE id=?")->execute([$_GET['delete']]);
    header("Location: news-manage.php");
}
require_once "includes/footer.php";
