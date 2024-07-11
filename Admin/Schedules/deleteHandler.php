 <?php

    include("../../Config/Connection.php");



    if (isset($_POST['submit'])) {

        $id = htmlspecialchars($_POST['id']);
        $sql = "delete from schedules where `id`='$id' ";
        mysqli_query($getConnection, $sql);
        header("Location: Delete.php?page=delete");
        echo " Deletion Success!";
    } else {
        $em = "you Can't Delete this file";
        header("location: Delete.php?error=$em");
    }

    ?>