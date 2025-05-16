<?php
require 'db.php';

$imageName = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);

$collection->insertOne([
  'title' => $_POST['title'],
  'lyrics' => $_POST['lyrics'],
  'image' => $imageName,
  'favorite' => isset($_POST['favorite'])
]);

header("Location: index.php");
?>
