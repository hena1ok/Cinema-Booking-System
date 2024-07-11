<?php

include '../../Config/Connection.php';
$qury = "SELECT * FROM schedules";
$result = mysqli_query($getConnection, $qury);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../read.css?v=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>
    <?php
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        if ($page == "Admin") {
            include("../Add/Adminheader.php");
        } else if ($page == "read") {
            include("../Add/crudhead.php");
        }
    }
    ?>
    <div class="container">
        <fieldset>
            <legend>
                <h2>Read</h2>
            </legend>
            <div class="search-container">
                <input type="text" id="search" name="search" placeholder="Search by any parameter..." class="search-input">
                <button type="button" class="search-button">Search</button>
            </div>
            <div id="results">
                <table border="1" id="tbl">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>MovieID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Hall</th>
                        </tr>
                    </thead>

                    <tbody id="scheduleData">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td data-label='Id'>{$data['Id']}</td>
                                    <td data-label='Movie'>{$data['Movie']}</td>
                                    <td data-label='Date'>{$data['Date']}</td>
                                    <td data-label='Time'>{$data['Time']}</td>
                                    <td data-label='Hall'>{$data['Hall']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No data available</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>

    <?php include("../Add/footer.php"); ?>

    <script>
        $(document).ready(function() {
            function searchSchedules() {
                var search = $('#search').val();
                $.ajax({
                    url: 'searchSchedule.php',
                    method: 'GET',
                    data: {
                        search: search
                    },
                    success: function(data) {
                        $('#scheduleData').html(data);
                    }
                });
            }

            $('#search').on('keyup', function() {
                searchSchedules();
            });

            $('.search-button').on('click', function() {
                searchSchedules();
            });

            // Initial load
            searchSchedules();
        });
    </script>
    <script src="../../JS/main.js"></script>
    <script src="../scriptSchdule.js"></script>
</body>

</html>