<?php
include_once './includes/header.php';
include_once './includes/navbar.php';

require_once './config/dbconnect.php';
?>

<body>
    
<div style="overflow-x:auto; ">
<table class="table table-hover" style="width:80%; margin-left: 10%; margin-top:0.5%;   text-align: center;">
  <thead>
    <tr style = "background-color: #a05099; color:white; margin-left:500px;">
    <th scope="col" >STT</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Classification</th>
      <th scope="col">Description image </th>
      <th scope="col">Product details </th>

<th scope="col">Edit</th>
      <th scope="col">Delete</th>
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
    $rowPerPage =5;
    $perRow = $page*$rowPerPage-$rowPerPage;  
    // tham số cần tính toán( ts đầu tiên của limit (vd: t1: 0-4=>perpage=0)), số sp hiển thị 1 trang 
    $sql = "SELECT * from sanpham inner join danhmuc on sanpham.id_dm=danhmuc.id_dm limit $perRow, $rowPerPage";
    $query = mysqli_query($conn, $sql);
    $result=$conn-> query($sql);

    // tính tổng số có bn trang
    $totalRow = mysqli_num_rows(mysqli_query($conn, "SELECT * from sanpham  ORDER BY id_sp DESC"));
    $totalPage = ceil($totalRow/$rowPerPage);

    $listPage = "";
    for($i=1; $i<=$totalPage; $i++){
        if($page==$i){
          $listPage.='<li class="page-item active"><a href="addSanPham.php?page='.$i.'" class="page-link" >'.$i.' <span class="sr-only">(current)</span></a></li>';
        }else{
          $listPage .='<li class="page-item"><a href="addSanPham.php?page='.$i.'" class="page-link">'.$i.'</a></li>';
        }
    }


    $count=1;
    if ($result-> num_rows > 0){
      while($row = mysqli_fetch_array($query)){
    ?>
    <tr>
      <th scope="row"><?= $count ?> </th>
      <th style="font-size:18px; text-transform: capitalize;"><?= $row['ten_sp'] ?> </th>
      <!-- <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" Chỉnh sửa</button> -->

      <td style="font-size:18px; text-transform: capitalize;">$<?= $row['gia_sp'] ?> </td>
      <td style="font-size:18px; text-transform: capitalize;"> <?= $row['name_dm'] ?> </td>
      <th> <img src="img/<?= $row['anh_mota'] ?>" alt="" style ="width:80px; height:80px;">  </th>
      <td style="font-size:18px;"><?= $row['chitiet_sp'] ?> </td>


      <td> 
        <!-- <button type="button" class="btn btn-warning" style="margin-left:15%" data-toggle="modal" data-target="#editModal" onclick="editDanhmuc(')">Chỉnh sửa</button> -->
        <a href="editSP.php?id_sp=<?= $row['id_sp'] ?>"><i class="fa-regular fa-pen-to-square" style="font-size: 20px; color:#6786db; "></i></a>
      <!-- <button type="button" class="btn btn-danger">Xóa</button> -->
</td>
    <td>
      <a href="javascript:void(0);" onclick="confirmDelete(<?=$row['id_sp']?>)"><i class="fa-regular fa-circle-xmark" style="font-size:20px; color:red;"></i></a>
    </td>
    </tr>
    <?php
    $count=$count+1;
      }
    }
    ?>
  </tbody>
</table>

<button type="button" class="btn btn-success" style="margin-left:15%; background-color: #a05099; border: 1px solid #a05099;" data-toggle="modal" data-target="#myModal">Add product</button>


<?php
$sql_Dm = "select * from danhmuc";
$queryDm = mysqli_query($conn, $sql_Dm);



?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content add product-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="color:black;">
          <form  enctype='multipart/form-data'  action="./controller/addSanPhamController.php" method="POST">
            <div class="form-group">
              <label for="c_name" >Product name:</label>
              <input type="text" class="form-control" name="name_sp" required>
              <label for="dm">Type:</label><br>
              <select name="id_dm" class="form-control">
                <option value="unselect" selected>Category selection</option>
                <?php
                while($row_Dm = mysqli_fetch_array($queryDm)){
                ?>
                <option value="<?=$row_Dm['id_dm']; ?>"> <?=$row_Dm['name_dm'] ?></option>
                <?php } ?>
              </select>

              <label for="gia" >Price:</label>
              <input type="number" class="form-control" name="gia" required>

              <label for="chitiet">Product detail:</label><br>
              <textarea name="chitiet_sp" id="" cols="50" rows="4" class="form-control"></textarea>
              
              <label for="c_name" >Descriptive image:</label>
              <input type="file" class="form-control" name="anh_mota" required>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-success" name="submitt" style="background-color: #a05099;">Add product</button>
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="height:40px" onclick="closeModal()">Close</button>
        </div>
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

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        // Xử lý sự kiện click vào nút "Thêm sản phẩm"
        $(".btn-success").click(function(){
            $("#myModal").modal('show');
        });

        $(".btn-warning").click(function(){
            $("#editModal").modal('show');
   
        });
    });


//     function editDanhmuc(id){
//     $.ajax({
//         url:"addDanhmuc.php",
//         method:"post",
//         data:{record:id},
//         success:function(data){
//             $('.allContent-section').html(data);
//         }
//     });
// }
    function closeModal() {
        $("#myModal, #editModal").modal('hide');
    }

    function confirmDelete(id) {
        var result = confirm("Are you sure you want to delete?");
        if (result) {
            // Thực hiện chuyển hướng hoặc gọi hàm xóa ở đây
            window.location.href = "deleteSP.php?id_sp=" + id;
        } else {
            // Người dùng đã hủy bỏ xóa
            console.log("Cancel deletion");
        }
    }

</script>
</body>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
