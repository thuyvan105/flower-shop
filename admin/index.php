<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

if (isset($_SESSION['role']) && ($_SESSION['role']==1)) {
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
<?php
  $sql_user = "SELECT COUNT(id_user) AS total_user FROM user WHERE role = 0";
  $query_user = mysqli_query($conn, $sql_user);
  $row_user = mysqli_fetch_assoc($query_user);
  $total_user = $row_user['total_user'];
?>

  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered User</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4>Total User:  <?php echo $total_user; ?>*</h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php
  $sql_product = "SELECT COUNT(id_sp) AS total_product FROM sanpham";
  $query_product = mysqli_query($conn, $sql_product);
  $row_user = mysqli_fetch_assoc($query_product);
  $total_product = $row_user['total_product'];
?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Product</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_product; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
$sql_totalAmount = "SELECT SUM(od.price * od.quantity) AS total_amount
FROM order_detail od
INNER JOIN `order` o ON od.order_id = o.order_id";

$query_totalAmount = mysqli_query($conn, $sql_totalAmount);

if ($query_totalAmount) {
  $row_totalAmount = mysqli_fetch_assoc($query_totalAmount);
  $total_amount = $row_totalAmount['total_amount'];

?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Revenue</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Total amount: $<?php echo $total_amount; }?></div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->








  <?php
include('includes/scripts.php');
include('includes/footer.php');
}
?>