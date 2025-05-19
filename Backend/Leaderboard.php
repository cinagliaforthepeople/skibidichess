<?php
error_reporting(0);

require_once __DIR__ . '/Database.php';

use Skibidi\Database;

class Leaderboard
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getLeaderboard($rows)
    {
        if (empty($rows)) {
            echo json_encode(['success' => false, 'message' => 'Rows number not specified.']);
            exit();
        }

        try {
            $sql = "select username, pts from accounts a where a.active = true order by a.pts desc limit :rows";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':rows', $rows, PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode([
                'success' => true,
                'leaderboard' => $stmt->fetchAll(PDO::FETCH_ASSOC)
            ]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }
}

$lb = new Leaderboard();
header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);
if ($data) {
    $action = $data['action'];
    switch ($action) {
        case 'getLeaderboard':
            $lb->getLeaderboard($data['rows']);
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No data received.']);
}
