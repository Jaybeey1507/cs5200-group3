<?php
include 'db.php';

$searchDate = $_GET['session_date'] ?? '';
$searchResult = $_GET['session_result'] ?? '';

$where = [];
$params = [];

if (!empty($searchDate)) {
    $where[] = 'MatchSessionDate = :session_date';
    $params['session_date'] = $searchDate;
}
if (!empty($searchResult)) {
    $where[] = 'Result LIKE :session_result';
    $params['session_result'] = '%' . $searchResult . '%';
}

$sql = "SELECT MatchID, MatchSessionDate, Result, VenueID FROM MatchSession";
if ($where) $sql .= " WHERE " . implode(" AND ", $where);
$sql .= " ORDER BY MatchSessionDate DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Match Sessions</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body { background-color: #f0f6ff; font-family: 'Segoe UI', sans-serif; }
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
    tr:nth-child(even) { background-color: #f8faff; }
  </style>
</head>
<body>

<div class="top-bar">
  <button onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
</div>

<div class="container">
  <h2>📅 Match Sessions</h2>

  <form method="GET" class="filter-form">
    <input type="date" name="session_date" value="<?= htmlspecialchars($searchDate) ?>">
    <input type="text" name="session_result" placeholder="Search result (e.g. 2-1)" value="<?= htmlspecialchars($searchResult) ?>">
    <button type="submit">Filter</button>
  </form>

  <table>
    <tr>
      <th>Match ID</th>
      <th>Date</th>
      <th>Result</th>
      <th>Venue ID</th>
    </tr>
    <?php foreach ($matches as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['MatchID']) ?></td>
        <td><?= htmlspecialchars($row['MatchSessionDate']) ?></td>
        <td><?= htmlspecialchars($row['Result']) ?></td>
        <td><?= htmlspecialchars($row['VenueID']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

</body>
</html>
