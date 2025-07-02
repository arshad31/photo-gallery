<?php
include 'includes/header.php';
include 'includes/config.php';

$sql = "SELECT * FROM image ORDER BY upload_date DESC";

$stmt = $pdo->query($sql);
$images = $stmt->fetchAll();
?>
<div class="my-5-text-center">
    <h1 class="display-4">Photo Gallary</h1>
    <p class="lead">Latest Uploaded Image</p>
</div>
<div class="row">
  <?php foreach($images as $image):?>
  <div class="card" style="width: 18rem;">
  <img src="assets/images/<?php echo htmlspecialchars($image['filename']);?>" class="card-img-top" alt="<?php echo htmlspecialchars($image['title']);?>">
  <div class="card-body">
    <h5 class="card-title"><?php echo htmlspecialchars($image['title']);?></h5>
    <p class="text-muted small">Uploaded On: <?php echo date("F j, Y", strtotime($image['upload_date']));?>  </p>
    <p class="card-text"> <?php echo htmlspecialchars($image['description']);?></p>
  </div>
</div>
<?php endforeach;?>
</div>
<?php
include 'includes/footer.php';
?>