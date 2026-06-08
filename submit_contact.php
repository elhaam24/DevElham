<?php
header('Content-Type: application/json');
include 'includes/db_connect.php';

$response = [
    'status' => 'error',
    'message' => 'Invalid request method.'
];

if (!$conn) {
    $response['message'] = 'Database connection failed. Please ensure your database is running and configured correctly.';
    echo json_encode($response);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (empty($name) || empty($email) || empty($message)) {
        $response['message'] = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Please enter a valid email address.';
    } else {
        // Attempt insert with the new c_status column first
        $stmt = @$conn->prepare("INSERT INTO contact (c_name, c_email, c_message, c_status) VALUES (?, ?, ?, 'unread')");
        
        if (!$stmt) {
            // Robust Fallback: If c_status column is missing in the database table, use the original schema columns
            $stmt = @$conn->prepare("INSERT INTO contact (c_name, c_email, c_message) VALUES (?, ?, ?)");
        }

        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $message);
            
            if ($stmt->execute()) {
                $response['status'] = 'success';
                $response['message'] = 'Thank you! Your message has been sent successfully.';
            } else {
                $response['message'] = 'Failed to submit: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $response['message'] = 'Database preparation error: ' . $conn->error;
        }
    }
}

$conn->close();
echo json_encode($response);
exit;
