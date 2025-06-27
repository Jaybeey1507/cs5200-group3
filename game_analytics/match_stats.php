<?php
include 'db.php';

$searchScore = $_GET['match_score'] ?? '';
$minShots = $_GET['min_shots'] ?? '';

$where = [];
$params = [];

if (!empty($searchScore)) {
    $where[] = 'Score LIKE :score';
    $params['score'] = '%' . $searchScore . '%';
}
if (!empty($minShots)) {
    $where[] = 'Shots >= :shots';
    $params['shots'] = $minShots;
}

$sql = "SELECT MatchStatsID, MatchID, PossessionPercent, Shots, Fouls, Score FROM MatchStats";
if ($where) $sql .= " WHERE " . implode(" AND ", $where);
$sql .= " ORDER BY MatchID DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Match Stats</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body { background-color: #f8fbff; font-family: 'Segoe UI', sans-serif; }
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
    .top-bar button:hover { background-color: #0056b3; }
    .container {
      max-width: 1000px;
      margin: auto;
      padding: 30px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    h2 { color: #1a2a42; }
    .filter-form input {
      padding: 8px;
      margin-right: 10px;
      font-size: 14px;
    }
    .filter-form button {
      padding: 8px 12px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .filter-form button:hover { background-color: #1e7e34; }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td { padding: 12px; border: 1px solid #ccc; }
    th { background-color: #007BFF; color: white; }
    tr:nth-child(even) { background-color: #f1f7ff; }
  </style>
</head>
<body>

<div class="top-bar">
  <button onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
</div>

<div class="container">
  <h2>📊 Match Stats</h2>

  <form method="GET" class="filter-form">
    <input type="text" name="match_score" placeholder="Search Score (e.g. 2-1)" value="<?= htmlspecialchars($searchScore) ?>">
    <input type="number" name="min_shots" placeholder="Min Shots" value="<?= htmlspecialchars($minShots) ?>">
    <button type="submit">Filter</button>
  </form>

  <table>
    <tr>
      <th>ID</th>
      <th>Match ID</th>
      <th>Possession %</th>
      <th>Shots</th>
      <th>Fouls</th>
      <th>Score</th>
    </tr>
    <?php foreach ($stats as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['MatchStatsID']) ?></td>
        <td><?= htmlspecialchars($row['MatchID']) ?></td>
        <td><?= htmlspecialchars($row['PossessionPercent']) ?></td>
        <td><?= htmlspecialchars($row['Shots']) ?></td>
        <td><?= htmlspecialchars($row['Fouls']) ?></td>
        <td><?= htmlspecialchars($row['Score']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

</body>
</html>
