<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'Messages.php'; // Include the Messages class
use Christan\Messages;

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Retrieve POST data
$sender_id = $_POST['sender_id'] ?? null;
$receiver_id = $_POST['receiver_id'] ?? null;
$message = $_POST['message'] ?? null;

// Create an instance of the Messages class
$messages = new Messages();

// Call the sendMessage function to handle the message saving
$messages->sendMessage($sender_id, $receiver_id, $message);
