<?php
include('includes/checklogin.php');
check_login();
if(isset($_REQUEST['del']))
  {
$delid=intval($_GET['del']);
$sql = "delete from tblvehicles  WHERE  id=:delid";
$query = $dbh->prepare($sql);
$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
$query -> execute();
 echo "<script>alert('car record deleted.');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>
  <div class="container-scroller">
   
    <?php @include("includes/header.php");?>
   
    <div class="container-fluid page-body-wrapper">
    
      <?php @include("includes/sidebar.php");?>
  
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">Manage Broken Cars</h5>
                </div>
                
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover table-bordered" id="dataTableHover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Vehicle Title</th>
                        <th>Fault Cause </th>
                        <th>Broken Time </th>
                        <th>Action</th>
                        
                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT tblrepair.car_name,tblrepair.fault_cause,tblrepair.broken_time,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                      if($query->rowCount() > 0)
                      {
                        foreach($results as $row)
                        { 
                          ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt);?></td>
                            <td>
                              <?php echo htmlentities($row->car_name);?></a>
                            </td>
                            <td class="text-center"><?php echo htmlentities($row->fault_cause);?></td>
                            <td class="text-center"><?php echo htmlentities($row->broken_time);?></td>
                            <td><button class="button">Send Repair</button>
                            <button class="button">Get From Repair</button></td>
                            
                              <a href="edit_car.php?id=<?php echo $row->id;?>" title="click to edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>
                              <a href="manage_car.php?del=<?php echo $row->id;?>" onclick="return confirm('Do you want to delete');"><i class="mdi mdi-delete"></i></i></a>
                            </td>
                          </tr>
                          <?php 
                          $cnt=$cnt+1;
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      
        <?php @include("includes/footer.php");?>
    
      </div>
    
    </div>
 
  </div>

  <?php @include("includes/foot.php");?>
 
 
</body>
</html>