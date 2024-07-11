<?php
if (isset($_SESSION)) {
    session_destroy();
}
include("../../Config/connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $getConnection->real_escape_string($_POST['fname']);
    $lname = $getConnection->real_escape_string($_POST['lname']);
    $email = $getConnection->real_escape_string($_POST['email']);
    $password = $getConnection->real_escape_string($_POST['password']);
    $password = password_hash($getConnection->real_escape_string($_POST['password']), PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (firstName, lastName,email, password) VALUES ('$fname','$lname', '$email', '$password')";

    if ($getConnection->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $getConnection->error;
    }
}

$getConnection->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Millennium Cinema - Sign Up</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../../Styles/main.css">
    <link rel="stylesheet" href="../../Styles/stylec.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../Styles/stylesSignup.css">


</head>

<body>
    <?php include("../../Add/header.php"); ?>

    <main class="main-content">
        <section class="form-section">
            <div class="container">
                <h2>Sign Up</h2>
                <form id="signupForm" action="signup.php" method="POST">
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
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        <span class="error" id="passwordError"></span>
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password:</label>
                        <input type="password" id="cpassword" name="cpassword" required>
                        <span class="error" id="cpasswordError"></span>
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox" id="terms" required> I agree to the terms and conditions!</label>
                        <span class="error" id="termsError"></span>
                    </div>
                    <a href="https://accounts.google.com/o/oauth2/auth?
                        client_id=YOUR_GOOGLE_CLIENT_ID&
                        redirect_uri=https://yourdomain.com/google_callback.php&
                        response_type=code&
                        scope=email%20profile" class="btn-google">Continue with Google</a>
                    <!-- Add "Continue with Microsoft" button -->
                    <a href="https://login.microsoftonline.com/YOUR_TENANT_ID/oauth2/v2.0/authorize?
                        client_id=YOUR_MICROSOFT_CLIENT_ID&
                        response_type=code&
                        redirect_uri=https://yourdomain.com/microsoft_callback.php&
                        scope=openid%20email%20profile" class="btn-microsoft">Continue with Microsoft</a>

                    <button type="submit" class="btn" disabled>Sign Up</button>
                    <p>Already have an account? <a href="login.php">Sign In</a></p>
                </form>
            </div>
        </section>
    </main>
    <?php include("../Add/footer.php"); ?>




    <script src="../../JS/scriptsSignup.js"></script>
</body>

</html>