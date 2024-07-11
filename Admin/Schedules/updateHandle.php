<?php
include "../../Config/Connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
  
        $id = htmlspecialchars($_POST['id']);
        $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
        $hall = htmlspecialchars($_POST['hall']);
       
                $sql = "UPDATE schedule SET 
                    id='$id', 
                    date='$date', 
                    time='$time', 
                    hall='$hall'
                    WHERE id='$id'";

                if (mysqli_query($getConnection, $sql)) {
                    header("Location: Update.php?success=Record updated successfully!");
                    exit();
                } else {
                    $em = "Database error: " . mysqli_error($getConnection);
                    header("Location: Update.php?error=$em");
                    exit();
                }
           
      
    } else {
        $em = "File upload error!";
        header("Location: Update.php?error=$em");
        exit();
    
} 
    

