<?php
include 'db.php';

$playerID = $_GET['id'] ?? null;

if (!$playerID) {
    die("No player ID provided.");
}

// Fetch existing player info
$stmt = $conn->prepare("SELECT Player.PlayerID, PlayerIdentity.Name, PlayerIdentity.DoB, PlayerIdentity.TeamID
                        FROM Player
                        JOIN PlayerIdentity ON Player.Name = PlayerIdentity.Name
                        WHERE Player.PlayerID = ?");
$stmt->execute([$playerID]);
$player = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$player) {
    die("Player not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'];
    $newDoB = $_POST['dob'];
    $oldName = $player['Name'];
    $teamID = $player['TeamID'];
    $tempName = '__temp_' . uniqid(); // Safe bridge name

    try {
        $conn->beginTransaction();

        // ✅ Step 1: Insert temp name into PlayerIdentity (foreign key safe)
        $insertTemp = $conn->prepare("INSERT INTO PlayerIdentity (Name, DoB, TeamID) VALUES (?, ?, ?)");
        $insertTemp->execute([$tempName, $newDoB, $teamID]);

        // ✅ Step 2: Point Player to temp name
        $unlink = $conn->prepare("UPDATE Player SET Name = ? WHERE PlayerID = ?");
        $unlink->execute([$tempName, $playerID]);

        // ✅ Step 3: Update real identity
        $updateIdentity = $conn->prepare("UPDATE PlayerIdentity SET Name = ?, DoB = ? WHERE Name = ?");
        $updateIdentity->execute([$newName, $newDoB, $oldName]);

        // ✅ Step 4: Re-link Player to new name
        $relink = $conn->prepare("UPDATE Player SET Name = ? WHERE PlayerID = ?");
        $relink->execute([$newName, $playerID]);

        // ✅ Step 5: Delete temp identity
        $deleteTemp = $conn->prepare("DELETE FROM PlayerIdentity WHERE Name = ?");
        $deleteTemp->execute([$tempName]);

        $conn->commit();

        echo "<script>alert('Player updated successfully!'); window.location.href='players_list.php';</script>";
    } catch (Exception $e) {
        $conn->rollBack();
        die("Update failed: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Player</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Player #<?= htmlspecialchars($player['PlayerID']) ?></h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($player['Name']) ?>" required><br><br>
        <label>Date of Birth:</label>
        <input type="date" name="dob" value="<?= htmlspecialchars($player['DoB']) ?>" required><br><br>
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
