<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $imageName = $_FILES['image']['name'];
    $audioName = $_FILES['audio']['name'];
    
    move_uploaded_file($_FILES['image']['tmp_name'], "upload/$imageName");
    move_uploaded_file($_FILES['audio']['tmp_name'], "upload/$audioName");
    
    addSong($_POST, $imageName, $audioName);
    
    header("Location: admin.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin - Add Song</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Include custom styles here or in style.css */

    body {
      background: url('css/aaadhi.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      position: relative;
      min-height: 100vh;
    }

    body::after {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
      z-index: -1;
    }

    .container {
      max-width: 600px;
      margin: 50px auto;
      background: rgba(34, 34, 34, 0.85);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 255, 255, 0.4);
    }

    h1 {
      text-align: center;
      color: #00f0ff;
      margin-bottom: 25px;
    }

    .add-form input[type="text"],
    .add-form textarea {
      width: 100%;
      margin-bottom: 15px;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      resize: vertical;
    }

    /* Hide native file inputs */
    .add-form input[type="file"] {
      display: none;
    }

    /* Custom styled file upload buttons */
    .custom-file-upload {
      display: inline-block;
      padding: 12px 25px;
      margin-bottom: 15px;
      color: #000;
      background-color: #00f0ff;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
      user-select: none;
    }
    .custom-file-upload:hover {
      background-color: #00b8cc;
    }

    button[name="add"] {
      background: #00f0ff;
      color: #000;
      padding: 14px 30px;
      border: none;
      border-radius: 8px;
      font-size: 18px;
      cursor: pointer;
      font-weight: 700;
      width: 100%;
      margin-top: 10px;
      transition: background-color 0.3s ease;
    }
    button[name="add"]:hover {
      background-color: #00b8cc;
    }

    p.logout {
      text-align: center;
      margin-top: 20px;
    }
    p.logout a {
      color: red;
      font-weight: 700;
      text-decoration: none;
    }
    p.logout a:hover {
      text-decoration: underline;
    }
    
    p.back-home {
      text-align: center;
      margin-top: 15px;
    }
    p.back-home a {
      color: #00f0ff;
      text-decoration: none;
      font-weight: 600;
    }
    p.back-home a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Add New Song</h1>

    <form method="POST" enctype="multipart/form-data" class="add-form">
      <input type="text" name="title" placeholder="Song Title" required />
      <input type="text" name="artist" placeholder="Artist" required />
      <input type="text" name="album" placeholder="Album (e.g., Anirudh)" required />
      <textarea name="lyrics" placeholder="Lyrics" rows="5" required></textarea>

      <label class="custom-file-upload">
        Choose Image
        <input type="file" name="image" accept="image/*" required />
      </label>

      <label class="custom-file-upload">
        Choose MP3
        <input type="file" name="audio" accept="audio/*" required />
      </label>

      <button name="add" type="submit">Add Song</button>
    </form>

    <p class="logout"><a href="admin.php?logout=true">Logout</a></p>
    <p class="back-home"><a href="index.php">Back to Music Player</a></p>
  </div>
</body>
</html>
