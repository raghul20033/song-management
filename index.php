<?php
session_start();
require 'functions.php';

// Albums you want to show
$albums = ['Anirudh', 'GV Prakash', 'U1 Drugs', 'Hip Hop Aadhi', 'Harris Jayaraj'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Music Player - Albums</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Some custom styling for album display */
    .album-section {
      margin-bottom: 40px;
    }
    .album-title {
      color: #00f0ff;
      font-size: 2rem;
      margin-bottom: 10px;
      border-bottom: 2px solid #00f0ff;
      padding-bottom: 5px;
    }
    .song-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .song-card {
      background: rgba(42, 42, 42, 0.8);
      padding: 15px;
      border-radius: 10px;
      width: 220px;
      text-align: center;
      color: #fff;
      position: relative;
    }
    .song-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-radius: 6px;
      margin-bottom: 10px;
    }
    audio {
      width: 100%;
      outline: none;
    }
    .admin-link {
      text-align: right;
      margin-bottom: 15px;
    }
    .admin-link a {
      color: #00f0ff;
      font-weight: bold;
      text-decoration: none;
    }
    .admin-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Music Player</h1>

    <div class="admin-link">
      <?php if (isset($_SESSION['admin_logged_in'])): ?>
        <a href="admin.php">Go to Admin Page</a> | <a href="admin.php?logout=true" style="color:red;">Logout</a>
      <?php else: ?>
        <a href="admin_login.php">Admin Login</a>
      <?php endif; ?>
    </div>

    <?php foreach ($albums as $album): ?>
      <div class="album-section">
        <h2 class="album-title"><?= htmlspecialchars($album) ?></h2>
        <div class="song-list">
          <?php
            $songs = getSongsByAlbum($album);
            if (!$songs) {
                echo "<p>No songs found in this album.</p>";
            } else {
                foreach ($songs as $song): ?>
                  <div class="song-card">
                    <img src="upload/<?= htmlspecialchars($song['image']) ?>" alt="<?= htmlspecialchars($song['title']) ?>" />
                    <h3><?= htmlspecialchars($song['title']) ?></h3>
                    <p><strong><?= htmlspecialchars($song['artist']) ?></strong></p>
                    <audio controls preload="none">
                      <source src="upload/<?= htmlspecialchars($song['audio']) ?>" type="audio/mpeg" />
                      Your browser does not support the audio element.
                    </audio>
                  </div>
          <?php endforeach; } ?>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</body>
</html>
