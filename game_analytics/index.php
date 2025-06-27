<?php
session_start();
include 'db.php';

$role = $_SESSION['Role'] ?? '';

$sort = $_GET['sort'] ?? 'PlayerID';
$teamFilter = $_GET['team'] ?? '';

$sortWhitelist = ['PlayerID', 'Name', 'DoB', 'TeamName'];
if (!in_array($sort, $sortWhitelist)) {
    $sort = 'PlayerID';
}

$sql = "SELECT Player.PlayerID, PlayerIdentity.Name, PlayerIdentity.DoB, Team.TeamName
        FROM Player
        JOIN PlayerIdentity ON Player.Name = PlayerIdentity.Name
        JOIN Team ON PlayerIdentity.TeamID = Team.TeamID";

$params = [];
if (!empty($teamFilter)) {
    $sql .= " WHERE Team.TeamName = ?";
    $params[] = $teamFilter;
}

$sql .= " ORDER BY $sort";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get all unique teams for the dropdown
$teamsStmt = $conn->query("SELECT DISTINCT TeamName FROM Team");
$teams = $teamsStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Game Analytics - Players</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f2f9ff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
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
        }

        h1 {
            color: #1a2a42;
        }

        .filter-form {
            margin-bottom: 20px;
        }

        .filter-form select {
            padding: 6px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: white;
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
            background-color: #f7fbff;
        }

        .action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit-btn {
            background-color: #007BFF;
            color: white;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <button onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
</div>

<div class="container">
    <h1>All Players & Their Teams</h1>

    <form method="GET" class="filter-form">
        <label for="team">Filter by Team:</label>
        <select name="team" onchange="this.form.submit()">
            <option value="">All Teams</option>
            <?php foreach ($teams as $team): 
                $selected = $team['TeamName'] === $teamFilter ? 'selected' : '';
                echo "<option value=\"{$team['TeamName']}\" $selected>{$team['TeamName']}</option>";
            endforeach; ?>
        </select>
    </form>

    <table>
        <tr>
            <th><a href="?sort=PlayerID<?= $teamFilter ? "&team=$teamFilter" : '' ?>">Player ID</a></th>
            <th><a href="?sort=Name<?= $teamFilter ? "&team=$teamFilter" : '' ?>">Name</a></th>
            <th><a href="?sort=DoB<?= $teamFilter ? "&team=$teamFilter" : '' ?>">Date of Birth</a></th>
            <th><a href="?sort=TeamName<?= $teamFilter ? "&team=$teamFilter" : '' ?>">Team</a></th>
            <th>Actions</th>
        </tr>
        <?php foreach ($result as $row): ?>
            <tr>
                <td><?= htmlspecialchars($row['PlayerID']) ?></td>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                <td><?= htmlspecialchars($row['DoB']) ?></td>
                <td><?= htmlspecialchars($row['TeamName']) ?></td>
                <td>
                    <a class="action-btn edit-btn" href="edit_player.php?id=<?= $row['PlayerID'] ?>">✏️ Edit</a>
                    <a class="action-btn delete-btn" href="delete_player.php?id=<?= $row['PlayerID'] ?>" onclick="return confirm('Are you sure you want to delete this player?')">🗑️ Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
