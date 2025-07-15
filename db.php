<?php
$conn = new mysqli("your-mysql-host.com", "db_username", "db_password", "db_name");

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed: " . $conn->connect_error
    ]);
    exit();
}
?>
