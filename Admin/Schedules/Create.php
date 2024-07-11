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

    <div class="container">
        <Fieldset>
            <legend>
                <h2>Create Schedule</h2>
            </legend>
            <form action="createHandler.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="id">Id</label>
                    <input type="number" name="id" id="id">
                </div>
                <div class="form-group">
                    <label for="movid">MovieId</label>
                    <input type="number" name="movid" id="movid">
                </div>
                <div class="form-group">

                    <label for="date">Date</label>
                    <input type="date" name="date" id="date">
                </div>
                <div class="form-group">
                    <label for="runtime">Time</label>
                    <input type="time" name="time" id="runtime">
                </div>
                <div class="form-group">
                    <label for="hall">Hall</label>
                    <input type="text" name="hall" id="hall">
                </div>
                <div class="form-group">

                    <input type="submit" name="submit" value="Upload">
                </div>
            </form>
        </Fieldset>

    </div>

    <?php
    include_once("Read.php");
    ?>

</body>

</html>