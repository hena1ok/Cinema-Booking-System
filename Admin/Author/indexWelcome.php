
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="3;URL='redirect.php'">
  <title>Millennium Cinema - Home</title>
  <link rel="stylesheet" href="../../Styles/main.css">
  <link rel="stylesheet" href="../../Styles/stylesSignup.css">
  <style>
    main{
            margin-bottom: 450px;
        }
  </style>
</head>

<body>
  <?php include("../../Add/header.php");
  if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
  }
?>
  <main class="main-content">
    <section class="hero">
      <div class="container">

        <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
        <p>Enjoy your time at Millennium Cinema.</p>
      </div>
    </section>
  </main>



  <?php include("../Add/footer.php"); ?>
  <script src="../../JS/scriptsSignup.js"></script>

</body>

</html>