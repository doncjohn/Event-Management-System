<?php
include('../dbcon.php');
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
    die();
}
if (isset($_POST['submit'])) {
    if ($_FILES["file"]["error"] != 0) {
        echo "<script> alert('new file');</script>";
        $target_dir    = "upload/";
        $fileInfo      = pathinfo($_FILES["fileToUpload"]["name"]);
        $target_file   = $target_dir . uniqid() . '.' . $fileInfo['extension'];
        $uplink_file   = uniqid() . '.' . $fileInfo['extension'];
        $uploadOk      = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check         = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        echo $filenewname = uniqid('', true) . $imageFileType;
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        
        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "File Uploaded";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    $sql = "UPDATE `event` SET `Event_Name` =  '" . $_POST['name'] . "', `Event_Location` =  '" . $_POST['location'] . "', `Event_Start_Date` =  '" . $_POST['start'] . "', `Event_End_Date` =  '" . $_POST['end'] . "', `Reg_Start_Date` =  '" . $_POST['regstart'] . "', `Reg_End_Date` =  '" . $_POST['regend'] . "', `Reg_Fee` =  '" . $_POST['fee'] . "' WHERE `event`.`Event_ID` = " . $_POST['id'] . ";";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('Event Updated Successfully');
            window.location.href='index.php';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
