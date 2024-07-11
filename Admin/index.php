<?php include '../Config/Connection.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cinema Booking System</title>
    <link rel="stylesheet" href="styleAdmin.css">
    <link rel="stylesheet" href="../Styles/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

</head>

<body>
    <?php include '../Add/Adminheader.php' ?>

    <main>
        <section id="dashboard" class="section dashboard">
            <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
            <p>Manage your cinema bookings efficiently and effectively</p>
            <div class="stats-container">
                <div class="stat-box">
                    <h3>Total Movies</h3>
                    <p><?php
                        $sql = "SELECT COUNT(*) AS total_count FROM movies";
                        $result = $getConnection->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo $row["total_count"];
                            }
                        } else {
                            echo "0 results";
                        }
                        ?></p>
                </div>
                <div class="stat-box">
                    <h3>Total Shows</h3>
                    <p><?php
                        $sql = "SELECT COUNT(*) AS total_count FROM schedules";
                        $result = $getConnection->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo $row["total_count"];
                            }
                        } else {
                            echo "0 results";
                        }
                        ?></p>
                </div>
                <div class="stat-box">
                    <h3>Tickets Sold</h3>
                    <p><?php
                        $sql = "SELECT COUNT(*) AS total_count FROM bookings";
                        $result = $getConnection->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo $row["total_count"];
                            }
                        } else {
                            echo "0 results";
                        }
                        ?></p>
                </div>
                <div class="stat-box">
                    <h3>Registered Users</h3>
                    <p><?php
                        $sql = "SELECT COUNT(*) AS total_count FROM users";
                        $result = $getConnection->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo $row["total_count"];
                            }
                        } else {
                            echo "0 results";
                        }
                        ?></p>
                </div>
            </div>
        </section>
        <div class="managment-container">
            <section id="movies" class="sections">
                <h2>Manage Movies</h2>
                <div class="manage-container">
                    <button class="btn btnM" name="btnM">Add New Movie</button>
                    <button class="btn btnEm" name="btnEm">Edit Movie</button>
                    <button class="btn btnDm" name="btnDm">Delete Movie</button>
                </div>
            </section>

            <section id="shows" class="sections">
                <h2>Manage Schedule</h2>
                <div class="manage-container">
                    <button class="btn btnS">Add New Schedule</button>
                    <button class="btn btnEs">Edit Schedule</button>
                    <button class="btn btnDs">Delete Schedule</button>
                </div>
            </section>

            <section id="tickets" class="sections">
                <h2>Manage Tickets</h2>
                <div class="manage-container">
                    <button class="btn btnT">View Booked Tickets</button>
                    <button class="btn btnCt">Cancel Booked Tickets</button>
                </div>
            </section>

            <section id="users" class="sections">
                <h2>Manage Users</h2>
                <div class="manage-container">
                    <button class="btn btnU">View Users</button>
                    <button class="btn btnEu">Edit User</button>
                    <button class="btn btnDu">Delete User</button>
                </div>
            </section>

            <section id="reports" class="sections">
                <h2>Reports & Analytics</h2>
                <div class="manage-container">
                    <button class="btn">Sales Reports</button>
                    <button class="btn">Occupancy Reports</button>
                    <button class="btn">User Reports</button>
                </div>
            </section>

            <section id="settings" class="sections">
                <h2>System Settings</h2>
                <div class="manage-container">
                    <button class="btn">Payment Settings</button>
                    <button class="btn">Notification Settings</button>
                    <button class="btn">Backup & Restore</button>
                </div>
            </section>
        </div>

    </main>

    <?php include '../Add/footer.php' ?>

    <script src="./script.js"></script>
</body>

</html>