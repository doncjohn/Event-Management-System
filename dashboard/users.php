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
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email ID</th>
                    </tr>
                  </thead>
                  <tbody >
                    <?php
                      $sql    = "SELECT * FROM `user`";
                      $result = $conn->query($sql);
                      $no     = 1;
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          echo "<tr>";
                          echo "<td>" . $no . "</td>";
                          echo "<td>" . $row["Name"] . "</td>";
                          echo "<td>" . $row["Email"] . "</td>";
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
  <!-- /.content-wrapper -->
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>

<?php include('utils/footer.php'); ?> 