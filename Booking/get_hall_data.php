<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../Config/Connection.php';
// Create connection
$getConnection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($getConnection->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

if (isset($_GET['hall_id'])) {
    $hall_id = intval($_GET['hall_id']);

    $query = "SELECT seating_arrangement FROM halls1 WHERE Id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $hall_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $seating_arrangement = [];
        if ($result && $result->num_rows > 0) {
            $seating_arrangement = $result->fetch_assoc();
        }

        echo json_encode($seating_arrangement);
    } else {
        echo json_encode(["error" => "Failed to prepare statement"]);
    }
} else {
    echo json_encode(["error" => "Hall ID not set"]);
}
