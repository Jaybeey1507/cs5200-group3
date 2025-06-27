<?php
include 'db.php';

$sql = "
SELECT 
    Player.PlayerID,
    PlayerIdentity.Name,
    PlayerIdentity.DoB,
    Team.TeamName,
    SUM(Participate.Goals) AS TotalGoals
FROM Player
JOIN PlayerIdentity ON Player.Name = PlayerIdentity.Name
JOIN Team ON PlayerIdentity.TeamID = Team.TeamID
JOIN Participate ON Player.PlayerID = Participate.PlayerID
GROUP BY Player.PlayerID, PlayerIdentity.Name, PlayerIdentity.DoB, Team.TeamName
ORDER BY TotalGoals DESC
LIMIT 5
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$topPlayers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Top 5 Players</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f7fb;
            margin: 0;
        }
        .top-bar {
            background-color: #1a2a42;
            color: white;
            padding: 15px 20px;
        }
        .top-bar button {
            background-color: #007BFF;
            border: none;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        .top-bar button:hover {
            background-color: #0056b3;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
        }
        h1 {
            color: #1a2a42;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8faff;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <button onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
</div>

<div class="container">
    <h1>🏆 Top 5 Players by Goals</h1>
    <table>
        <tr>
            <th>Player ID</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Team</th>
            <th>Goals</th>
        </tr>
        <?php foreach ($topPlayers as $player): ?>
        <tr>
            <td><?= htmlspecialchars($player['PlayerID']) ?></td>
            <td><?= htmlspecialchars($player['Name']) ?></td>
            <td><?= htmlspecialchars($player['DoB']) ?></td>
            <td><?= htmlspecialchars($player['TeamName']) ?></td>
            <td><?= htmlspecialchars($player['TotalGoals']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
