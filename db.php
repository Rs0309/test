<?php
$conn = new mysqli(
    "sql12.freesqldatabase.com", // Host
    "sql12790205",               // Username
    "1QEMU1QKeP",                // Password
    "sql12790205",               // Database name
    3306                         // Port number (optional but good to specify)
);

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}
?>
