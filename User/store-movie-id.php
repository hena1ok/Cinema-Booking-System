<?php
// Start or resume the session
session_start();

// Check if movie_id is set in the POST data
if (isset($_POST['movie_id'])) {
  // Store movie_id in the session
  $_SESSION['movie_id'] = $_POST['movie_id'];

  // Check if schedule_id is set in the POST data
  if (isset($_POST['schedule_id'])) {
    // Store schedule_id in the session
    $_SESSION['schedule_id'] = $_POST['schedule_id'];
  } else {
    $_SESSION['schedule_id'] = 1;
    // Handle the case where schedule_id is not set
    // You can add appropriate error handling or redirection here
  }
} else {
  $_SESSION['movie_id'] = 1;
  // Handle the case where movie_id is not set
  // You can add appropriate error handling or redirection here
}
