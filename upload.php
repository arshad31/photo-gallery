<?php
include 'includes/header.php';
include 'includes/config.php';

$error = '';
$success = '';
//$pdo = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $title = $_POST['title'];
  $description = $_POST['description'];
  $image = $_FILES['image'];

  if(empty($title) || empty($description)){
    $error = "Please full-up all fields";
  }
  $target_dir = 'assets/images/';
  $file = $image['name'];
  $new_name = uniqid().$file;
  $target_file = $target_dir.$new_name;
  if($image['size'] > 5000000){
    $error = 'File size too large';
  }
  else{
    if(move_uploaded_file($image['tmp_name'], $target_file)){
      $sql = "INSERT INTO image (title, description, filename) VALUES (:title, :description, :filename)";
      $stmt = $pdo->prepare($sql);
      $stmt -> execute([
        ':title' => $title,
        ':description' => $description,
        ':filename' => $new_name
      ]);
      $success = 'Image Uploaded Successfully';
      $title = "";
      $description = "";
    }
    else{
      $error = 'Error Uploading Image';
    }
  }

}
?>
<div class="my-4">
  <h1>Photo Galary</h1>
</div>
<?php if($success):?>
  <div class = "alart alart-success" role = "alert">
      <?php echo $success; ?>
  </div>
  <?php endif; ?>
  <?php if($error):?>
  <div class = "alart alart-danger" role = "alert">
      <?php echo $error; ?>
  </div>
  <?php endif; ?>
<div class="row">
    <form action="upload.php" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
  </div>
  <div class="mb-3 ">
     <label class="form-label" for="image">Select Image File</label>
    <input type="file" class="form-control" id="image" name="image" accept="image/*">
   
  </div>
  <button type="submit" class="btn btn-primary">Upload Image</button>
</form>
</div>





<?php
include 'includes/footer.php';
?>