<?php
include('../dbcon.php');
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
    die();
} else {
    $sql = "DELETE FROM `event` WHERE `Event_ID` =" . $_GET['id'] . "";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Event Deleted Successfully');
            window.location.href='index.php';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>