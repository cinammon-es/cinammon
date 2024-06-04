document.getElementById('setAfkForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;

    fetch('../db/api.php?action=setAfk', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `username=${username}&email=${email}`
    })
    .then(response => response.json())
    .then(data => {
        alert(data.status === 'success' ? 'User set to AFK' : `Error setting AFK: ${data.message}`);
    });
});

document.getElementById('setActiveForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const username = document.getElementById('usernameActive').value;
    const email = document.getElementById('emailActive').value;

    fetch('../db/api.php?action=setActive', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `username=${username}&email=${email}`
    })
    .then(response => response.json())
    .then(data => {
        alert(data.status === 'success' ? 'User set to Active' : `Error setting Active: ${data.message}`);
    });
});

document.getElementById('getAfkSummary').addEventListener('click', function() {
    fetch('../db/api.php?action=getAfkSummary')
    .then(response => response.json())
    .then(data => {
        document.getElementById('afkSummary').textContent = JSON.stringify(data, null, 2);
    });
});

document.getElementById('getAfkStats').addEventListener('click', function() {
    fetch('../db/api.php?action=getAfkStats')
    .then(response => response.json())
    .then(data => {
        document.getElementById('afkStats').textContent = JSON.stringify(data, null, 2);
    });
});
