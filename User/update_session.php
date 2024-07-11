<?php
session_start();

if (isset($_SESSION['selectedSeats'])) {
    $selectedSeats = $_SESSION['selectedSeats'];
    echo 'Selected Seats: ' . implode(', ', $selectedSeats);
} else {
    echo 'No seats selected.';
}
