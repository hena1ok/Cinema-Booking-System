<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="../../Styles/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../read.css?v=<?php echo time(); ?>">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
        if ($page == "Admin") {
            include("../Add/Adminheader.php");
        } else if ($page == "read") {
            include("../Add/crudhead.php");
        }
    }
    ?>

    <main>
        <div class="container">
            <fieldset>
                <legend>
                    <h2>Read</h2>
                </legend>
                <div class="search-container">
                    <input type="text" id="search" name="search" placeholder="Search by title..." class="search-input">
                    <button type="button" class="search-button">Search</button>
                </div>
                <div id="results">
                    <table border="1" id="tbl">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Release Date</th>
                                <th>Category</th>
                                <th>Run Time</th>
                                <th>Country</th>
                                <th>Image</th>
                                <th>Trailer</th>
                            </tr>
                        </thead>
                        <tbody id="movieData">
                            <!-- Data will be populated here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
        <script src="../../JS/main.js"></script>
        <script src="../scriptMovie.js"></script>
        <?php include("../Add/footer.php"); ?>
    </main>
</body>

</html>