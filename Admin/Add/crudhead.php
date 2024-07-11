<?php
session_start();
$isUserLoggedIn = isset($_SESSION['user']);
$user = $isUserLoggedIn ? $_SESSION['user'] : null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../styleAdmin.css">
  <link rel="stylesheet" href="../../Styles/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <title>Checkout</title>
</head>

<body>
  <header class="header">

    <div class="header__content">
      <div class="hamburger">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <a href="/Admin/index.php" class="logo">Millennium Cinema</a>
      <nav class="navbar">
        <ul class="nav__list">
          <li class="nav__item"><a href="Create.php?page=create" class="nav__link">Create</a></li>
          <li class="nav__item"><a href="Update.php?page=update" class="nav__link" name="updare">Update</a></li>
          <li class="nav__item"><a href="Delete.php?page=delete" class="nav__link" name="delete">Delete</a></li>
          <li class="nav__item"><a href="Read.php?page=read" class="nav__link" name="read">Read</a></li>
          <!-- Update the profile picture and login button HTML -->
          <?php if ($isUserLoggedIn) : ?>
            <li class="nav__item">
              <div class="profile">
                <img src="../../Assets/HomeAssets/Images/<?php echo $_SESSION['profile'] ?>" alt="Profile Picture" class="profile__image">
                <div class="profile__dropdown">
                  <ul class="dropdown__list">
                    <li class="profile-li"><img src="/Assets/user.svg" alt="profile icon"><a href="../User/profile.php">My Profile</a></li>
                    <li class="settings-li"><img src="/Assets/settings.svg" alt="settings icon"><a href="settings.php">Account Settings</a></li>
                    <li class="logout-li"><img src="/Assets/logout.svg" alt="logout icon"><a href="../Author/logout.php">Logout</a></li>
                  </ul>
                </div>
              </div>
            </li>
          <?php else : ?>
            <li class="nav__item">
              <a href="/Admin/Author/login.php" class="nav__link profile">Log In</a>
            </li>
          <?php endif; ?>

        </ul>
      </nav>

    </div>

  </header>
</body>

</html>