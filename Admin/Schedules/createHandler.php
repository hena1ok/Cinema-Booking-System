
<?php
include '../../Config/Connection.php';
if(isset($_POST['submit'])){
  $id=htmlspecialchars($_POST['id']);
  $movid =htmlspecialchars($_POST['movid']);
  $date =htmlspecialchars($_POST['date']);
  $time =htmlspecialchars($_POST['time']);
  $hall =htmlspecialchars($_POST['hall']);

  $sql = "INSERT into schedules (`ID`,`Movie`,`Date`,`Time`,`Hall`)  values ('$id','$movid','$date','$time','$hall')";
            mysqli_query($getConnection,$sql);
            echo "Success!";
            header("Location: Create.php?page=create");
            
    
    } else {
      echo "No Success!";
        header("Location: Read.php");
        
    }

    ?>



