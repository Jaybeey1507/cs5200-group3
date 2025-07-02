<?php
include 'db.php';

$coach_id = $_GET['id'] ?? '';
if (!$coach_id) {
  echo "Coach ID missing.";
  exit;
}

// Fetch current coach data
$stmt = $conn->prepare("
SELECT c.coachid, ci.coachname, ci.dob
FROM coach c
JOIN coachidentity ci ON c.coachname = ci.coachname
WHERE c.coachid = :id
");
$stmt->execute(['id' => $coach_id]);
$coach = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$coach) {
  echo "Coach not found.";
  exit;
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $new_name = $_POST['coachname'];
  $new_dob = $_POST['dob'];

  try {
        $conn->beginTransaction();

    // Update coachidentity first (so new name exists before FK is updated)
    $stmt1 = $conn->prepare("UPDATE coachidentity SET coachname = :new_name, dob = :new_dob WHERE coachname = :old_name");
    $stmt1->execute([
      'new_name' => $new_name,
      'new_dob' => $new_dob,
      'old_name' => $coach['coachname']
    ]);

    // Now update coach (FK now points to valid coachname)
    $stmt2 = $conn->prepare("UPDATE coach SET coachname = :new_name WHERE coachid = :id");
    $stmt2->execute(['new_name' => $new_name, 'id' => $coach_id]);

    $conn->commit();
    header("Location: coach_list.php");
    exit;
  } catch (Exception $e) {
    $conn->rollBack();
    echo "Error updating coach: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Coach</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9ff;
    }
    .container {
      width: 400px;
      margin: 60px auto;
      background: white;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
    }
    label {
      display: block;
      margin-top: 12px;
    }
    input[type="text"], input[type="date"] {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
    }
    button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #007bff;
      border: none;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }
    a {
      display: block;
      margin-top: 15px;
      text-align: center;
      text-decoration: none;
      color: #555;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Edit Coach</h2>
    <form method="post">
      <label for="coachname">Name:</label>
      <input type="text" name="coachname" value="<?= htmlspecialchars($coach['coachname']) ?>" required>

      <label for="dob">Date of Birth:</label>
      <input type="date" name="dob" value="<?= htmlspecialchars($coach['dob']) ?>" required>

      <button type="submit">Save Changes</button>
      <a href="coach_list.php">Cancel</a>
    </form>
  </div>
</body>
</html>
