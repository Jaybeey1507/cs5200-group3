<!DOCTYPE html>
<html>
<head>
    <title>Player List</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f7fc;
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
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #1a2a42;
        }
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form input {
            padding: 8px;
            font-size: 14px;
            margin-right: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
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
        .edit-btn {
            background-color: #007BFF;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .edit-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <button onclick="window.location.href='dashboard.php'">⬅️ Back to Dashboard</button>
</div>

<div class="container">
    <h2>👥 Player List</h2>

    <form class="filter-form" onsubmit="event.preventDefault(); fetchPlayers();">
        <input type="text" id="searchInput" placeholder="Search by name...">
    </form>

    <div id="playerTable"></div>
</div>

<script>
    function fetchPlayers() {
        const search = document.getElementById('searchInput').value;
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "search_players.php?search=" + encodeURIComponent(search), true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById("playerTable").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    // Load full list on page load
    window.onload = fetchPlayers;
</script>

</body>
</html>
