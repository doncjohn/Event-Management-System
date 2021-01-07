<?php
include('../dbcon.php');
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
    die();
}
if (isset($_POST['submit'])) {
    print_r($_POST);
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
            $sql = "INSERT INTO `event` (`Event_Name`, `Event_Location`, `Thumbnail_Image`, `Event_Start_Date`, `Event_End_Date`, `Reg_Start_Date`, `Reg_End_Date`, `Reg_Fee`, `Status`, `Time_Stamp`) VALUES ('" . $_POST['name'] . "', '" . $_POST['location'] . "', '" . $Uplink_file . "', '" . $_POST['start'] . "', '" . $_POST['end'] . "', '" . $_POST['regstart'] . "', '" . $_POST['regend'] . "', '" . $_POST['fee'] . "', '1', current_timestamp());";
            if ($conn->query($sql) === TRUE) {
                echo "<script>
            alert('Event Added Successfully');
            window.location.href='index.php';
            </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
include('utils/head.php');
?>
   <body class="hold-transition sidebar-mini">
      <div class="wrapper">
      <?php
         include('utils/topnav.php');
         include('utils/sidenav.php');
      ?> 
         <div class="content-wrapper">
         <?php include('utils/contentheader.php'); ?> 
            <div class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card card-primary">
                           <div class="card-header">
                              <h3 class="card-title">Add Event</h3>
                           </div>
                           <!-- form start -->
                           <form role="form" method="POST" id="quickForm" enctype="multipart/form-data" novalidate="novalidate">
                              <div class="card-body">
                                 <div class="form-group">
                                    <label>Event Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Event Name">
                                 </div>
                                 <div class="form-group">
                                    <label>Event Location</label>
                                    <input type="text" name="location" class="form-control" placeholder="Enter Event Location">
                                 </div>
                                 <div class="form-group">
                                    <label>Event Date:</label>
                                    <div class="input-group">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                       </div>
                                       <input type="date" name="start" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                       <input type="date" name="end" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                    </div>
                                    <br>
                                    <!-- /.input group -->
                                 </div>
                                 <div class="form-group">
                                    <label>Event Registration Date:</label>
                                    <div class="input-group">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                       </div>
                                       <input type="date" name="regstart"class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                       <input type="date" name="regend" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                    </div>
                                    <!-- /.input group -->
                                 </div>
                                 <div class="form-group">
                                    <label>Registration Fee:</label>
                                    <div class="input-group">
                                       <div class="input-group-prepend">
                                          <span class="input-group-text">$</span>
                                       </div>
                                       <input type="text" name="fee" placeholder="Enter Registration Fee" class="form-control">
                                       <div class="input-group-append">
                                          <span class="input-group-text">.00</span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="exampleInputFile">Event Image</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                         <input type="file" name="fileToUpload" id="fileToUpload">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                       <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                       <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                    </div>
                                 </div>
                              </div>
                              <!-- /.card-body -->
                              <div class="card-footer">
                                 <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                              </div>
                           </form>
                        </div>
                        <!-- /.card -->
                     </div>
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
<?php include('utils/footer.php'); ?>          