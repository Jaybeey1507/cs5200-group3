<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Auto-generate a unique user ID like b4721
    $userID = '';
    do {
        $randomChar = chr(rand(97, 122)); // a–z
        $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT); // ensures 4-digit number
        $userID = $randomChar . $randomNumber;

        $checkStmt = $conn->prepare("SELECT * FROM Users WHERE UserID = ?");
        $checkStmt->execute([$userID]);
    } while ($checkStmt->rowCount() > 0);

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO Users (UserID, Email, Password, Role) VALUES (?, ?, ?, 'user')");
        $stmt->execute([$userID, $email, $hashed]);
        $message = "✅ Signup successful! Please login.";
    } catch (PDOException $e) {
        $message = "❌ Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4fbff;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        button {
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
        .link-btn {
            margin-top: 20px;
            background-color: #6c757d;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📝 Sign Up</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Register</button>
        </form>

        <button class="link-btn" onclick="window.location.href='login.php'">🔐 Already have an account? Login</button>

        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
