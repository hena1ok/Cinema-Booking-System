<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Millennium Cinema - Sign Up</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../../Styles/main.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="../../Styles/styleProfile.css?<?php echo time(); ?>">


</head>

<body>
    <?php include("../Add/header.php");
    include '../Config/Connection.php';
    $id = $getConnection->real_escape_string($_SESSION['user_id']);
    $query1 = "select * from users WHERE id='$id' ";
    $result = $getConnection->query($query1);
    if (isset($_POST['delete'])) {
        header("Location: ../../Admin/Users/Delete.php?page=delete");
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fname = $getConnection->real_escape_string($_POST['fname']);
        $lname = $getConnection->real_escape_string($_POST['lname']);
        $profile = $_FILES['upload-image']['name'];
        $targetDir = "../../Assets/HomeAssets/Images/";
        $targetFile = $targetDir . basename($profile);
        move_uploaded_file($_FILES['upload-image']['tmp_name'], $targetFile);
        $email = $getConnection->real_escape_string($_POST['email']);
        $password = password_hash($getConnection->real_escape_string($_POST['password']), PASSWORD_BCRYPT);
        //    $profile= $getConnection->real_escape_string($_POST['profile']);

        $sql = "UPDATE users SET 
                    id='$id', 
                    firstName='$fname', 
                    lastName='$lname', 
                    email='$email',
                    password='$password',
                    profile='$profile'
                    WHERE id='$id'";

        if ($getConnection->query($sql) === TRUE) {
            $_SESSION['user_name'] = $fname . ' ' . $lname;
            $_SESSION['user_email'] = $email;
            $_SESSION['profile'] = $profile;
            echo "Record Updated successfully";
            header("Location: ../../Admin/Author/indexWelcome.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $getConnection->error;
        }
    }
    ?>
    <?php
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        if ($page == "btnEu") {
            include("../Add/Adminheader.php");
        } else if ($page == "update") {
            include("../Add/crudhead.php");
        }
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {


    ?>
            <main class="main-content">
                <aside class="profile-section">
                    <div class="profile-header">
                        <img src="../Assets/HomeAssets/Images/<?php echo $_SESSION['profile'] ?>" alt="Profile Picture" class="profile-image" id="profile-pic">
                        <div class="user-details"><?php echo $_SESSION['user_name']; ?></div>
                    </div>
                </aside>
                <section class="form-section">
                    <form id="signupForm" action="#" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" id="fname" name="fname" required value="<?php echo $row['firstName'] ?>">
                            <span class="error" id="fnameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" id="lname" name="lname" value="<?php echo $row['lastName'] ?>">
                            <span class=" error" id="lnameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>">
                            <span class=" error" id="emailError"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" value="<?php echo $row['password'] ?>">
                            <span class=" error" id="passwordError"></span>
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirm Password:</label>
                            <input type="password" id="cpassword" name="cpassword" value="<?php echo $row['password'] ?>>
                            <span class=" error" id="cpasswordError"></span>
                        </div>
                        <div class="form-group">
                            <label for="upload-image" class="upload-label" id="pic-input">Update Profile</label>
                            <input type="file" name="upload-image" id="upload-image" accept="image/*">
                            <span class="error" id="UploadImageError"></span>
                        </div>

                        <button type="submit" class="btn">Confirm Changes</button>
                        <button type="submit" name="delete" class="btn">Delete Profile</button>
                    </form>
                </section>
            </main>


    <?php
        }
    }

    include("../Add/footer.php"); ?>
</body>

</html>
<script>
    let profilePic = document.getElementById("profile-pic");
    let picInput = document.getElementById("upload-image");
    picInput.onchange = function() {
        profilePic.src = URL.createObjectURL(picInput.files[0]);
    }
</script>
<script src="../../JS/main.js"></script>
<script src="../scriptUsr.js"></script>
<?php
$getConnection->close();
?>