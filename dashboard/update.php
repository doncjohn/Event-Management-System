<?php
include('../dbcon.php');
session_start();
if (!isset($_SESSION['id'])) {
    header("location: ../index.php");
    die();
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
                <h3 class="card-title">Update Event</h3>
              </div>
              <!-- form start -->
              <form role="form" action="updated.php" method="POST" id="quickForm" enctype="multipart/form-data" novalidate="novalidate">
                <?php
                  $sql    = "SELECT * FROM `event` WHERE `Event_ID` =" . $_GET['id'] . "";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?> 
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="id" value= <?php echo '"' . $_GET['id'] . '"';?>
                    <label>Event Name</label>
                    <input type="text" name="name" <?php echo 'value="' . $row["Event_Name"] . '"'; ?> class="form-control" placeholder="Enter Event Name">
                  </div>
                  <div class="form-group">
                    <label>Event Location</label>
                    <input type="text" name="location" <?php echo 'value="' . $row["Event_Location"] . '"';?> class="form-control" placeholder="Enter Event Location">
                  </div>
                  <div class="form-group">
                    <label>Event Date:</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" name="start" <?php echo 'value="' . $row["Event_Start_Date"] . '"';?> class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                      <input type="date" name="end" <?php echo 'value="' . $row["Event_End_Date"] . '"'; ?> class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                      </div>
                      <br>
                    </div>
                    <div class="form-group">
                      <label>Event Registration Date:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="date" name="regstart" <?php echo 'value="' . $row["Reg_Start_Date"] . '"';?> 
                          class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                          <input type="date" name="regend" <?php echo 'value="' . $row["Reg_End_Date"] . '"';?> 
                          class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                        </div>
                    </div>
                      <div class="form-group">
                        <label>Registration Fee:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                        <input type="text" name="fee" <?php echo 'value="' . $row["Reg_Fee"] . '"'; ?>  placeholder="Enter Registration Fee" class="form-control">
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
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                  <?php
                    }
                    } else {
                      echo "Error Fetching Data";
                    }
                  ?> 
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