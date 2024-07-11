<?php

include("../../Config/connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $getConnection->real_escape_string($_POST['fname']);
    $lname = $getConnection->real_escape_string($_POST['lname']);
    $email = $getConnection->real_escape_string($_POST['email']);

    $password = $getConnection->real_escape_string($_POST['password']);
    $password = password_hash($getConnection->real_escape_string($_POST['password']), PASSWORD_BCRYPT);
    $role = $getConnection->real_escape_string($_POST['role']);
    $profile = $_FILES['image']['name'];
    $targetDir = "../../Assets/ScheduleAssets/Images/";
    $targetFile = $targetDir . basename($profilePicture);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile);


    $sql = "INSERT INTO users (firstName, lastName,email,profile, password) VALUES ('$fname','$lname', '$email','$profile', '$password')";

    if ($getConnection->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: Create.php?page=create");
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
        if ($page == "btnS") {
            include("../Add/Adminheader.php");
        } else if ($page == "create") {
            include("../Add/crudhead.php");
        }
    }
    ?>

    <main class="main-content">
        <section class="form-section">
            <div class="container">
                <h2>Create User</h2>
                <form id="signupForm" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" required>
                        <span class="error" id="fnameError"></span>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname" required>
                        <span class="error" id="lnameError"></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        <span class="error" id="emailError"></span>
                    </div>
                    <div class="form-group">
                        <label for="image">Profile:</label>
                        <input type="file" name="profile" id="image" accept="image/*" required>
                        <span class="error" id="profilerror"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        <span class="error" id="passwordError"></span>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password:</label>
                        <input type="password" id="cpassword" name="cpassword" required disabled>
                        <span class="error" id="cpasswordError"></span>
                    </div>
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select id="role" name="role" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <span class="error" id="cpasswordError"></span>
                    </div>

                    <button type="submit" class="btn">Create User</button>

                </form>
            </div>
        </section>
    </main>

    <?php
    include_once("Read.php");
    $getConnection->close();
    ?>

</body>

</html>