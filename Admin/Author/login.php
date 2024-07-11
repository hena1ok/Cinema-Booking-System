<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Millennium Cinema - Login</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../../Styles/main.css">
    <link rel="stylesheet" href="../../Styles/stylec.css?v=?<?php echo time(); ?>">
    <link rel="stylesheet" href="../../Styles/stylesSignup.css">
    <style>
        .form-section {
            margin-bottom: 200px;
        }
    </style>

</head>

<body>

    <?php include("../../Add/header.php");

    include '../../Config/Connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $getConnection->real_escape_string($_POST['email']);
        $password = $getConnection->real_escape_string($_POST['password']);


        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $getConnection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['firstName'] . ' ' . $row['lastName'];
                $_SESSION['profile'] = $row['profile'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['user'] = $row; // Store user data in session

                header("Location: indexWelcome.php");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }
    }

    $getConnection->close();
    ?>

    <main class="main-content">
        <section class="form-section">
            <div class="container">
                <h2>Login</h2>
                <form id="loginForm" action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        <span class="error" id="emailError"></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required disabled>
                        <span class="error" id="passwordError"></span>
                    </div>
                    <button type="submit" class="btn" disabled>Login</button>
                    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                </form>
            </div>
        </section>

    </main>


    <?php include("../Add/footer.php"); ?>

    <script src="../../JS/scriptsSignup.js"></script>

</body>

</html>