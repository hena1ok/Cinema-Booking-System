<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../../Styles/stylesSignup.css">



    <title>Delete</title>
</head>

<body>
    <?php
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        if ($page == "btnDm") {
            include("../Add/Adminheader.php");
        } else if ($page == "delete") {
            include("../Add/crudhead.php");
        }
    }
    ?>
    <div class="container">
        <Fieldset>
            <legend>
                <h2>Delete</h2>
            </legend>
            <form action="deletionHandlerMovie.php" method="post">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title">
                </div>

                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" name="release_date" id="release_date">

                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" name="category" id="category">
                </div>
                <div class="form-group">
                    <label for="runtime">Run Time</label>
                    <input type="time" name="runtime" id="runtime">
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" name="submit" value="Delete">
                </div>




            </form>
        </Fieldset>
    </div>

    <?php
    include_once("Read.php");
    ?>

</body>

</html>