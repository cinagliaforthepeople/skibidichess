<!DOCTYPE html>
<html lang="en">
<?php
require_once '../Backend/SessionChecker.php';

use Skibidi\SessionChecker;

$sessionChecker = new SessionChecker();
if ($sessionChecker->checkSession()) {
    $username = $_SESSION['user']['username'];
    $admin = $sessionChecker->checkAdmin();
} else {
    $username = "Guest";
    $admin = 0;
}
echo $username;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script>
        let ws; // Mantieni la connessione in una variabile globale

        async function initWebSocket() {
            ws = new WebSocket('ws://93.67.104.237:9000');

            ws.onmessage = (event) => {
                const msg = JSON.parse(event.data); // Parsea il JSON
                console.log('Messaggio ricevuto:', msg);
            };

            ws.onclose = () => {
                console.log('Connessione chiusa');
            };
        }

        // Chiama questa funzione una sola volta all'inizio
        initWebSocket();
        // generazione codice pura 
        var Codice = null;
        var gameSession = null;
        async function adminChat() {


            message = prompt("message:");
            tokenSicuro = prompt("token");
            // Don't send empty messages
            if (!message.trim()) return;

            username = <?php echo json_encode($username) ?>;

            ws.send(JSON.stringify({
                type: "adminBroadcastChat",
                message: message,
                fromPlayer: username
            }));

        }

        adminChat();
    </script>
</body>

</html>