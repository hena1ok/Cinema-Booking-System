<?php
session_start();
include_once "../Config/Connection.php";

// Check if the user is logged in
$isUserLoggedIn = isset($_SESSION['user']);
$user = $isUserLoggedIn ? $_SESSION['user'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/main.css">
    <title>Millennium Cinema</title>
</head>

<body>
    <header class="header">
        <div class="container">
            <div class="header__content">
                <a href="index.php" class="logo">Millennium Cinema</a>
                <nav class="navbar">
                    <ul class="nav__list">
                        <li class="nav__item"><a href="../User/schedule.php" class="nav__link">Schedule</a></li>
                        <li class="nav__item"><a href=".../User/index.php" class="nav__link">Home</a></li>
                        <li class="nav__item"><a href="#" class="nav__link">Location</a></li>
                        <li class="nav__item"><a href="#" class="nav__link">Contact</a></li>
                        <!-- Update the profile picture and login button HTML -->
                        <?php if ($isUserLoggedIn) : ?>
                            <li class="nav__item">
                                <div class="profile">
                                    <img src="../Assets/HomeAssets/Images/<?php echo $_SESSION['profile'] ?>" alt="Profile Picture" class="profile__image">
                                    <div class="profile__dropdown">
                                        <ul class="dropdown__list">
                                            <li><img src="/Assets/user.svg" alt="profile icon"><a href="../User/profile.php" name="update">My Profile</a></li>
                                            <li><img src="/Assets/settings.svg" alt="settings icon"><a href="settings.php">Account Settings</a></li>
                                            <li><img src="/Assets/logout.svg" alt="logout icon"><a href="../Admin/Author/logout.php">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        <?php else : ?>
                            <li class="nav__item">
                                <a href="../Admin/Author/login.php" class="nav__link profile">Log In</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </nav>
                <div class="hamburger">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
        </div>
    </header>

    <script src="../../JS/main.js">

    </script>
</body>

</html>