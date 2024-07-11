<?php
include_once("../../Config/Connection.php");

$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($getConnection, $_GET['search']);
    $query = "SELECT * FROM movies WHERE 
                Id LIKE '%$search%' OR 
                Title LIKE '%$search%' OR 
                Release_date LIKE '%$search%' OR 
                Category LIKE '%$search%' OR 
                Runtime LIKE '%$search%' OR 
                Country LIKE '%$search%'";;
} else {
    $query = "SELECT * FROM movies";
}

$result = mysqli_query($getConnection, $query);

$output = '';
if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        $output .= "<tr id='tr'>
            <td data-label='Id'>{$data['Id']}</td>
            <td data-label='Title'>{$data['Title']}</td>
            <td data-label='Release Date'>{$data['Release_date']}</td>
            <td data-label='Category'>{$data['Category']}</td>
            <td data-label='Run Time'>{$data['Runtime']}</td>
            <td data-label='Country'>{$data['Country']}</td>
            <td data-label='Image'><img src='../../Assets/ScheduleAssets/Images/{$data['Image']}' alt='Image' width='100' height='100'></td>
            <td data-label='Trailer'><video src='../../Assets/ScheduleAssets/trailers/{$data['Trailer']}' controls width='150' height='100'></video></td>
        </tr>";
    }
} else {
    $output .= "<tr><td colspan='8'>No data available</td></tr>";
}

echo $output;
