<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skibidichess</title>
    <link rel="shortcut icon" href="../Assets/Images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Style/output.css">
    <style>
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .leaderboard-container {
                width: 100%;
                max-width: 280px;
                margin-top: 2rem;
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-[#302E2B] flex justify-center items-center min-h-screen p-4">
    <div class="main-container flex flex-col md:flex-row items-center justify-center w-full max-w-6xl gap-8 md:mt-0">
        <!-- Game section -->
        <div id="Home" class="flex items-center flex-col justify-center w-full max-w-md">
            <img src="../Assets/Images/Logo.png" class="w-full max-w-[280px] md:max-w-[400px] mb-6 drop-shadow-lg md:drop-shadow-[0_77px_35px_rgba(0,0,0,0.25)]">

            <div id="UserInfo" class="text-white text-lg md:text-2xl mb-6">
                Logged in as: <span id="username">Guest</span>
            </div>

            <div id="GameMod" class="flex flex-col w-full max-w-[280px] md:max-w-[400px]">
                <a href="./SinglePlayerSettings.html" class="w-full">
                    <button id="Button" class="GreenBtn w-full h-12 md:h-14 text-base md:text-lg mb-4">Singleplayer</button>
                </a>

                <a href="./multiplayer.php" class="w-full">
                    <button id="Button" class="GreenBtn w-full h-12 md:h-14 text-base md:text-lg mb-4">Multiplayer</button>
                </a>

                <a href="./admin/index.php" class="w-full">
                    <button id="adminButton" class="GreenBtn w-full h-12 md:h-14 text-base md:text-lg mb-4" style="display: none;">Administration</button>
                </a>

                <button id="logoutButton" class="RedBtn w-full h-12 md:h-14 text-base md:text-lg mb-4" style="display: none;" onclick="logoutHandler()">Logout</button>

                <a href="./login.html" class="w-full">
                    <button id="loginButton" class="GreenBtn w-full h-12 md:h-14 text-base md:text-lg" style="display: none;">Login</button>
                </a>
            </div>

            <small class="text-gray-400 mb-0.5 mt-8 text-xs md:text-sm text-center">SkibidiChess ALFA <br>Copyright&copy; 2025 - SkibidiCorporation&trade;</small>
        </div>

        <!-- Leaderboard section -->
        <div class="leaderboard-container bg-[#262522] rounded-md p-4 shadow-2xl shadow-[#0000009c] w-full max-w-[280px] md:max-w-[400px]">
            <h2 class="text-white text-lg font-bold border-b border-[#302e2b] pb-2 mb-3">Leaderboard</h2>

            <!-- Rankings List -->
            <div class="overflow-y-auto max-h-[300px]">
                <table class="w-full">
                    <thead class="text-left text-xs text-white border-[#302e2b]">
                        <tr class="border-b border-[#302e2b]">
                            <th class="pb-2">Rank</th>
                            <th class="pb-2">Player</th>
                            <th class="pb-2 text-right">Points</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm" id="leaderboard-body">
                        <!-- Data will be inserted here via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- PHP code will be processed server-side -->
    <?php

    use Skibidi\SessionChecker;

    require '../Backend/SessionChecker.php';
    $sessionChecker = new SessionChecker();
    if ($sessionChecker->checkSession()) {
        $username = $_SESSION['user']['username'];
        $admin = $sessionChecker->checkAdmin();
    } else {
        $username = "Guest";
        $admin = 0;
    }
    ?>

    <script>
        async function logoutHandler() {
            const response = await fetch('../Backend/User.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'logoutUser'
                })
            });
            window.location.reload();
        }

        function enableAdmin() {
            document.getElementById("adminButton").style.display = 'block';
        }

        function enableLogout() {
            document.getElementById("logoutButton").style.display = 'block';
        }

        function enableLogin() {
            document.getElementById("loginButton").style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Get user data from PHP
            let user = <?php echo json_encode($username); ?>;
            let admin = <?php echo json_encode($admin); ?>;

            if (user != "Guest") {
                enableLogout();
            } else {
                enableLogin();
            }

            if (admin == true) {
                enableAdmin();
            }

            document.getElementById("username").innerText = user;

            // Fetch leaderboard data
            async function fetchLeaderboard() {
                try {
                    const response = await fetch('../Backend/Leaderboard.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            action: 'getLeaderboard',
                            rows: 5 // Number of rows to display
                        })
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const data = await response.json();

                    if (data.success) {
                        updateLeaderboard(data.leaderboard);
                    } else {
                        console.error('Error fetching leaderboard:', data.message);
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }

            // Function to update the leaderboard
            function updateLeaderboard(players) {
                const tbody = document.getElementById('leaderboard-body');
                tbody.innerHTML = ''; // Clear the table

                players.forEach((player, index) => {
                    const row = document.createElement('tr');
                    row.className = 'border-b border-[#302e2b]';

                    // Add emoji for top 3 places
                    let rankEmoji = '';
                    if (index === 0) rankEmoji = '🥇';
                    else if (index === 1) rankEmoji = '🥈';
                    else if (index === 2) rankEmoji = '🥉';

                    row.innerHTML = `
                        <td class="py-2 text-white">${rankEmoji || index + 1}</td>
                        <td class="py-2">
                            <div class="flex items-center">
                                <img src="../Assets/Images/ImgPlaceholder.jpg" class="w-6 h-6 rounded-full mr-2">
                                <span class="text-white">${player.username}</span>
                            </div>
                        </td>
                        <td class="py-2 text-right text-white">${player.pts}</td>
                    `;

                    tbody.appendChild(row);
                });
            }

            // Load the leaderboard when the page is ready
            fetchLeaderboard();

            // Update the leaderboard every 30 seconds (optional)
            setInterval(fetchLeaderboard, 30000);
        });
    </script>
</body>

</html>