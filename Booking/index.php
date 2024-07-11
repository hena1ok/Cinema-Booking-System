<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Booking</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Book Your Seat</h1>
        <div id="hall-selection">
            <label for="hall">Select Hall:</label>
            <select id="hall">
                <option value="1">Hall 1</option>
                <option value="2">Hall 2</option>
            </select>
            <button id="load-seats">Load Seats</button>
        </div>
        <div id="seat-map"></div>
        <div id="selected-seats"></div>
    </div>

    <script src="script.js"></script>
</body>

</html>