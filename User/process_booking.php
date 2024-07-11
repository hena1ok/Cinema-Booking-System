<?php
include("../Config/Connection.php");
session_start();

$user_id = $_SESSION['user_id'];
$schedule_id = $_SESSION['schedule_id'];
$seat_id = $_SESSION['seat_id'];

if (isset($_POST['seats'])) {
    $seats = json_decode($_POST['seats'], true);

    if (!empty($seats) && $schedule_id && $user_id) {
        $success = true;
        $errors = [];

        foreach ($seats as $seat_number) {
            $seat_number = intval($seat_number);  // Ensure seat number is an integer
            $booking_date = date('Y-m-d H:i:s');

            // Insert booking into the bookings table
            $query = "INSERT INTO bookings (user_id, schedule_id, seat_number, booking_date) VALUES ('$user_id', '$schedule_id', '$seat_id', '$booking_date')";
            if (!mysqli_query($getConnection, $query)) {
                $success = false;
                $errors[] = "Error booking seat $seat_number: " . mysqli_error($getConnection);
            }
        }

        if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => implode(', ', $errors)]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid input or session data.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No seats selected.']);
}
