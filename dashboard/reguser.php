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
            <div class="card-header">
              <h3 class="card-title">Registered Users</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Reg ID<th>
                    <th>Name<th>
                    <th>Email<th>
                    <th>Time Stamp<th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql    = "SELECT register.Reg_ID,user.Name,user.Email,register.TimeStamp FROM register INNER JOIN user ON register.User_ID=user.User_ID WHERE register.Event_ID=" . $_GET['id'];
                    $result = $conn->query($sql);
                    $no     = 1;
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . $row["Reg_ID"] . "</td>";
                        echo "<td>" . $row["Name"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
                        echo "<td>" . $row["TimeStamp"] . "</td>";
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
<?php include('utils/footer.php'); ?> 