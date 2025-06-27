<?php
include 'db.php';

$sql = "
SELECT 
    p.PlayerID,
    pi.Name,
    COUNT(DISTINCT pa.MatchID) AS TotalMatches,
    IFNULL(SUM(pa.Playtime), 0) AS TotalPlaytime,
    COUNT(DISTINCT a.AchievementID) AS TotalAchievements
FROM Player p
JOIN PlayerIdentity pi ON p.Name = pi.Name
LEFT JOIN Participate pa ON p.PlayerID = pa.PlayerID
LEFT JOIN Unlocks u ON p.PlayerID = u.PlayerID
LEFT JOIN Achievement a ON u.AchievementID = a.AchievementID
GROUP BY p.PlayerID, pi.Name
ORDER BY TotalPlaytime DESC
";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Player Statistics</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f1f7fc;
            font-family: 'Segoe UI', sans-serif;
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
            max-width: 1100px;
            margin: 30px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        h2 {
            color: #1a2a42;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
            background-color: #f5faff;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <button onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
</div>

<div class="container">
    <h2>📊 Player Statistics</h2>
    <table>
        <tr>
            <th>Player ID</th>
            <th>Name</th>
            <th>Total Matches</th>
            <th>Total Playtime (mins)</th>
            <th>Total Achievements</th>
        </tr>
        <?php foreach ($stats as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['PlayerID']) ?></td>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                <td><?= htmlspecialchars($row['TotalMatches']) ?></td>
                <td><?= htmlspecialchars($row['TotalPlaytime']) ?></td>
                <td><?= htmlspecialchars($row['TotalAchievements']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
