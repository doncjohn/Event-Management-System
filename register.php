<?php
   include('dbcon.php');
   session_start();
   if(!isset($_SESSION['id']) || !isset($_GET['id']) ){
      header("location: index.php");
      die();
   }
   $sql = "INSERT INTO `register` (`User_ID`, `Event_ID`) VALUES ('".$_SESSION['id']."', '".$_GET['id']."');";
        if ($conn->query($sql) === TRUE) {
          echo "<script> alert('Event Registeration Successful');</script>";
          mail($_SESSION['email'], 'Dzone Events', 'Event Registeration Successful');
          header("location: index.php");
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
?>