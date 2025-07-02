<?php
include 'includes/header.php';
include 'includes/config.php';

$sql = "SELECT * FROM image ORDER BY upload_date DESC";

$stmt = $pdo->query($sql);
$images = $stmt->fetchAll();
?>

<div class="container py-4">
    <h2 class="text-center mb-4">Photo Gallery</h2>
    <div class="row g-4">
      <?php foreach($images as $image):?>
      <div class="col-md-3">
        <div class="card h-100">
          <img src="assets/images/<?php echo htmlspecialchars($image['filename']);?>" class="card-img-top" alt="<?php echo htmlspecialchars($image['title']);?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($image['title']);?></h5>
            <p class="text-muted small mb-1">Uploaded On: <?php echo date("F j, Y", strtotime($image['upload_date']));?></p>
            <p class="card-text"><?php echo htmlspecialchars($image['description']);?></p>
          </div>
        </div>
      </div>
      <?php endforeach;?>

    </div>
  </div>

<?php
include 'includes/footer.php';
?>