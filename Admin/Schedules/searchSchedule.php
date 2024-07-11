<?php
include_once("../../Config/Connection.php");

$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($getConnection, $_GET['search']);
    $query = "SELECT * FROM schedules WHERE 
                Id LIKE '%$search%' OR 
                Movie LIKE '%$search%' OR 
                Date LIKE '%$search%' OR 
                Time LIKE '%$search%' OR 
                Hall LIKE '%$search%'";
} else {
    $query = "SELECT * FROM schedules";
}

$result = mysqli_query($getConnection, $query);

$output = '';
if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
            <td data-label='Id'>{$data['Id']}</td>
            <td data-label='Movie'>{$data['Movie']}</td>
            <td data-label='Date'>{$data['Date']}</td>
            <td data-label='Time'>{$data['Time']}</td>
            <td data-label='Hall'>{$data['Hall']}</td>
        </tr>";
    }
} else {
    $output .= "<tr><td colspan='5'>No data available</td></tr>";
}

echo $output;
