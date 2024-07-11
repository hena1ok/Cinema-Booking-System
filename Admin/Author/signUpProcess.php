<?php
session_start();
include "db_connect.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
 
  
    if ($conn->query($sql) === TRUE) {
        // Send OTP via email (replace placeholders with actual email sending code)
        $to = $email;
        $subject = "OTP Verification";
        $message = "Your OTP is: $otp";
        $headers = "From: your_email@example.com";
        mail($to, $subject, $message, $headers);
        echo "OTP sent to your email. Please verify.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
