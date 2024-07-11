<?php
session_start();
include "../../Config/Connection.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_otp = $_POST['otp'];
    $stored_otp = $_SESSION['otp'];

    if ($user_otp == $stored_otp) {
        // OTP matched, update user's OTP verification status in the database
        $sql = "UPDATE users SET otp_verified = 1 WHERE otp = '$user_otp'";
        if ($conn->query($sql) === TRUE) {
            echo "OTP verified successfully. You can now login.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
$conn->close();
