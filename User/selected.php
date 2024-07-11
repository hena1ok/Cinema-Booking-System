<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Styles/styleSchedule.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Styles/main.css?v=<?php echo time(); ?>">

    <style>
        .containers{
            margin-bottom: 500px !important;
        }
    </style>
</head>

<body>
    <?php include '../Add/header.php'; ?>
    <?php
    include '../config/Connection.php';


    // Get the user ID and schedule ID from the session
    $userId = $_SESSION['user_id'] ?? null;
    $scheduleId = $_SESSION['schedule_id'] ?? null;

    // Check if the user is logged in and the schedule ID is available
    if (!$userId || !$scheduleId) {
        http_response_code(400);
        logError("User ID or schedule ID not found.", 400);
        exit();
    }

    // Handle the form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize the input
        $selectedSeatsInput = filter_input(INPUT_POST, 'selectedSeatsInput', FILTER_SANITIZE_STRING);

        if ($selectedSeatsInput) {
            $selectedSeatsArray = explode(',', $selectedSeatsInput);

            // Book the selected seats
            if (bookSeats($userId, $scheduleId, $selectedSeatsArray)) {
                // Booking successful
                $successMessage = "Booking successful! Your seats are reserved.";

                // Check if the user is logged in and has a role
                if (isset($_SESSION['role'])) {
                    $userRole = $_SESSION['role'];

                    if ($userRole === 'user') {
                        displayReceipt($selectedSeatsArray, $successMessage);
                    } else {
                        displayReservedSeats($selectedSeatsArray, $successMessage);
                    }
                }
            } else {
                http_response_code(500);
                logError("An error occurred during booking.", 500);
            }
        } else {
            http_response_code(400);
            logError("Invalid input for selected seats.", 400);
        }
    }
    ?>

    
    <div class="containers" >
        <h1>Seat Booking</h1>
        <?php
        // Display success or error messages
        if (isset($successMessage)) {
            echo '<div class="alert alert-success">' . $successMessage . '</div>';
        } elseif (isset($errorMessage)) {
            echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
        }
        ?>
    </div>
    <?php
    // Function to book seats
    function bookSeats($userId, $scheduleId, $selectedSeatsArray)
    {
        global $getConnection;

        $currentDateTime = date('Y-m-d H:i:s');
        $getConnection->begin_transaction();

        try {
            foreach ($selectedSeatsArray as $seatNumber) {
                if (!insertBooking($userId, $scheduleId, $seatNumber, $currentDateTime)) {
                    logError("Error inserting seat number $seatNumber: " . $getConnection->error);
                    $getConnection->rollback();
                    return false;
                }

                if (!updateSeatStatus($seatNumber, 'reserved')) {
                    logError("Error updating seat status $seatNumber: " . $getConnection->error);
                    $getConnection->rollback();
                    return false;
                }
            }

            $getConnection->commit();
            return true;
        } catch (Exception $e) {
            $getConnection->rollback();
            logError("An error occurred during checkout: " . $e->getMessage(), 500);
            return false;
        }
    }

    // Function to display receipt for customers
    function displayReceipt($selectedSeatsArray, $successMessage)
    {
        $totalAmount = calculateTotalAmount($selectedSeatsArray);
    ?>
        <div class="container">
            <h1>Receipt</h1>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
            <p>Selected Seats: <?php echo implode(', ', $selectedSeatsArray); ?></p>
            <p>Total Amount: $<?php echo number_format($totalAmount, 2); ?></p>

        </div>
    <?php
    }

    // Function to display reserved seats for non-customers
    function displayReservedSeats($selectedSeatsArray, $successMessage)
    {
    ?>
        <div class="container">
            <h1>Reserved Seats</h1>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
            <p>Selected Seats: <?php echo implode(', ', $selectedSeatsArray); ?></p>

        </div>
    <?php
    }

    // Function to calculate total amount
    function calculateTotalAmount($selectedSeatsArray)
    {
        global $getConnection;

        $seatPrices = [];
        $stmt = $getConnection->prepare("SELECT price FROM seats WHERE Id = ?");
        $stmt->bind_param("i", $seatId);

        foreach ($selectedSeatsArray as $seatId) {
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $seatPrices[$seatId] = $row['price'];
            } else {
                logError("Error fetching seat price for seat ID: $seatId");
            }
        }

        $stmt->close();

        $totalAmount = array_sum($seatPrices);
        return $totalAmount;
    }

    // Function to log errors
    function logError($message, $errorCode = 0)
    {
        $logMessage = "[" . date('Y-m-d H:i:s') . "] $message\n";
        error_log($logMessage, 3, 'path/to/error.log');

        if ($errorCode > 0) {
            http_response_code($errorCode);
        }
    }

    // Data access functions
    function insertBooking($userId, $scheduleId, $seatNumber, $bookingDate)
    {
        global $getConnection;
        $stmt = $getConnection->prepare("INSERT INTO bookings (user_id, schedule_id, seat_number, booking_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $userId, $scheduleId, $seatNumber, $bookingDate);
        return $stmt->execute();
    }

    function updateSeatStatus($seatNumber, $status)
    {
        global $getConnection;
        $stmt = $getConnection->prepare("UPDATE seats SET status = ? WHERE Id = ?");
        $stmt->bind_param("si", $status, $seatNumber);
        return $stmt->execute();
    }
    ?>

    <?php include '../Add/footer.php'; ?>
    <script>
        let btn = document.querySelector('#CHECKOUTBTN');
        btn.addEventListener('click', ()=>{
            let cont = document.querySelector('#check');
            cont.style.display = 'block';
        })
    </script>
</body>

</html>