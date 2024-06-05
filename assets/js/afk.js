/**
 * Este archivo contiene las funciones que se ejecutan en la página de administración de usuarios AFK.
 */
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
/**
 * Este archivo contiene las funciones que se ejecutan en la página de administración de usuarios AFK.
 */
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


/**
 * Este archivo contiene las funciones que se ejecutan en la página de administración de usuarios AFK.
 */
document.getElementById('getAfkStats').addEventListener('click', function() {
    fetch('../db/api.php?action=getAfkStats')
    .then(response => response.json())
    .then(data => {
        const statsElement = document.getElementById('afkStats');
        statsElement.innerHTML = `
            <tr>
                <td>Total AFK Users</td>
                <td>${data.total_afk_users}</td>
            </tr>
        `;
        table.appendChild(thead);
    });
});

/**
 * Este archivo contiene las funciones que se ejecutan en la página de administración de usuarios AFK.
*/
document.getElementById('getAfkSummary').addEventListener('click', function() {
    fetch('../db/api.php?action=getAfkSummary')
    .then(response => response.json())
    .then(data => {
        const summaryElement = document.getElementById('afkSummary');
        summaryElement.innerHTML = ''; // Clear previous content

        const table = document.createElement('table');
        table.classList.add('summary-table');

        // Create table header
        const thead = document.createElement('thead');
        thead.innerHTML = `
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>AFK Start Time</th>
                <th>AFK End Time</th>
            </tr>
        `;
        table.appendChild(thead);

        // Create table body
        const tbody = document.createElement('tbody');
        data.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.status}</td>
                <td>${user.afk_start_time}</td>
                <td>${user.afk_end_time || 'N/A'}</td>
            `;
            tbody.appendChild(row);
        });
        table.appendChild(tbody);

        summaryElement.appendChild(table);
    });
});
