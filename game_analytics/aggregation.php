<?php
include 'db.php';

// Filter inputs
$searchName = $_GET['player_name'] ?? '';
$teamFilter = $_GET['team'] ?? '';

$where = [];
$params = [];

if (!empty($searchName)) {
    $where[] = "PlayerIdentity.Name LIKE :name";
    $params['name'] = '%' . $searchName . '%';
}
if (!empty($teamFilter)) {
    $where[] = "Team.TeamName = :team";
    $params['team'] = $teamFilter;
}

$sql = "
SELECT 
    Player.PlayerID,
    PlayerIdentity.Name,
    PlayerIdentity.DoB,
    Team.TeamName,
    ROUND(AVG(Participate.Playtime), 2) AS AvgPlaytime,
    COUNT(Achievement.AchievementID) AS TotalAchievements
FROM Player
JOIN PlayerIdentity ON Player.Name = PlayerIdentity.Name
JOIN Team ON PlayerIdentity.TeamID = Team.TeamID
LEFT JOIN Participate ON Player.PlayerID = Participate.PlayerID
LEFT JOIN Achievement ON Player.PlayerID = Achievement.PlayerID
";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " GROUP BY Player.PlayerID, PlayerIdentity.Name, PlayerIdentity.DoB, Team.TeamName
          ORDER BY AvgPlaytime DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get distinct teams
$teamsStmt = $conn->query("SELECT DISTINCT TeamName FROM Team");
$teams = $teamsStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aggregation - Playtime & Achievements</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #eef6ff;
            font-family: 'Segoe UI', sans-serif;
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
            padding: 30px;
            max-width: 1100px;
            margin: auto;
        }
        h1 {
            color: #1a2a42;
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form input,
        .filter-form select {
            padding: 6px;
            margin-right: 10px;
            font-size: 14px;
        }
        .filter-form button {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .filter-form button:hover {
            background-color: #1e7e34;
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
    <h1>🧮 Average Playtime & 🏆 Total Achievements</h1>

    <form method="GET" class="filter-form">
        <input type="text" name="player_name" placeholder="Player name..." value="<?= htmlspecialchars($searchName) ?>">
        <select name="team">
            <option value="">All Teams</option>
            <?php foreach ($teams as $team): 
                $selected = $team['TeamName'] === $teamFilter ? 'selected' : '';
                echo "<option value=\"{$team['TeamName']}\" $selected>{$team['TeamName']}</option>";
            endforeach; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <table>
        <tr>
            <th>Player ID</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Team</th>
            <th>Average Playtime (mins)</th>
            <th>Total Achievements</th>
        </tr>
        <?php foreach ($result as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['PlayerID']) ?></td>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                <td><?= htmlspecialchars($row['DoB']) ?></td>
                <td><?= htmlspecialchars($row['TeamName']) ?></td>
                <td><?= htmlspecialchars($row['AvgPlaytime'] ?? '0') ?></td>
                <td><?= htmlspecialchars($row['TotalAchievements']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
