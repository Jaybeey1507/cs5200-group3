<?php
include 'db.php';

$search = $_GET['search'] ?? '';

if ($search) {
    $stmt = $conn->prepare("SELECT Player.PlayerID, PlayerIdentity.Name, PlayerIdentity.DoB
                            FROM Player
                            JOIN PlayerIdentity ON Player.Name = PlayerIdentity.Name
                            WHERE PlayerIdentity.Name LIKE :search");
    $stmt->execute(['search' => '%' . $search . '%']);
} else {
    $stmt = $conn->query("SELECT Player.PlayerID, PlayerIdentity.Name, PlayerIdentity.DoB
                          FROM Player
                          JOIN PlayerIdentity ON Player.Name = PlayerIdentity.Name");
}

$players = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($players) > 0): ?>
    <table>
        <tr>
            <th>Player ID</th>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Action</th>
        </tr>
        <?php foreach ($players as $player): ?>
            <tr>
                <td><?= htmlspecialchars($player['PlayerID']) ?></td>
                <td><?= htmlspecialchars($player['Name']) ?></td>
                <td><?= htmlspecialchars($player['DoB']) ?></td>
                <td><a class="edit-btn" href="edit_player.php?id=<?= $player['PlayerID'] ?>">✏️ Edit</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No players found.</p>
<?php endif; ?>
