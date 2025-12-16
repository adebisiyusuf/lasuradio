<?php
require_once "../config/db.php";
require_once "includes/header.php";

if($_POST){
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $schedule = $_POST['schedule'];
    $station = $_POST['station'];
    $slug = strtolower(str_replace(' ','-',$title));

    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$img);

    $pdo->prepare("INSERT INTO shows
    (station_id,title,slug,description,schedule,image)
    VALUES (?,?,?,?,?,?)")
    ->execute([$station,$title,$slug,$desc,$schedule,$img]);
}

$shows = $pdo->query("SELECT * FROM shows ORDER BY id DESC")->fetchAll();
?>

<h2>Manage Shows</h2>

<form method="post" enctype="multipart/form-data" class="admin-form">
    <input name="title" placeholder="Show Title">
    <textarea name="description"></textarea>
    <input name="schedule" placeholder="Mon–Fri 6am–9am">
    <select name="station">
        <option value="1">Lagos, Ojo</option>
        
    </select>
    <input type="file" name="image">
    <button>Add Show</button>
</form>

<table class="admin-table">
<tr><th>Title</th><th>Schedule</th></tr>
<?php foreach($shows as $s): ?>
<tr>
<td><?= $s['title'] ?></td>
<td><?= $s['schedule'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php require_once "includes/footer.php"; ?>
