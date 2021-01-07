<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <?php
                $sql = "SELECT COUNT(*) FROM event";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "<h3>".$row['COUNT(*)']."</h3>";
                ?>
                <p>Active Events</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                $sql = "SELECT COUNT(*) FROM user";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "<h3>".$row['COUNT(*)']."</h3>";
                ?>
                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                $sql = "SELECT COUNT(*) FROM register";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo "<h3>".$row['COUNT(*)']."</h3>";
                ?>
                <p>Total Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>1000+</h3>
                <p>Site Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
</div>
