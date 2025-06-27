<?php
include 'db.php';

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $adminCode = $_POST['admin_code'];

    if ($adminCode !== 'admin2025') {
        $message = "❌ Invalid admin code.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $message = "❌ Email already registered.";
        } else {
            // Generate lowercase UserID like a1234
            do {
                $userID = chr(rand(97, 122)) . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
                $check = $conn->prepare("SELECT * FROM Users WHERE UserID = ?");
                $check->execute([$userID]);
            } while ($check->rowCount() > 0);

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = $conn->prepare("INSERT INTO Users (UserID, Email, Password, Role) VALUES (?, ?, ?, 'admin')");
            $insert->execute([$userID, $email, $hashed]);
            $message = "✅ Admin registered successfully!";
            $success = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Signup</title>
    <style>
        body {
            background-color: #f9f9ff;
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
            background-color: #1d3557;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn-link {
            margin-top: 20px;
            background-color: #6c757d;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🛡️ Admin Registration</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Admin Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="admin_code" placeholder="Admin Code" required>
        <button type="submit">Register as Admin</button>
    </form>

    <button class="btn-link" onclick="window.location.href='login.php'">🔑 Back to Login</button>

    <?php if ($message): ?>
        <div class="message <?= $success ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
