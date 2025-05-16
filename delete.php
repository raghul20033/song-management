<?php
require 'db.php';
$collection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($_GET['id'])]);
header("Location: index.php");
?>
