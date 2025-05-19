<?php

require_once "../../vendor/autoload.php";

require "../GameUtilities.php";


// AGGIUNGERE AUTH TRAMITE TOKEN

/*
UNA COSA DEL GENERE:
TOKEN PER UTENTE NEL DATABASE (UNIVOCO)
AL MOMENTO DELLA CHIAMATA A WEBSOCKET INVIA TOKEN IN GET COME SOTTO E VERIFICA SUL DB (CONTROLLARE SOLO ALLA CONNESSIONE SENNO RALLENTA TUTTO)

CONTROLLARE PERMESSI ADMIN E NON -> STORARE DA QUALCHE PARTE (IN CLIENTS? METTERE UNA SPECIE DI MAPPA / OGGETTO CON token - permessi?)
A OGNI METEDO QUI CONTROLLI IN CLIENTS POI 
-- DA VERIFICARE -- IMPORTANTE
// Ottieni prima un token valido dal tuo backend
async function getAuthToken() {
    const response = await fetch('/api/get-ws-token');
    return await response.json();
}

// Connessione sicura
getAuthToken().then(token => {
    const ws = new WebSocket(`ws://tuo-server:9000?token=${token}`);
    
    ws.onmessage = (event) => {
        const data = JSON.parse(event.data);
        if (data.error) {
            console.error(data.error);
            return;
        }
        // Gestisci messaggi validi
    };
});

*/

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;



class ChessGame implements MessageComponentInterface
{
    protected $games = [];          // [ gameId => [connection1, connection2 ] ]


    /* 
        formato per mantenere le partite:


            $games = [

                GameID => [

                    'PlayerID1' => [

                        'Time' => tempo rimasto del giocatore,
                        'color' => Colore del giocatore,
                        'LastTiming' => secondi impiegati per effettuare l'ultima mossa,
                    ],

                    'PlayerID2' => [

                        'Time' => tempo rimasto del giocatore,
                        'color' => Colore del giocatore,
                        'LastTiming' => secondi impiegati per effettuare l'ultima mossa,,
                    ],
                    

                    'FEN' => Fen Della Partita,
                    'Turn' => Turno del giocatore,
                    'LastMove' => Ultima Mossa fatta nella partita
                ]
            ]


            LastMove e LastTiming in modo da rendere piu efficiente la struttura, gli array interi possono essere memorizzati all'interno delle cache del browser.

            ------ DA VEDERE IN QUANTO SU PICCOLA SCALA AVERE GLI ARRAY DIRETTAMENTE NELLA STRUTTURA NON FA DIFFERENZA ------------

    */




    protected $clients = [];

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients[$conn->resourceId] = $conn;
        echo "New connection: {$conn->resourceId}\n";
    }

    public function onClose(ConnectionInterface $conn)
    {
        unset($this->clients[$conn->resourceId]);
        #echo "Connection closed: {$conn->resourceId}\n";

        foreach ($this->games as $gameId => &$game) {

            if (isset($game['players'][$conn->resourceId])) {
                unset($this->games[$gameId]);

                break;
            }
        }

        echo "Partita chiusa \n ";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }

    public function createGame(ConnectionInterface $from, $gameId)
    {

        $this->games[$gameId] = [];
        $this->games[$gameId]['players'][$from->resourceId] = [
            'connection' => $from,
            'color' => 'w'
        ];

        $this->games[$gameId]['turn'] = $from->resourceId;


        $from->send(json_encode([
            "type" => "player_joined",
            "gameId" => $gameId,
            "players" => count($this->games)
        ]));

        echo "Game created: {$gameId}\n";
    }

    public function joinGame($gameId, ConnectionInterface $from)
    {
        if (isset($this->games[$gameId])) {

            $this->games[$gameId]['players'][$from->resourceId] = [
                'connection' => $from,
                'color' => 'b'
            ];


            foreach ($this->games[$gameId]['players'] as $player) {
                $player['connection']->send(json_encode([
                    "type" => "player_joined",
                    "gameId" => $gameId,
                    "players" => count($this->games)
                ]));
            }

            echo "Player joined game: {$gameId}\n";
            echo  json_encode($this->games);
        } else {
            $from->send(json_encode([
                "type" => "error",
                "message" => "Game not found"
            ]));
            echo "Join attempt failed: Game {$gameId} not found\n";
        }
    }

    private function encryptData($data, $key)
    {
        // For debugging purposes only
        echo "Encrypting data: " . (is_string($data) ? $data : json_encode($data)) . "\n";

        $method = 'aes-256-cbc';
        $ivlen = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivlen);

        // Convert data to string if it's not already
        $dataStr = is_string($data) ? $data : json_encode($data);

        $encrypted = openssl_encrypt($dataStr, $method, $key, 0, $iv);
        if ($encrypted === false) {
            echo "Encryption failed\n";
            return null;
        }

        // Combine IV and encrypted data and encode
        $combined = base64_encode($iv . $encrypted);
        echo "Encrypted result: $combined\n";
        return $combined;
    }

    private function decryptData($encryptedData, $key)
    {
        echo "Attempting to decrypt: $encryptedData\n";

        $method = 'aes-256-cbc';

        // First base64 decode
        $data = base64_decode($encryptedData);
        if ($data === false) {
            echo "Base64 decoding failed\n";
            return null;
        }

        $ivlen = openssl_cipher_iv_length($method);
        if (strlen($data) < $ivlen) {
            echo "Insufficient data for IV (length: " . strlen($data) . ", needed: $ivlen)\n";
            return null;
        }

        // Extract IV and encrypted data
        $iv = substr($data, 0, $ivlen);
        $encrypted = substr($data, $ivlen);

        // Decrypt
        $decrypted = openssl_decrypt($encrypted, $method, $key, 0, $iv);
        if ($decrypted === false) {
            echo "Decryption failed - invalid key, IV, or encrypted data\n";
            return null;
        }

        echo "Successfully decrypted to: $decrypted\n";

        // Check if it's JSON and decode if so
        $decoded = json_decode($decrypted, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        // If not JSON, return as is (could be a simple string)
        return $decrypted;
    }

    public function adminBroadcastChat($message, $fromPlayer, $from)
    {
        echo "(ADMIN in BROADCAST) Message in Chat :: " . ">> " . $message . "\n";
        foreach ($this->games as $game) {
            foreach ($game as $player) {
                $player->send(json_encode([
                    "type" => "chatMessage",
                    "success" => true,
                    "from" => $fromPlayer,
                    "isFromAdmin" => true,
                    "isBroadcast" => true,
                    "message" => $message
                ]));
            }
        }
    }

    public function adminChat($gameId, $message, $fromPlayer, $from)
    {
        echo "(ADMIN) Message in Chat :: " . print_r($gameId, true) . ">> " . $message . "\n";

        if ($gameId && isset($this->games[$gameId])) {
            foreach ($this->games[$gameId] as $player) {
                $player->send(json_encode([
                    "type" => "chatMessage",
                    "success" => true,
                    "from" => $fromPlayer,
                    "isFromAdmin" => true,
                    "isBroadcast" => true,
                    "message" => $message,
                    "gameId" => $gameId
                ]));
                echo "(ADMIN) Message sent.\n";
            }
            echo "(ADMIN) Message sent to game: {$gameId}\n";
        } else {
            echo "Cannot send message - invalid game ID or game not found\n";
        }
    }

    public function chat($encryptedGameId, $message, $fromPlayer, $from)
    {
        // Try both direct string and JSON decoding approaches
        $gameId = $this->decryptData($encryptedGameId, "skibidichessskibidichess12345678");

        // Debug output 
        echo "Message in Chat :: " . print_r($gameId, true) . ">> " . $message . "\n";
        if (strlen($message) < 700) {
            // Check if $gameId is valid and exists in games array
            if ($gameId && isset($this->games[$gameId])) {
                foreach ($this->games[$gameId] as $player) {
                    $player->send(json_encode([
                        "type" => "chatMessage",
                        "success" => true,
                        "from" => $fromPlayer,
                        "isFromAdmin" => false,
                        "message" => $message,
                        "gameId" => $gameId
                    ]));
                }
                echo "Message sent to game: {$gameId}\n";
            } else {
                echo "Cannot send message - invalid game ID or game not found\n";
            }
        } else {
            $from->send(json_encode([
                "type" => "chatMessage",
                "success" => false,
                "message" => "Message too long."
            ]));
        }
    }

    public function move($from, $gameId, $start, $end)
    {

        if (isset($this->games[$gameId])) {
            if (ValidateMove($this->games[$gameId]['FEN'], $start, $end, $this->games['players'][$this->games[$gameId]['Turn']]['color'])) {
                foreach ($this->games[$gameId]['players'] as $player) {
                    if ($player['connection']->resourceId != $from->resourceId) {
                        $player['connection']->send(
                            json_encode([
                                "type" => "Move",
                                "start" => $start,
                                "end" => $end
                            ])
                        );
                    }
                }
            }
        }
    }


    public function getColor($gameId, $from)
    {
        $from->send(
            json_encode([
                "color" => $this->games[$gameId]['players'][$from->resourceId]['color']
            ])
        );
    }


    // ON MESSAGE
    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Received message: {$msg}\n";

        $request = json_decode($msg, true);
        if (!is_array($request) || !isset($request["type"])) {
            echo "Invalid message format\n";
            return;
        }

        switch ($request["type"]) {

            case "create":
                if (isset($request["gameId"])) {
                    $this->createGame($from, $request["gameId"]);
                } else {
                    echo "Missing gameId in create request\n";
                }
                break;

            case "join":
                if (isset($request["gameId"])) {
                    $this->joinGame($request["gameId"], $from);
                } else {
                    echo "Missing gameId in join request\n";
                }
                break;

            case "chat":
                if (isset($request["gameId"]) && isset($request["message"])) {
                    $this->chat($request["gameId"], $request["message"], $request['fromPlayer'], $from);
                } else {
                    echo "Missing gameId or message in chat request\n";
                }
                break;

            case "adminChat":
                if (isset($request["gameId"]) && isset($request["message"])) {
                    $this->adminChat($request["gameId"], $request["message"], $request['fromPlayer'], $from);
                } else {
                    echo "Missing gameId or message in chat request\n";
                }
                break;

            case "adminBroadcastChat":
                if (isset($request["message"])) {
                    $this->adminBroadcastChat($request["message"], $request['fromPlayer'], $from);
                } else {
                    echo "Missing message in broadcast chat request\n";
                }
                break;

            case "Move":
                if (isset($request["gameId"]) && isset($request["start"]) && isset($request["end"])) {
                    $this->move($from, $request["gameId"], $request["start"],  $request["end"]);
                } else {
                    echo "Missing gameId, start or end in move request\n";
                }
                break;
            case 'getColor':
                if (isset($request["gameId"])) {
                    $this->getColor($request['gameId'], $from);
                } else {
                    echo "Missing gameId, start or end in move request\n";
                }
                break;
            case 'ping':
                return;
                break;
            default:
                echo "Unknown message type: {$request["type"]}\n";
        }
    }
}

$server = IoServer::factory(
    new HttpServer(new WsServer(new ChessGame())),
    9000
);

echo "Server Running on port 9000...\n";
$server->run();
