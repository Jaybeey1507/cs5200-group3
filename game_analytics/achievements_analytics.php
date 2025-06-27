<?php
include 'db.php';

$searchName      = $_GET['achievement_player']   ?? '';
$minAchievements = $_GET['min_achievements']     ?? '';

$where  = [];
$params = [];

if ($searchName !== '') {
    $where[]        = 'pi.Name LIKE :name';
    $params['name'] = '%' . $searchName . '%';
}
if (is_numeric($minAchievements)) {
    $where[]        = 'COUNT(a.AchievementID) >= :min';
    $params['min']  = (int)$minAchievements;
}

$sql = "
SELECT
    pi.Name AS PlayerName,
    COUNT(a.AchievementID) AS TotalAchievements,
    GROUP_CONCAT(DISTINCT a.AchievementName SEPARATOR ', ') AS AchievementList
FROM PlayerIdentity pi
JOIN Player p ON pi.Name = p.Name
LEFT JOIN Achievement a ON a.PlayerID = p.PlayerID
GROUP BY pi.Name
";

if (!empty($where)) {
    $sql .= ' HAVING ' . implode(' AND ', $where);
}

$sql .= ' ORDER BY TotalAchievements DESC';

$stmt             = $conn->prepare($sql);
$stmt->execute($params);
$achievementStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>🏆 Achievements Analytics</h2>

<form method="GET" action="dashboard.php" class="filter-form">
    <input type="hidden" name="view" value="achievements">

    <label for="achievement_player">Player Name:</label>
    <input
        type="text"
        id="achievement_player"
        name="achievement_player"
        placeholder="Player name..."
        value="<?= htmlspecialchars($searchName) ?>"
    >

    <label for="min_achievements">Min Achievements:</label>
    <input
        type="number"
        id="min_achievements"
        name="min_achievements"
        placeholder="Min Achievements"
        value="<?= htmlspecialchars($minAchievements) ?>"
    >

    <button type="submit" class="edit-btn">Filter</button>
</form>

<table class="dashboard-table">
    <thead>
        <tr>
            <th>Player Name</th>
            <th>Total Achievements</th>
            <th>Unlocked Achievements</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($achievementStats) === 0): ?>
            <tr>
                <td colspan="3" style="text-align:center;">No data found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($achievementStats as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['PlayerName']) ?></td>
                    <td><?= htmlspecialchars($row['TotalAchievements']) ?></td>
                    <td><?= $row['AchievementList'] ? htmlspecialchars($row['AchievementList']) : 'None' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
