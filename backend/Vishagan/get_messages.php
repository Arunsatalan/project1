<?php

use mishaf\DBConnector;

require 'DbConnector.php'; // Ensure this file exists and includes the database connection setup

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];

    if (!empty($sender_id) && !empty($receiver_id)) {
        $db = new DbConnector(); // Assuming this creates a database connection
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM message WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC");
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);

        $stmt->execute();
        $result = $stmt->get_result();
        $messages = [];

        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        echo json_encode($messages);

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>
