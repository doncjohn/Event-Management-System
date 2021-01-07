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
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      <?php include('utils/rowstat.php'); ?>
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
              <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                     <th>#</th>
                     <th>Event Name</th>
                     <th>Event Location</th>
                     <th>Event Start</th>
                     <th>Event End</th>
                     <th>Reg Start</th>
                     <th>Reg End</th>
                     <th>Reg Fee</th>
                     <th>Reg Users</th>
                     <th>Update</th>
                     <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
$sql    = "SELECT * FROM `event`";
$result = $conn->query($sql);
$no     = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no . "</td>";
        echo "<td>" . $row["Event_Name"] . "</td>";
        echo "<td>" . $row["Event_Location"] . "</td>";
        echo "<td>" . $row["Event_Start_Date"] . "</td>";
        echo "<td>" . $row["Event_End_Date"] . "</td>";
        echo "<td>" . $row["Reg_Start_Date"] . "</td>";
        echo "<td>" . $row["Reg_End_Date"] . "</td>";
        echo "<td>" . $row["Reg_Fee"] . "</td>";
        echo '<td> <a href="reguser.php?id=' . $row["Event_ID"] . '"> <i class="fas fa-users"></i> </a> </td>';
        echo '<td> <a href="update.php?id=' . $row["Event_ID"] . '"> <i class="fas fa-edit"></i> </a> </td>';
        echo '<td> <a href="delete.php?id=' . $row["Event_ID"] . '"> <i class="fa fa-trash"></i> </a> </td>';
        $no++;
        echo "</tr>";
    }
} else {
    echo "0 results";
}
?>    
                  </tbody>
                </table>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<!-- /.content-wrapper -->
<?php include('utils/footer.php'); ?> 
