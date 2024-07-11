<?php

include("../../Config/connection.php");
if (isset($_GET["page"])) {

    session_start();
    $page = $_GET["page"];
    if ($page == "delete") {

        $id1 = $_SESSION['user_id'];
        $sql2 = "Delete from users where `id` = '$id1'";
        $sql3 = "Delete from bookings where `user_id` = '$id1'";
        if ($getConnection->query($sql3) === TRUE) {
            if ($getConnection->query($sql2) === TRUE) {

                echo "New record Deleted successfully";
                header("Location: ../Author/logout.php?");
                exit();
            }
        } else {
            echo "Error: " . $sql . "<br>" . $getConnection->error;
        }
        exit();
    }
    session_destroy();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $getConnection->real_escape_string($_POST['id']);


    $sql = "Delete from users where `id` = '$id'";



    if ($getConnection->query($sql) === TRUE) {
        echo "New record Deleted successfully";
        header("Location: Delete.php?page=delete");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $getConnection->error;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Millennium Cinema - Sign Up</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../../Styles/stylesSignup.css">

</head>

<body>
    <?php
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        if ($page == "btnDu") {
            include("../Add/Adminheader.php");
        } else if ($page == "delete") {
            include("../Add/crudhead.php");
        }
        $id1 =  $_SESSION['user_id'];
    }
    ?>


    <main class="main-content">
        <section class="form-section">
            <div class="container">
                <h2>Delete User</h2>
                <form id="signupForm" action="#" method="POST">
                    <div class="form-group">
                        <label for="id">User Id:</label>
                        <input type="text" id="id" name="id" required>
                        <span class="error" id="iderror"></span>
                    </div>
                    <button type="submit" class="btn">Delete User</button>

                </form>
            </div>
        </section>
    </main>

    <?php
    include("Read.php");
    $getConnection->close();
    ?>

</body>

</html>