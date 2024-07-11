<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role == 'admin') {
        header("Location: ../index.php");
        exit();
    } elseif ($role == 'user') {
        header("Location: ../../User/index.php");
        exit();
    }
} else {
    // Role not defined or unauthorized access
    header("Location: login.php"); // Redirect to a default page
    exit();
}
