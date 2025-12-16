
<?php
require_once "../config/db.php";
require_once "includes/header.php";

if($_POST){
  $station = $_POST['station'];
  $show = $_POST['show'];
  $day = $_POST['day'];
  $start = $_POST['start'];
  $end = $_POST['end'];

  $pdo->prepare("INSERT INTO schedule (station_id,show_id,day_of_week,start_time,end_time)
  VALUES (?,?,?,?,?)")->execute([$station,$show,$day,$start,$end]);
}

$schedules = $pdo->query("SELECT * FROM schedule ORDER BY id DESC")->fetchAll();
$shows = $pdo->query("SELECT * FROM shows")->fetchAll();
?>

<h2>Manage Schedule</h2>
<form method="post" class="admin-form">
<select name="station">
<option value="1">Lagos</option><option value="2">Abuja</option><option value="3">PH</option>
</select>
<select name="show">
<?php foreach($shows as $s){echo "<option value='{$s['id']}'>{$s['title']}</option>";} ?>
</select>
<select name="day">
<option>mon</option><option>tue</option><option>wed</option><option>thu</option><option>fri</option><option>sat</option><option>sun</option>
</select>
<input name="start" type="time">
<input name="end" type="time">
<button>Add Schedule</button>
</form>

<table class="admin-table">
<tr><th>Station</th><th>Show</th><th>Day</th><th>Time</th></tr>
<?php foreach($schedules as $sc): ?>
<tr>
<td><?= $sc['station_id'] ?></td>
<td><?= $sc['show_id'] ?></td>
<td><?= $sc['day_of_week'] ?></td>
<td><?= $sc['start_time'] ?> - <?= $sc['end_time'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php require_once "includes/footer.php"; ?>
