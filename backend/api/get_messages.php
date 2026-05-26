<?php

header('Content-Type: application/json');

$conn = new mysqli("localhost", "root", "", "hello_world");

if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "error" => "Database connection failed"
    ]);
    exit;
}

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);

$messages = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    echo json_encode([
        "success" => true,
        "messages" => $messages
    ]);
} else {
    echo json_encode([
        "success" => false,
        "error" => "Query failed"
    ]);
}

$conn->close();
?>
