<?php
include 'db.php';

$search = $_GET['search'] ?? '';

// Modify SQL to include filtering
$sql = "
SELECT 
    c.coachid,
    ci.coachname,
    ci.dob,
    t.teamname
FROM coach c
JOIN coachidentity ci ON c.coachname = ci.coachname
JOIN team t ON ci.teamid = t.teamid
WHERE ci.coachname LIKE :search OR t.teamname LIKE :search
ORDER BY ci.coachname
";

$stmt = $conn->prepare($sql);
$stmt->execute(['search' => '%' . $search . '%']);
$coaches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Coach List</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: #f4f9ff;
      font-family: 'Segoe UI', sans-serif;
    }

    .top-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 20px 40px 0 40px;
    }

    .top-bar h2 {
      flex-grow: 1;
      text-align: center;
      font-size: 24px;
      font-weight: 700;
      margin: 0;
    }

    .back-btn {
      padding: 8px 16px;
      background-color: #198754;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-size: 14px;
    }

    .container {
      margin: 20px auto;
      width: 90%;
      max-width: 1000px;
    }

    .search-bar {
      margin-bottom: 20px;
      display: flex;
      justify-content: flex-end;
    }

    .search-bar input[type="text"] {
      padding: 8px;
      width: 250px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .search-bar button {
      margin-left: 10px;
      padding: 8px 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
    }

    th, td {
      padding: 10px 14px;
      border: 1px solid #ccc;
    }

    th {
      background-color: #1d3557;
      color: white;
    }

    tr:hover {
      background-color: #f9fcff;
    }

    .edit-btn {
      padding: 6px 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <div class="top-bar">
    <a class="back-btn" href="http://localhost/game_analytics/dashboard.php">← Back to Dashboard</a>
    <h2>Coach List</h2>
    <div style="width:120px;"></div> <!-- spacer to balance layout -->
  </div>

  <div class="container">
    <form method="get" class="search-bar">
      <input type="text" name="search" placeholder="Search by name or team" value="<?= htmlspecialchars($search) ?>">
      <button type="submit">Search</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>Coach ID</th>
          <th>Name</th>
          <th>Date of Birth</th>
          <th>Team</th>
          <th>Edit</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($coaches) === 0): ?>
          <tr><td colspan="5" style="text-align:center;">No results found.</td></tr>
        <?php else: ?>
          <?php foreach ($coaches as $c): ?>
            <tr>
              <td><?= htmlspecialchars($c['coachid']) ?></td>
              <td><?= htmlspecialchars($c['coachname']) ?></td>
              <td><?= htmlspecialchars($c['dob']) ?></td>
              <td><?= htmlspecialchars($c['teamname']) ?></td>
              <td>
                <a class="edit-btn" href="edit_coach.php?id=<?= urlencode($c['coachid']) ?>">Edit</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
