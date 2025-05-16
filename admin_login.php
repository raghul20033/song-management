<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'raghul' && $password === '123456') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login</title>
  <style>
    body {
      background: #000;
      color: #00f0ff;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: rgba(34, 34, 34, 0.9);
      padding: 30px;
      border-radius: 12px;
      width: 320px;
      box-shadow: 0 0 20px #00f0ff;
      text-align: center;
    }
    h1 {
      margin-bottom: 25px;
    }
    input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
    }
    button {
      background: #00f0ff;
      border: none;
      border-radius: 6px;
      padding: 12px;
      width: 100%;
      cursor: pointer;
      font-weight: 700;
      color: black;
      font-size: 18px;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #00b8cc;
    }
    p.error {
      color: #ff5555;
      margin-bottom: 15px;
      font-weight: 700;
    }
    a {
      color: #00f0ff;
      text-decoration: none;
      font-weight: 600;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Admin Login</h1>
    <?php if ($error): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <p><a href="index.php">Back to Home</a></p>
  </div>
</body>
</html>
