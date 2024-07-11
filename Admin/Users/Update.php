<?php

include("../../Config/connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $getConnection->real_escape_string($_POST['id']);
    $fname = $getConnection->real_escape_string($_POST['fname']);
    $lname = $getConnection->real_escape_string($_POST['lname']);
    $profile = $_FILES['profile']['name'];
    $targetDir = "../../Assets/ScheduleAssets/Images/";
    $targetFile = $targetDir . basename($profile);
    move_uploaded_file($_FILES['profile']['tmp_name'], $targetFile);
    $email = $getConnection->real_escape_string($_POST['email']);
    $password = password_hash($getConnection->real_escape_string($_POST['password']), PASSWORD_BCRYPT);
    $role = $getConnection->real_escape_string($_POST['role']);
    //    $profile= $getConnection->real_escape_string($_POST['profile']);

    $sql = "UPDATE users SET 
                    id='$id', 
                    firstName='$fname', 
                    lastName='$lname', 
                    email='$email',
                    password='$password',
                    profile='$profile',
                    role='$role'
                    WHERE id='$id'";

    if ($getConnection->query($sql) === TRUE) {
        echo "Record Updated successfully";
        header("Location: Update.php?page=update");
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
        if ($page == "btnEu") {
            include("../Add/Adminheader.php");
        } else if ($page == "update") {
            include("../Add/crudhead.php");
        }
    }
    ?>

    <main class="main-content">
        <section class="form-section">
            <div class="container">
                <h2>Update User</h2>
                <form id="signupForm" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id">ID:</label>
                        <input type="text" id="id" name="id" required>
                        <span class="error" id="iderror"></span>
                    </div>
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

                    <button type="submit" class="btn">Update User</button>

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