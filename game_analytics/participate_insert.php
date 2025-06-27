<?php
session_start();
if (!isset($_SESSION['UserID']) || $_SESSION['Role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'db.php';
$message = '';

// Fetch players for dropdown
$playerStmt = $conn->query("
    SELECT Player.PlayerID, PlayerIdentity.Name 
    FROM Player 
    JOIN PlayerIdentity ON Player.Name = PlayerIdentity.Name
");
$players = $playerStmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $playerID = $_POST['playerID'];
    $matchID = $_POST['matchID'];
    $playtime = $_POST['playtime'];

    try {
        $stmt = $conn->prepare("INSERT INTO Participate (PlayerID, MatchID, Playtime) VALUES (?, ?, ?)");
        $stmt->execute([$playerID, $matchID, $playtime]);
        $message = "✅ Participation data inserted successfully!";
    } catch (PDOException $e) {
        $message = "❌ Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Participation Data</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f5fbff;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #1a2a42;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 20px;
            padding: 10px 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
        .back-btn {
            margin-top: 10px;
            background-color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>➕ Insert Participation Record</h2>
    <form method="POST">
        <label for="playerID">Player ID:</label>
        <select name="playerID" required>
            <option value="" disabled selected>-- Select Player --</option>
            <?php foreach ($players as $p): ?>
                <option value="<?= $p['PlayerID'] ?>">
                    <?= $p['PlayerID'] ?> - <?= htmlspecialchars($p['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="matchID">Match ID:</label>
        <input type="number" name="matchID" required>

        <label for="playtime">Playtime (minutes):</label>
        <input type="number" name="playtime" required>

        <button type="submit">Insert</button>
        <button type="button" class="back-btn" onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
    </form>

    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
</div>

</body>
</html>
