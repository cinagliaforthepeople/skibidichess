<?php

namespace Skibidi;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/SessionChecker.php';

use PDO;
use Exception;
use Symfony\Component\HttpFoundation\Session\Session;

class Game
{
    private $conn;

    private function checkTokenExistance($token)
    {
        try {
            $sql = "select * from active_games g where g.id = :token";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result)
                return true;
            else
                return false;
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => "Erorr, Try again later."
            ]);
            return false;
        }
    }

    public function __construct()
    {
        $Database = new Database();
        $this->conn = $Database->getConnection();
    }

    public function createNewGame()
    {
        // Make sure session is started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $session = $_SESSION['user'];
        $token = random_int(100000, 999999);
        $time = time(); // il time deve iniziare quando entra laltro giocatore
        try {
            if (!$this->checkTokenExistance($token)) {
                $sql = "INSERT INTO active_games (id, creation_date, creator_id) VALUES (:token, NOW(), :cid)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':token', $token);
                $stmt->bindParam(':cid', $session['id']);
                $stmt->execute();
                $_SESSION['game'] = [
                    'token' => $token
                ];
                echo json_encode([
                    'success' => true,
                    'tokenSession' => $_SESSION['game']['token'],
                    'time' => $time
                ]);
            } else {
                $this->createNewGame();
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => "Database Error while generating new game code, try again later." . $e->getMessage()
            ]);
        }
    }

    // Ottiene il token dalla sessione (non cifrato)
    public function getSessionToken()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['game']) && isset($_SESSION['game']['token'])) {
            echo json_encode([
                'success' => true,
                'token' => $_SESSION['game']['token']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No active game session found',
                'token' => null
            ]);
        }
    }

    // Ottiene il token dalla sessione e lo cifra
    public function getEncryptedSessionToken()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['game']) && isset($_SESSION['game']['token'])) {
            $gameToken = $_SESSION['game']['token'];
            $encryptedToken = $this->encryptData($gameToken, "skibidichessskibidichess12345678");

            echo json_encode([
                'success' => true,
                'token' => $encryptedToken
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No active game session found',
                'token' => null
            ]);
        }
    }

    function encryptData($data, $key)
    {
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
        return $combined;
    }

    // Decifra i dati cifrati
    private function decryptData($encrypted, $key)
    {
        // Assicura che la chiave sia esattamente 32 byte
        $key = str_pad(substr($this->$key, 0, 32), 32);

        // Decodifica da base64
        $data = base64_decode($encrypted);

        // Estrai IV (primi 16 bytes) e dati cifrati
        $iv = substr($data, 0, 16);
        $encryptedData = substr($data, 16);

        // Decifra
        $decrypted = openssl_decrypt($encryptedData, 'aes-256-cbc', $key, 0, $iv);

        // Restituisci i dati decifrati
        return $decrypted;
    }


    public function endGame()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $token = $_SESSION['game']['token'];
        
        try {
            if ($this->checkTokenExistance($token)) {

                // elimina dal db

                $_SESSION['game'] = [
                    'token' => null
                ];

                echo json_encode([
                    'success' => true
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Game not found'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error joining game: ' . $e->getMessage()
            ]);
        }
    }

    public function joinGame($token)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        try {
            if ($this->checkTokenExistance($token)) {
                $_SESSION['game'] = [
                    'token' => $token
                ];
                echo json_encode([
                    'success' => true,
                    'tokenSession' => $_SESSION['game']['token']
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Game not found'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error joining game: ' . $e->getMessage()
            ]);
        }
    }
}

header('Content-Type: application/json');

$sessinChecker = new SessionChecker();
if(!$sessinChecker->checkSession())
{
    echo json_encode([
        'success' => false,
        'message' => "Not logged in."
    ]);
    exit();
}

$Game = new Game();

$data = json_decode(file_get_contents("php://input"), true);
if ($data) {
    $action = $data['action'];
    switch ($action) {
        case 'createNewGame':
            $Game->createNewGame();
            break;
        case 'endGame':
            $Game->endGame();
            break;
        case 'joinGame':
            $Game->joinGame($data['token']);
            break;
        case 'getSessionToken':
            $Game->getSessionToken();
            break;
        case 'getEncryptedSessionToken':
            $Game->getEncryptedSessionToken();
            break;
        
    }
}