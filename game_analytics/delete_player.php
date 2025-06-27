<?php
include 'db.php';

if (isset($_GET['id'])) {
    $playerID = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM Player WHERE PlayerID = ?");
    $stmt->execute([$playerID]);

    header("Location: index.php");
    exit();
} else {
    echo "Invalid player ID.";
}
?>
