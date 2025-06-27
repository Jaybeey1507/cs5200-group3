<?php
include 'db.php';

$searchName = $_GET['session_player'] ?? '';
$searchWeek = $_GET['session_week'] ?? '';

$where = [];
$params = [];

if ($searchName !== '') {
    $where[] = 'pi.Name LIKE :name';
    $params['name'] = '%' . $searchName . '%';
}

if ($searchWeek !== '') {
    $where[] = 'WEEK(ms.MatchSessionDate) = :week';
    $params['week'] = $searchWeek;
}

$sql = "
SELECT 
    WEEK(ms.MatchSessionDate) AS WeekNumber,
    pi.Name AS PlayerName,
    SUM(pa.Playtime) AS TotalPlaytime
FROM Participate pa
JOIN Player p ON pa.PlayerID = p.PlayerID
JOIN PlayerIdentity pi ON p.Name = pi.Name
JOIN MatchSession ms ON pa.MatchID = ms.MatchID
";

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " GROUP BY WeekNumber, PlayerName ORDER BY WeekNumber, PlayerName";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <tr>
        <th>Week</th>
        <th>Player Name</th>
        <th>Total Playtime (mins)</th>
    </tr>
    <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['WeekNumber']) ?></td>
            <td><?= htmlspecialchars($row['PlayerName']) ?></td>
            <td><?= htmlspecialchars($row['TotalPlaytime']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
