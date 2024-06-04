<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFK Manager</title>
    <link rel="stylesheet" href="/styling/admin/afk.css">
</head>

<body>
    <h1>AFK Manager</h1>

    <div class="container">
        <section>
            <h2>Set AFK</h2>
            <form id="setAfkForm">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit">Set AFK</button>
            </form>
        </section>

        <section>
            <h2>Set Active</h2>
            <form id="setActiveForm">
                <label for="usernameActive">Username:</label>
                <input type="text" id="usernameActive" name="username" required>
                <label for="emailActive">Email:</label>
                <input type="email" id="emailActive" name="email" required>
                <button type="submit">Set Active</button>
            </form>
        </section> 
        <section>
            <h2>AFK Stats</h2>
            <button id="getAfkStats">Get AFK Stats</button>
            <pre id="afkStats"></pre>
        </section>
        <section>
            <h2>AFK Summary</h2>
            <button id="getAfkSummary">Get AFK Summary</button>
            <pre id="afkSummary"></pre>
        </section>
    </div>

    <footer>
        <a href="/admin/dashboard.php#afk"><button>Back to Dashboard</button></a>
    </footer>

    <script src="/styling/admin/afk.js"></script>
</body>

</html>