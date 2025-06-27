<?php
include 'db.php';

// Filters
$searchName = $_GET['player'] ?? '';
$searchWeek = $_GET['week'] ?? '';

$where = [];
$params = [];

if (!empty($searchName)) {
    $where[] = 'PlayerIdentity.Name LIKE :name';
    $params['name'] = '%' . $searchName . '%';
}
if (!empty($searchWeek)) {
    $where[] = 'WEEK(MatchSession.MatchSessionDate) = :week';
    $params['week'] = $searchWeek;
}

$sql = "
    SELECT 
        Player.PlayerID,
        PlayerIdentity.Name,
        YEAR(MatchSession.MatchSessionDate) AS Year,
        WEEK(MatchSession.MatchSessionDate) AS Week,
        SUM(Participate.Playtime) AS TotalPlaytime
    FROM Participate
    JOIN Player ON Participate.PlayerID = Player.PlayerID
    JOIN PlayerIdentity ON Player.Name = PlayerIdentity.Name
    JOIN MatchSession ON Participate.MatchID = MatchSession.MatchID
";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " GROUP BY Player.PlayerID, Year, Week
          ORDER BY Year DESC, Week DESC, TotalPlaytime DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weekly Playtime by Player</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f2f8fd;
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
        .filter-form input {
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
    <h1>📅 Weekly Playtime by Player</h1>

    <form method="GET" class="filter-form">
        <input type="text" name="player" placeholder="Player name..." value="<?= htmlspecialchars($searchName) ?>">
        <input type="number" name="week" placeholder="Week #" value="<?= htmlspecialchars($searchWeek) ?>" min="1" max="53">
        <button type="submit">Filter</button>
    </form>

    <table>
        <tr>
            <th>Player ID</th>
            <th>Name</th>
            <th>Year</th>
            <th>Week</th>
            <th>Total Playtime (minutes)</th>
        </tr>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['PlayerID']) ?></td>
            <td><?= htmlspecialchars($row['Name']) ?></td>
            <td><?= htmlspecialchars($row['Year']) ?></td>
            <td><?= htmlspecialchars($row['Week']) ?></td>
            <td><?= htmlspecialchars($row['TotalPlaytime']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
