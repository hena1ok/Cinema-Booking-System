<?php
include_once("../../Config/Connection.php");

$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($getConnection, $_GET['search']);
    $query = "SELECT * FROM users WHERE 
                id LIKE '%$search%' OR 
                firstName LIKE '%$search%' OR 
                lastName LIKE '%$search%' OR 
                email LIKE '%$search%' OR 
                role LIKE '%$search%'";
} else {
    $query = "SELECT * FROM users";
}

$result = mysqli_query($getConnection, $query);

$output = '';
if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
            <td data-label='Id'>{$data['id']}</td>
            <td data-label='First Name'>{$data['firstName']}</td>
            <td data-label='Last Name'>{$data['lastName']}</td>
            <td data-label='Email'>{$data['email']}</td>
            <td data-label='Password'>{$data['password']}</td>
            <td data-label='Profile'><img src='../../Assets/ScheduleAssets/Images/{$data['profile']}' alt='Profile' width='100' height='100'></td>
            <td data-label='Role'>{$data['role']}</td>
        </tr>";
    }
} else {
    $output .= "<tr><td colspan='7'>No data available</td></tr>";
}

echo $output;
