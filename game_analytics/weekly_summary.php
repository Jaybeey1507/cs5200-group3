<?php
include 'db.php';

$stmt = $conn->query("
    SELECT 
        ws.PlayerID,
        pi.Name,
        ws.WeekNumber,
        ws.TotalPlaytime
    FROM WeeklyPlaytimeSummary ws
    JOIN Player p ON ws.PlayerID = p.PlayerID
    JOIN PlayerIdentity pi ON p.Name = pi.Name
    ORDER BY ws.WeekNumber DESC, ws.TotalPlaytime DESC
");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Weekly Summary</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="top-bar">
        <button onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
    </div>
    <div class="container">
        <h2>📊 Weekly Playtime Summary (Trigger-Based)</h2>
        <table>
            <tr>
                <th>Player ID</th>
                <th>Name</th>
                <th>Week</th>
                <th>Total Playtime (mins)</th>
            </tr>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= $row['PlayerID'] ?></td>
                <td><?= $row['Name'] ?></td>
                <td><?= $row['WeekNumber'] ?></td>
                <td><?= $row['TotalPlaytime'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
