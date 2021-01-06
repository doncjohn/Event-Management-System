<?php
session_start();
$votp = $_POST['otp'];
if ($_SESSION['otp'] == $votp) {
    include('dbcon.php');
    $sql = "UPDATE `user` SET `Password` = '" . $_POST['password1'] . "' WHERE `user`.`User_ID` =" . $_SESSION['id'];
    if ($conn->query($sql) === true) {
        echo "<script>
            alert('Password Updated');
            window.location.href='login.php';
            </script>";
        session_destroy();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        session_destroy();
    }
} else {
    echo "<script>
            alert('Verfication Failed');
            window.location.href='login.php';
            </script>";
    session_destroy();
}
?>