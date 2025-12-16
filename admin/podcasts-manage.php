<?php
require_once "../config/db.php";
require_once "includes/header.php";

if($_POST){
    $title = $_POST['title'];
    $show = $_POST['show'];
    $station = $_POST['station'];
    $desc = $_POST['description'];
    $slug = strtolower(str_replace(' ','-',$title));

    $audio = $_FILES['audio']['name'];
    move_uploaded_file($_FILES['audio']['tmp_name'], "../uploads/".$audio);

    $pdo->prepare("INSERT INTO podcasts
    (station_id,show_id,title,slug,description,audio_url,published_at)
    VALUES (?,?,?,?,?,?,NOW())")
    ->execute([$station,$show,$title,$slug,$desc,$audio]);
}

$pods = $pdo->query("SELECT * FROM podcasts ORDER BY id DESC")->fetchAll();
?>

<h2>Manage Podcasts</h2>

<form method="post" enctype="multipart/form-data" class="admin-form">
    <input name="title" placeholder="Podcast Title">
    <textarea name="description"></textarea>

    <select name="show">
        <?php
        $shows = $pdo->query("SELECT * FROM shows")->fetchAll();
        foreach($shows as $s){
            echo "<option value='{$s['id']}'>{$s['title']}</option>";
        }
        ?>
    </select>

    <select name="station">
        <option value="1">Lagos, Ojo</option>
        
    </select>

    <input type="file" name="audio">
    <button>Add Podcast</button>
</form>

<table class="admin-table">
<tr><th>Title</th><th>Audio</th></tr>
<?php foreach($pods as $p): ?>
<tr>
<td><?= $p['title'] ?></td>
<td><?= $p['audio_url'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php require_once "includes/footer.php"; ?>
