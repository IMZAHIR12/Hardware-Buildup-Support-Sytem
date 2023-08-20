<?php
// Establish a database connection
global $conn;
require_once 'connection.php';

// Retrieve user details from the database
// Replace 'users' with your actual table name
$query = "SELECT * FROM users WHERE users_id = 1"; // You can change the user_id as needed
$result = $conn->query($query);

if ($result->num_rows === 1) {
    $userDetails = $result->fetch_assoc();

    // Create an HTML structure with user details
    $html = '<p>Username: ' . $userDetails['users_name'] . '</p>';
    $html .= '<p>Email: ' . $userDetails['users_email'] . '</p>';
    $html .= '<p>Birth: ' . $userDetails['users_birth'] . '</p>';
    $html .= '<p>Gender: ' . $userDetails['users_gender'] . '</p>';
    $html .= '<p>Nationality: ' . $userDetails['users_nationality'] . '</p>';
    $html .= '<p>Jobtitle: ' . $userDetails['users_jobtitle'] . '</p>';
    // Add more fields as needed

    echo json_encode($html);
} else {
    echo json_encode('User details not found.');
}

$conn->close();
?>

