<?php
include_once './includes/header.php';
include_once './includes/navbar.php';

require_once './config/dbconnect.php';


?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">
      
        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">User Profile  -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              User Profile 
            </button>
    <!-- </h6> -->
  </div>

  <div class="card-body">

    <div class="table-responsive">
    
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      
        <thead>
        
          <tr>
            <th> ID </th>
            <th> Username </th>
            <th>Email </th>
            <th>Password</th>
            <!-- <th>EDIT </th> -->
            <!-- <th>DELETE </th> -->
          </tr>
        </thead>
        <tbody>
        <?php
    //phân trang sp
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
      $page = 1;
    }
    $rowPerPage =8;
    $perRow = $page*$rowPerPage-$rowPerPage;  
    // tham số cần tính toán( ts đầu tiên của limit (vd: t1: 0-4=>perpage=0)), số sp hiển thị 1 trang 
    $sql = "SELECT * from user limit $perRow, $rowPerPage";
    $query = mysqli_query($conn, $sql);
    $result=$conn-> query($sql);

    // tính tổng số có bn trang
    $totalRow = mysqli_num_rows(mysqli_query($conn, "SELECT * from user"));
    $totalPage = ceil($totalRow/$rowPerPage);

    $listPage = "";
    for($i=1; $i<=$totalPage; $i++){
        if($page==$i){
          $listPage.='<li class="page-item active"><a href="register.php?page='.$i.'" class="page-link" >'.$i.' <span class="sr-only">(current)</span></a></li>';
        }else{
          $listPage .='<li class="page-item"><a href="register.php?page='.$i.'" class="page-link">'.$i.'</a></li>';
        }
    }


    $count=1;
    if ($result-> num_rows > 0){
      while($row = mysqli_fetch_array($query)){
    ?>

          <tr>
            <td> <?= $row['id_user'] ?> </td>
            <td> <?= $row['name_user'] ?></td>
            <td> <?= $row['email'] ?></td>
            <td> *** </td>
            <!-- <td>
                <form action="" method="post">
                    <input type="hidden" name="edit_id" value="">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td> -->
            <!-- <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td> -->
          </tr>
          <?php
    $count=$count+1;
      }
    }
    ?>
        </tbody>
        
      </table>
     
    </div>
  </div>
</div>  
<ul class="pagination" style="float:right; margin-right: 150px;">
    <!-- <li class="page-item"><a href="" class="page-link">1</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
    <?php
    echo $listPage;
    ?>
</ul>
</div>



</div>
</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
// include('includes/footer.php');
?>