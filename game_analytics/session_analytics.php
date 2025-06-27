<!DOCTYPE html>
<html>
<head>
    <title>Session Analytics</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #eef6ff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        .top-bar {
            background-color: #1a2a42;
            color: white;
            padding: 15px 20px;
        }

        .top-bar button {
            background-color: #007BFF;
            border: none;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .top-bar button:hover {
            background-color: #0056b3;
        }

        .container {
            padding: 30px;
            max-width: 1000px;
            margin: auto;
        }

        h2 {
            color: #1a2a42;
        }

        .filter-form input {
            padding: 6px;
            margin-right: 10px;
            font-size: 14px;
        }

        .filter-form button {
            padding: 6px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filter-form button:hover {
            background-color: #1e7e34;
        }

        #results-table {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f8faff;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <button onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
</div>

<div class="container">
    <h2>📅 Session Analytics (Weekly Playtime)</h2>

    <form id="filter-form" class="filter-form">
        <input type="text" name="session_player" placeholder="Player name...">
        <input type="number" name="session_week" placeholder="Week #">
        <button type="submit">Filter</button>
    </form>

    <div id="results-table">
        <!-- AJAX results will be loaded here -->
    </div>
</div>

<script>
document.getElementById('filter-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);

    fetch('search_sessions.php?' + params.toString())
        .then(res => res.text())
        .then(html => {
            document.getElementById('results-table').innerHTML = html;
        });
});

// Trigger initial load
window.addEventListener('DOMContentLoaded', () => {
    document.getElementById('filter-form').dispatchEvent(new Event('submit'));
});
</script>

</body>
</html>
