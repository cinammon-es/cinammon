<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/admin/dashboard.css">
    <title>AFK Manager</title>
</head>

<body>
    <h1>AFK Manager</h1>

    <div>
        <h2>Set AFK</h2>
        <form id="setAfkForm">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Set AFK</button>
        </form>
    </div>

    <div>
        <h2>Set Active</h2>
        <form id="setActiveForm">
            <label for="usernameActive">Username:</label>
            <input type="text" id="usernameActive" name="username" required>
            <label for="emailActive">Email:</label>
            <input type="email" id="emailActive" name="email" required>
            <button type="submit">Set Active</button>
        </form>
    </div>

    <div>
        <h2>AFK Summary</h2>
        <button id="getAfkSummary">Get AFK Summary</button>
        <pre id="afkSummary"></pre>
    </div>

    <div>
        <h2>AFK Stats</h2>
        <button id="getAfkStats">Get AFK Stats</button>
        <pre id="afkStats"></pre>
    </div>

    <script src="/styling/admin/afk.js"></script>
</body>

</html>