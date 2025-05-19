<?php
    // agg controllo dappertutto
    require "../../db_connection.php";

    header('Content-Type: application/json');

    $data = json_decode(file_get_contents("php://input"), true);

    if($data)
    {
        $user = $data['username'];
    }
    try
    {
        $sql = "SELECT * FROM accounts WHERE user = :user";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result)
        {
            echo json_encode(['success' => true, 'status' => true]);
        }else
        {
            echo json_encode(['success' => true, 'status' => false]);
        }
    }catch(PDOException $e)
    {
        echo json_encode(['success' => false, 'error', $e]);
    }

?>