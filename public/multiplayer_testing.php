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
    <title>SkibidiChess :: Not Available</title>
    <link rel="shortcut icon" href="../Assets/Images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="../Style/output.css">
</head>

<body class="bg-[#302E2B] overflow-hidden">
    <div class="flex items-center min-h-screen flex-col justify-center px-4">
        <img src="../Assets/Images/Logo.png" class="w-full max-w-[280px] md:max-w-[400px] mb-6 md:mb-8 drop-shadow-lg md:drop-shadow-[0_77px_35px_rgba(0,0,0,0.25)]">
        <script>
            var Codice = null;
            var gameSession = null;

            async function GeneraCodice() {
                console.log("Inizio generazione")
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
                console.log(data)
                console.log("----------------------")
                if (data.success === true) {
                    console.log(data.tokenSession)
                    // Salva il token direttamente nella variabile globale
                    Codice = data.tokenSession;
                    gameSession = data;

                    ws = new WebSocket('ws://localhost:9000');
                    ws.onopen = () => {
                        ws.send(JSON.stringify({
                            type: "create",
                            gameId: Codice
                        }));
                    };
                    ws.onmessage = (event) => {
                        const msg = JSON.parse(event.data);
                        console.log(msg)
                    };
                }
            }
        </script>
        <a href="#"> <button class="GreenBtn mt-5" onclick="GeneraCodice()">Codice</button></a>
        <script>
            function Join() {
                Codice = document.getElementById("Testo").value
                ws = new WebSocket('ws://localhost:9000');
                ws.onopen = () => {
                    ws.send(JSON.stringify({
                        type: "join",
                        gameId: Codice
                    }));
                };
                ws.onmessage = (event) => {
                    const msg = JSON.parse(event.data);
                    console.log(msg)
                };
            }
        </script>
        <input type="number" id="Testo" class="w-50 m-10 bg-amber-200">
        <button class="GreenBtn mt-5" onclick="Join()">Joina</button>
        <script>
            async function chat() {
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

                ws = new WebSocket('ws://localhost:9000');
                ws.onopen = () => {
                    ws.send(JSON.stringify({
                        type: "chat",
                        gameId: tokenSicuro,
                        message: "ciao"
                    }));

                    ws.onmessage = (event) => {
                        const msg = JSON.parse(event.data);
                        console.log(msg.saluto)
                    };
                }
            }
        </script>
        <button class="GreenBtn mt-5" onclick="chat()">Nigga</button>
    </div>
</body>

</html>