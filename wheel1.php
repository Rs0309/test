<?php
// Enable CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json");

// Parse JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate data
if (!$data || !isset($data['name'], $data['email'], $data['phone'], $data['address'], $data['invoice'], $data['pincode'], $data['gift'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit();
}

// Database connection
$conn = new mysqli("your-mysql-host.com", "db_username", "db_password", "db_name");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit();
}
// Step 1: Check if phone already exists
$check = $conn->prepare("SELECT sr FROM spin_results WHERE phone = ?");
$check->bind_param("s", $data['phone']);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode(["status" => "duplicate", "message" => "User has already spun the wheel"]);
    $conn->close();
    exit();
}
// Insert user spin result
$stmt = $conn->prepare("INSERT INTO spin_results (name, email, phone, address, invoice, pincode, gift) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $data['name'], $data['email'], $data['phone'], $data['address'], $data['invoice'], $data['pincode'], $data['gift']);
$stmt->execute();

// Decrease gift count only if remaining > 0
$update = $conn->prepare("UPDATE gifts SET remaining = remaining - 1 WHERE name = ? AND remaining > 0");
$update->bind_param("s", $data['gift']);
$update->execute();

// Final response
echo json_encode(["status" => "success"]);
$conn->close();
?>
