<?php
session_start();
if (!isset($_SESSION['UserID']) || !isset($_SESSION['Role'])) {
    header("Location: login.php");
    exit;
}

$userID = $_SESSION['UserID'];
$role = $_SESSION['Role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Game Analytics Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #eaf6ff;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color: #eaf6ff;
    }

    .user-info {
      font-size: 14px;
      color: #000;
      font-weight: 600;
    }

    .logout-btn {
      background-color: #dc3545;
      border: none;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      margin-left: 10px;
    }

    .welcome-section {
      padding: 30px 40px;
    }

    .welcome-section h1 {
      font-size: 28px;
      color: #1a2a42;
      margin: 0 0 12px 0;
    }

    .welcome-section p {
      font-size: 16px;
      color: #333;
      margin: 0;
    }

    .button-bar {
      background-color: #fff;
      text-align: center;
      padding: 20px;
      border-top: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
    }

    .nav-btn {
      padding: 10px 18px;
      background-color: #007BFF;
      color: white;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      margin: 6px;
      transition: background-color 0.2s ease-in-out;
    }

    .nav-btn:hover {
      background-color: #0056b3;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      text-align: center;
    }

    .container p {
      font-size: 18px;
      color: #333;
    }
  </style>
</head>
<body>

<div class="top-bar">
  <div></div>
  <div class="user-info">
    <?= ($role === 'admin') ? "🛡️ Admin ID: $userID" : "👤 User ID: $userID" ?>
    <button onclick="navigate('logout.php')" class="logout-btn">🚪 Logout</button>
  </div>
</div>

<div class="welcome-section">
  <h1 style="text-align: left;">🎮 Welcome to the Game Analytics Dashboard</h1>
  <p>Explore player statistics, sessions, achievements, and team performance data — all in one place.</p>
</div>

<div class="button-bar">
  <?php if ($role === 'admin'): ?>
  <button class="nav-btn" onclick="navigate('index.php')">📂 Index Page Info</button>
 <?php endif; ?>
  <button class="nav-btn" onclick="navigate('achievements.php')">🏆 Achievements</button>
  <button class="nav-btn" onclick="navigate('aggregation.php')">🧮 Aggregation Stats</button>
  <button class="nav-btn" onclick="navigate('weekly_playtime.php')">📅 Weekly Playtime</button>
  <button class="nav-btn" onclick="navigate('top_players.php')">🥇 Top 5 Players</button>
  <button class="nav-btn" onclick="navigate('players_list.php')">👥 Player List</button>
  <button class="nav-btn" onclick="navigate('session_analytics.php')">🕒 Session Analytics</button>
  <button class="nav-btn" onclick="navigate('player_statistics.php')">📊 Player Statistics</button>
  <button class="nav-btn" onclick="navigate('match_sessions.php')">📆 Match Sessions</button>
  <button class="nav-btn" onclick="navigate('match_stats.php')">📈 Match Stats</button>

  <?php if ($role === 'admin'): ?>
    <button class="nav-btn" onclick="navigate('participate_insert.php')">🔧 Insert Participation</button>
  <?php endif; ?>
</div>

<div class="container">
  <p>Select any category above to view detailed analytics and insights.</p>
</div>

<script>
  function navigate(path) {
    window.location.href = 'http://localhost/game_analytics/' + path;
  }
</script>

</body>
</html>
