<?php
require_once '../Backend/SessionChecker.php';

use Skibidi\SessionChecker;

$sessionChecker = new SessionChecker();
if (!$sessionChecker->checkSession())
    header('Location: login.html');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../Assets/Images/LogoSmall.png">
    <title>Chess Platform</title>
    <link rel="stylesheet" href="../Style/output.css">
    <script type="module" src="../src/js/game/Main.js"></script>
    <style>
        /* Custom CSS for text wrapping that might not be covered by Tailwind */
        .overflow-wrap-anywhere {
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        #chatMessages {
            max-width: 100%;
        }

        #chatMessages>div>div>p {
            max-width: 100%;
            word-wrap: break-word;
        }

        .message-text {
            word-break: break-all;
            overflow-wrap: break-word;
            white-space: normal;
            max-width: 100%;
            display: block;
        }

        .message-container {
            display: flex;
            width: 100%;
        }

        .message-content {
            flex: 1;
            min-width: 0;
            overflow: hidden;
        }

        /* Aggiunti per il loader */
        #connection-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(46, 46, 43, 0.95);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .spinner {
            animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .fade-out {
            animation: fadeOut 0.5s ease-in-out forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                visibility: hidden;
            }
        }
    </style>
</head>

<body class="bg-[#302E2B] min-h-screen" mode="local">
    <!-- Overlay di connessione -->
    <div id="connection-overlay" class="flex flex-col items-center justify-center text-center">
        <img src="../Assets/Images/LogoSmall.png" alt="Logo" class="h-16 w-auto mb-4">
        <div class="spinner rounded-full border-4 border-[#7c776f] border-t-[#7fa650] h-12 w-12 mb-4"></div>
        <div id="connection-status" class="text-white text-lg font-medium mb-2">Connecting to our servers...</div>
        <div id="connection-info" class="text-[#7c776f] text-sm">Please wait while we establish a secure connection</div>
        <button id="retry-connection" class="hidden mt-4 bg-[#7fa650] hover:bg-[#8fb760] text-white font-medium py-2 px-4 rounded">
            Retry Connection
        </button>
    </div>

    <!-- Chess.com-like Navbar -->
    <nav class="w-full bg-[#262522] px-4 py-3 flex justify-between items-center top-0 left-0">
        <div class="flex items-center">
            <!-- Logo -->
            <div class="flex items-center ml">
                <img src="../Assets/Images/LogoSmall.png" alt="Logo" class="h-8 w-auto">
            </div>
            <!-- Navigation Links (Chess.com style) -->
            <div class="hidden md:flex ml-6 space-x-4">
                <p class="text-white text-sm font-medium">Skibidichess - Multiplayer</p>
            </div>
            <div class="flex md:hidden ml-6 space-x-4">
                <p class="text-white text-sm font-medium">Multiplayer</p>
            </div>
        </div>


        <!-- User Profile -->
        <div class="flex items-center mr-2">
            <p class="text-white">
                <?php
                if ($sessionChecker->checkSession()) {
                    $username = $_SESSION['user']['username'];
                    $admin = $sessionChecker->checkAdmin();
                } else {
                    $username = "Guest";
                    $admin = 0;
                }

                echo $username;
                ?>
            </p>
            <div class="h-8 w-8 rounded-full overflow-hidden bg-gray-700 border border-gray-600 ml-2">
                <img src="../Assets/Images/ImgPlaceholder.jpg" alt="Profile" class="h-full w-full object-cover">
            </div>
        </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="md:px-4 lg:px-8 lg:max-w-[90%] md:max-w-[85%] max-w-[95%] mx-auto">
        <!-- Chess.com style layout with board on left, info right -->
        <div class="flex flex-col md:flex-row md:items-start gap-4 mt-2">
            <!-- Left Column - Chess Board -->
            <div class="md:w-auto md:flex-shrink-0">
                <!-- Board & Player Info -->
                <div class="bg-[#262522] rounded-md shadow-lg p-1 md:p-5">
                    <!-- Top Player Info -->
                    <div id="PlayerInfo" class="flex items-center h-10 m-1">
                        <img src="../Assets/Images/ImgPlaceholder.jpg" id="PlayerImg" class="aspect-square w-8 rounded">
                        <div class="ml-2 flex-1 h-10">

                            <div class="flex justify-between items-center">
                                <h2 id="PlayerName" class="text-neutral-50 font-bold text-[0.8rem]">Player SkibidiName</h2>
                            </div>

                            <div class="flex w-full h-[1.2rem]">
                                <div class="flex flex-row h-full" id="b-captured-pieces"></div>
                                <h2 id="b-Material-count" class="text-white invisible text-sm ml-2">+0</h2>
                            </div>

                        </div>
                    </div>

                    <!-- Chess Board -->
                    <canvas id="ChessBoard" class="rounded shadow-md w-full mx-auto"></canvas>

                    <!-- Bottom Player Info -->
                    <div id="PlayerInfo" class="flex items-center h-10 mt-1">
                        <img src="../Assets/Images/ImgPlaceholder.jpg" id="PlayerImg" class="aspect-square w-8 rounded">
                        <div class="ml-2 flex-1 h-10 ">

                            <div class="flex justify-between items-center">
                                <h2 id="PlayerName" class="text-neutral-50 font-bold text-[0.8rem]">Player SkibidiName</h2>
                            </div>

                            <div class="flex  w-full h-[1.2rem] ">
                                <div class="flex flex-row h-full" id="w-captured-pieces"></div>
                                <h2 id="w-Material-count" class="text-white invisible text-sm ml-2">+0</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Promotion Panel -->
                <div id="Promote" class="flex flex-row border-black border-2 invisible bg-[#262522] rounded-md absolute">
                    <button data-type="q"><img src="../Assets/Images/q1.svg"
                            class="hover:scale-110 transition duration-150 w-12 h-12"></button>
                    <button data-type="r"><img src="../Assets/Images/r1.svg"
                            class="hover:scale-110 transition duration-150 w-12 h-12"></button>
                    <button data-type="b"><img src="../Assets/Images/b1.svg"
                            class="hover:scale-110 transition duration-150 w-12 h-12"></button>
                    <button data-type="n"><img src="../Assets/Images/n1.svg"
                            class="hover:scale-110 transition duration-150 w-12 h-12"></button>
                </div>
            </div>

            <!-- Right Column - Game Info & Rankings -->
            <div class="flex-1 flex flex-col space-y-4">
                <!-- Game Info and Leaderboard in Two Columns with Same Height -->
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Game Info - Chess.com style -->
                    <div id="GameInfo" class="bg-[#262522] rounded-md p-3 shadow-lg md:w-1/2 flex flex-col">
                        <h2 class="text-white text-lg font-bold border-b border-[#302e2b] pb-2 mb-3">Game Info</h2>

                        <!-- Game Details -->
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span class="text-[#7c776f]">Time Control:</span>
                                <span class="text-white">10 min</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#7c776f]">Game Type:</span>
                                <span class="text-white">Player VS Player</span>
                            </div>
                        </div>

                        <!-- Move History in Chess.com style -->
                        <h3 class="text-white font-medium text-sm mb-2">Moves</h3>
                        <div class="bg-[#1e1d1b] p-2 rounded flex-grow overflow-y-auto mb-3">
                            <table class="w-full text-sm">
                                <tbody>
                                    <tr>
                                        <td class="text-white pr-2">1.</td>
                                        <td class="text-white pr-3">e4</td>
                                        <td class="text-white">e5</td>
                                    </tr>
                                    <tr>
                                        <td class="text-white pr-2">2.</td>
                                        <td class="text-white pr-3">Nf3</td>
                                        <td class="text-white">Nc6</td>
                                    </tr>
                                    <tr>
                                        <td class="text-white pr-2">3.</td>
                                        <td class="text-white pr-3">Bc4</td>
                                        <td class="text-white">Nf6</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Additional Game Controls -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="./SinglePlayerSettings.html">
                                <button class="GreenBtn text-sm py-2 w-full text-center">
                                    New Game
                                </button>
                            </a>
                            <a href="./index.php">
                                <button class="GreenBtn text-sm py-2 w-full text-center">
                                    Exit
                                </button>
                            </a>
                        </div>
                    </div>

                    <div id="GameToken" class="bg-[#262522] rounded-md p-3 shadow-lg md:w-1/2 flex flex-col">
                        <h2 class="text-white text-lg font-bold border-b border-[#302e2b] pb-2 mb-3">Party</h2>

                        <div id="gameReady" class="hidden">
                            <p class="text-white text-3xl mx-auto">ID: <span id="partyIdDisplay"></span></p>
                        </div>

                        <div id="createParty" class="mx-auto w-full">
                            <ol class="text-white mt-2 mb-2">
                                <li>Click on the button to generate code.</li>
                                <li>Share the code with your friend.</li>
                                <li>Play SkibidiChess.</li>
                            </ol>
                            <button onclick="generateNewPartyToken()" class="GreenBtn text-sm py-2 mx-auto text-center">
                                Create New Party
                            </button>
                            <p class="text-small text-white mt-6 mb-3">Or join a game.</p>
                            <div class="flex mb-1">
                                <input type="text" id="partyId" placeholder="Party ID" class="bg-[#1e1d1b] text-white  rounded-l p-2 outline-none border border-[#302e2b]">
                                <button onclick="joinGame()" class="GreenBtnNoBorderBottom px-4 rounded-l-none border-0">
                                    Join Game
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Area - Full width -->
                <div class="bg-[#262522] rounded-md p-3 shadow-lg flex flex-col">
                    <h2 class="text-white text-lg font-bold border-b border-[#302e2b] pb-2 mb-3">Game Chat</h2>

                    <!-- Chat Messages Area with auto-scroll -->
                    <div id="chatContainer" class="bg-[#1e1d1b] p-2 rounded h-48 overflow-y-auto mb-3 w-full">
                        <div id="chatMessages" class="space-y-2 w-full px-2">
                            <!-- Messages will be added here dynamically -->
                            <div class="message-container items-start mb-2">
                                <img src="../Assets/Images/ImgPlaceholder.jpg" class="w-6 h-6 rounded-full mr-2 flex-shrink-0">
                                <div class="message-content">
                                    <p class="text-[#7fa650] text-xs">System</p>
                                    <p class="message-text text-white text-sm">Welcome to SkibidiChess! Good luck and have fun!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Store current username in a hidden input for easy access -->
                    <input type="hidden" id="currentUsername" value="<?php echo htmlspecialchars($username); ?>">

                    <!-- Chat Input Area with fixed spacing -->
                    <div class="flex mb-1">
                        <input type="text" id="chatMessage" placeholder="Type your message..." maxlength="200"
                            class="bg-[#1e1d1b] text-white flex-grow rounded-l p-2 outline-none border border-[#302e2b]">
                        <button class="GreenBtnNoBorderBottom px-4 rounded-l-none" onclick="chat()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.5.5 0 0 1-.927.02L7.443 10.8 1.1 8.033a.5.5 0 0 1 .02-.927L15.664.035a.5.5 0 0 1 .19.111z" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-xs text-[#7c776f] text-right flex justify-end items-center gap-2">
                        <span>Max: 200 characters</span>
                        <span id="charCounter" class="text-xs">0/200</span>
                    </div>
                </div>

                <!-- Advertisement Space - Full width -->
                <div class="bg-[#262522] rounded-md p-3 shadow-lg mb-5">
                    <h2 class="text-white text-lg font-bold border-b border-[#302e2b] pb-2 mb-3">Sponsors</h2>
                    <div class=" h-32 bg-[#1e1d1b] rounded-md flex items-center justify-center">
                        <div class="text-center">
                            <p class="text-[#7c776f]">Advertisement Space</p>
                            <p class="text-[#7c776f] text-sm">Become a sponsor of Skibidichess</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        let ws;
        let reconnectAttempts = 0;
        const MAX_RECONNECT_ATTEMPTS = 3;
        const RECONNECT_INTERVAL = 5000; 
        let Codice = null;
        let gameSession = null;

        // Elementi dell'interfaccia
        const connectionOverlay = document.getElementById('connection-overlay');
        const connectionStatus = document.getElementById('connection-status');
        const connectionInfo = document.getElementById('connection-info');
        const retryButton = document.getElementById('retry-connection');

        // Gestione dello stato della connessione
        function updateConnectionStatus(status, message, showRetry = false) {
            connectionStatus.textContent = status;
            connectionInfo.textContent = message;

            if (showRetry) {
                retryButton.classList.remove('hidden');
            } else {
                retryButton.classList.add('hidden');
            }

        }

        // Inizializza WebSocket con gestione degli errori
        function initWebSocket() {
            
            // Mostra l'overlay di connessione
            connectionOverlay.style.display = 'flex';
            updateConnectionStatus('Connecting to our servers...', 'Please wait while we establish a secure connection');
            // CAMBIARE IP PER TESTARE
            ws = new WebSocket('ws://89.36.211.130:9000');
            // Gestisce l'apertura della connessione
            ws.onopen = () => {
                console.log('Connessione WebSocket stabilita');
                reconnectAttempts = 0;

                // Aggiorna lo stato e l'indicatore
                updateConnectionStatus('Connection established!', 'You are now connected to SkibidiChess servers');


                // Nascondi l'overlay dopo un breve ritardo // ANIMAZIONE
                setTimeout(() => {
                    connectionOverlay.classList.add('fade-out');
                    setTimeout(() => {
                        connectionOverlay.style.display = 'none';
                        connectionOverlay.classList.remove('fade-out');
                    }, 500);
                }, 1000);
            };

            // Gestisce i messaggi in arrivo
            ws.onmessage = (event) => {
                try {
                    const msg = JSON.parse(event.data);
                    console.log('Messaggio ricevuto:', msg);

                    switch (msg.type) {
                        case 'player_joined':
                            document.getElementById('createParty').classList.add('hidden');
                            document.getElementById('gameReady').classList.remove('hidden');
                            document.getElementById('partyIdDisplay').textContent = msg.gameId;
                            break;
                        case 'chatMessage':
                            if (msg.success == true)
                                addChatMessage(msg.from, msg.message, msg.isFromAdmin, msg.isBroadcast);
                            else
                                showNotification(msg.message, 'error');
                            break;
                            // Aggiungi altri tipi di messaggi se necessario
                    }
                } catch (error) {
                    console.error('Errore parsing messaggio:', error);
                }
            };

            // Gestisce la chiusura della connessione
            ws.onclose = (event) => {
                console.log('Connessione WebSocket chiusa', event);


                // Tenta la riconnessione se non abbiamo superato il limite di tentativi
                if (reconnectAttempts < MAX_RECONNECT_ATTEMPTS) {
                    reconnectAttempts++;

                    // Aggiorna lo stato
                    updateConnectionStatus(
                        'Connection lost',
                        `Attempting to reconnect (${reconnectAttempts}/${MAX_RECONNECT_ATTEMPTS})...`
                    );

                    // Mostra di nuovo l'overlay se era stato nascosto
                    connectionOverlay.style.display = 'flex';

                    // Prova a riconnettersi dopo un intervallo
                    setTimeout(initWebSocket, RECONNECT_INTERVAL);
                } else {
                    // Abbiamo raggiunto il limite di tentativi
                    updateConnectionStatus(
                        'Connection failed',
                        'Unable to connect to the server after multiple attempts',
                        true
                    );
                }
            };

            // Gestisce gli errori di connessione
            ws.onerror = (error) => {
                console.error('Errore WebSocket:', error);
                updateConnectionStatus('Connection error', 'An error occurred while connecting to the server', true);

                // Non è necessario chiudere la connessione qui, onclose verrà chiamato automaticamente
            };
        }

        // Gestisce il pulsante di riconnessione
        if (retryButton) {
            retryButton.addEventListener('click', () => {
                reconnectAttempts = 0; // Reset dei tentativi
                initWebSocket();
            });
        }


        // Funzione per generare un nuovo token di partita
        async function generateNewPartyToken() {
            try {
                // Verifica prima la connessione
                if (!ws || ws.readyState !== WebSocket.OPEN) {
                    return;
                }

                const response = await fetch('../Backend/Game.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'createNewGame'
                    })
                });

                const data = await response.json();
                console.log(data);

                if (data.success === true) {
                    // Preso il token dal db
                    Codice = data.tokenSession;
                    gameSession = data;

                    ws.send(JSON.stringify({
                        type: "create",
                        gameId: Codice
                    }));
                }
            } catch (error) {
                console.error('Errore nella creazione della partita:', error);
                showNotification('Errore nella connessione al server. Riprova più tardi.', 'error');
            }
        }

        // Funzione per unirsi a una partita
        async function joinGame() {
            try {
                // Verifica prima la connessione
                if (!ws || ws.readyState !== WebSocket.OPEN) {
                    showNotification('Non sei connesso al server. Ricarica la pagina e riprova.', 'error');
                    return;
                }

                Codice = document.getElementById("partyId").value;

                if (!Codice || Codice.trim() === '') {
                    showNotification('Inserisci un ID di partita valido', 'warning');
                    return;
                }

                const response = await fetch('../Backend/Game.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'joinGame',
                        token: Codice
                    })
                });

                const data = await response.json();
                console.log(data);

                if (data.success) {
                    ws.send(JSON.stringify({
                        type: "join",
                        gameId: data.tokenSession
                    }));
                } else {
                    showNotification(data.message || "Errore nell'unirsi alla partita. Verifica il codice e riprova.", 'error');
                }
            } catch (error) {
                console.error("Errore nell'unirsi alla partita:", error);
                showNotification('Errore nella connessione al server. Riprova più tardi.', 'error');
            }
        }

        // Funzione per inviare messaggi in chat
        async function chat() {
            try {
                // Verifica prima la connessione
                if (!ws || ws.readyState !== WebSocket.OPEN) {
                    showNotification('Non sei connesso al server. Ricarica la pagina e riprova.', 'error');
                    return;
                }

                // Richiedi il token attuale direttamente dal server
                const tokenResponse = await fetch('../Backend/Game.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'getEncryptedSessionToken'
                    })
                });

                const tokenData = await tokenResponse.json();
                const tokenSicuro = tokenData.token;

                console.log("Token sicuro dalla sessione:", tokenSicuro);
                const messageInput = document.getElementById('chatMessage');
                const message = messageInput.value;

                // Non inviare messaggi vuoti
                if (!message.trim()) return;

                const username = <?php echo json_encode($username); ?>;

                ws.send(JSON.stringify({
                    type: "chat",
                    gameId: tokenSicuro,
                    message: message,
                    fromPlayer: username
                }));

                // Pulisci l'input dopo l'invio
                messageInput.value = '';
            } catch (error) {
                console.error("Errore nell'invio del messaggio:", error);
                showNotification('Errore nella connessione al server. Riprova più tardi.', 'error');
            }
        }

        // Funzione per aggiungere messaggi alla chat
        function addChatMessage(username, message, admin, broadcast) {
            const chatArea = document.getElementById('chatMessages');
            const chatContainer = document.getElementById('chatContainer');

            // Crea gli elementi del messaggio
            const messageContainer = document.createElement('div');
            messageContainer.className = 'flex items-start mb-2 w-full';

            const avatar = document.createElement('img');
            avatar.src = '../Assets/Images/ImgPlaceholder.jpg';
            avatar.className = 'w-6 h-6 rounded-full mr-2 flex-shrink-0';

            const messageContent = document.createElement('div');
            messageContent.className = 'flex-1 min-w-0'; // min-w-0 è importante per gli elementi flex con testo

            const usernameElement = document.createElement('p');
            if (admin) {
                if (broadcast) {
                    usernameElement.className = 'text-[#b92828] text-xs';
                    usernameElement.textContent = username + " (ADMIN) in BROADCAST";
                } else {
                    usernameElement.className = 'text-[#b92828] text-xs';
                    usernameElement.textContent = username + " (ADMIN)";
                }
            } else {
                usernameElement.className = 'text-[#7fa650] text-xs';
                usernameElement.textContent = username;
            }

            const messageText = document.createElement('p');
            messageText.className = 'text-white text-sm break-all break-words overflow-wrap-anywhere';
            messageText.style.maxWidth = '100%';
            messageText.style.wordWrap = 'normal';
            messageText.textContent = message;

            // Assembla il messaggio
            messageContent.appendChild(usernameElement);
            messageContent.appendChild(messageText);

            messageContainer.appendChild(avatar);
            messageContainer.appendChild(messageContent);

            // Aggiungi all'area della chat
            chatArea.appendChild(messageContainer);

            // Pulisci il campo di input dopo l'invio
            document.getElementById('chatMessage').value = '';

            // Scorri verso il basso - assicurati di scorrere il contenitore
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Funzione per controllare la connessione periodicamente
        function checkConnection() {
            if (ws && ws.readyState === WebSocket.OPEN) {
                // Invia un ping per mantenere la connessione attiva
                ws.send(JSON.stringify({
                    type: "ping"
                }));
            } else if (ws && ws.readyState !== WebSocket.CONNECTING) {
                // Se la connessione è chiusa e non stiamo già tentando di riconnetterci
                console.log("Connessione persa. Tentativo di riconnessione...");
                updateConnectionStatus(
                    'Connection lost',
                    'Attempting to reconnect...'
                );

                // Mostra di nuovo l'overlay se era stato nascosto
                connectionOverlay.style.display = 'flex';

                // Inizia il processo di riconnessione
                reconnectAttempts = 0;
                initWebSocket();
            }
        }

        // Setup degli event listener quando il DOM è caricato
        document.addEventListener('DOMContentLoaded', function() {
            // Inizia la connessione WebSocket quando la pagina è caricata
            initWebSocket();

            // Configura un intervallo per controllare periodicamente la connessione (ogni 30 secondi)
            setInterval(checkConnection, 30000);

            // Setup dell'input della chat
            const chatInput = document.getElementById('chatMessage');
            if (chatInput) {
                chatInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        chat();
                    }
                });

                // Aggiungi funzionalità contatore caratteri
                chatInput.addEventListener('input', function() {
                    const maxLength = parseInt(this.getAttribute('maxlength')) || 200;
                    const currentLength = this.value.length;
                    const charCounter = document.getElementById('charCounter');

                    // Aggiorna il contatore se esiste
                    if (charCounter) {
                        charCounter.textContent = `${currentLength}/${maxLength}`;

                        // Aggiungi colore di avviso quando ci si avvicina al limite
                        if (currentLength > maxLength * 0.8) {
                            charCounter.classList.add('text-amber-500');
                        } else {
                            charCounter.classList.remove('text-amber-500');
                        }
                    }
                });
            }

            // Inizializza la posizione di scorrimento della chat
            const chatContainer = document.getElementById('chatContainer');
            if (chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        });
    </script>
</body>