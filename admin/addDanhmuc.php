<?php
include_once './includes/header.php';
include_once './includes/navbar.php';

require_once './config/dbconnect.php';?>



<body>
    
<div style="overflow-x:auto; ">
<table class="table table-hover" style="width:70%; margin-left: 15%; margin-top:5%;   text-align: center;">
  <thead>
    <tr style = "background-color: #a05099; color:white; margin-left:500px;">
    <th scope="col" >STT</th>
      <th scope="col">Category name</th>
      <th scope="col">Edit the horn</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php $sql = "select * from danhmuc";
    $query = mysqli_query($conn, $sql);
    $result=$conn-> query($sql);
    $count=1;
    if ($result-> num_rows > 0){
      while($row = mysqli_fetch_array($query)){?>
    
    <tr>
      <th scope="row"><?= $count ?> </th>
      <th style="font-size:19px; text-transform: capitalize;"><?= $row['name_dm']?> </th>
      <!-- <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" Chỉnh sửa</button> -->
      <input type="hidden" name="id_dm" value="<?= $row['id_dm']?>">
      
      <td> 
        <!-- <button type="button" class="btn btn-warning" style="margin-left:15%" data-toggle="modal" data-target="#editModal" onclick="editDanhmuc(')">Chỉnh sửa</button> -->
        <a href="editDanhmuc.php?id_dm=<?= $row['id_dm']?>"><i class="fa-regular fa-pen-to-square" style="font-size: 20px; color:#6786db; "></i></a>
      <!-- <button type="button" class="btn btn-danger">Xóa</button> -->
</td>
    <td>
      <a href="javascript:void(0);" onclick="confirmDelete(<?=$row['id_dm']?>)"><i class="fa-regular fa-circle-xmark" style="font-size:20px; color:red;"></i></a>
    </td>
    </tr> <?php
    $count=$count+1;
      }
    }?>
    
  </tbody>
</table>

<button type="button" class="btn btn-success" style="margin-left:15%; background-color: #a05099; border: 1px solid #a05099;" data-toggle="modal" data-target="#myModal">Thêm danh mục</button>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content add categories-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New categories</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form  enctype='multipart/form-data'  action="./controller/addDanhmucController.php" method="POST">
            <div class="form-group">
              <label for="c_name">Category name:</label>
              <input type="text" class="form-control" name="name_dm" required>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-success" name="submit" >Add Category</button>
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="height:40px" onclick="closeModal()">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  


</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // $(document).ready(function(){
    //     // Xử lý sự kiện click vào nút "Thêm sản phẩm"
    //     $(".btn-success").click(function(){
    //         $("#myModal").modal('show');
    //     });

    //     $(".btn-warning").click(function(){
    //         $("#editModal").modal('show');
   
    //     });
    // });


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
    // function closeModal() {
    //     $("#myModal, #editModal").modal('hide');
    // }

    function confirmDelete(id) {
        var result = confirm("Are you sure you want to delete?");
        if (result) {
            // Thực hiện chuyển hướng hoặc gọi hàm xóa ở đây
            window.location.href = "deleteDanhmuc.php?id_dm=" + id;
        } else {
            // Người dùng đã hủy bỏ xóa
            console.log("Cancel deletion");
        }
    }

</script>
</body>
<?php
include('includes/scripts.php');
include('includes/footer.php');?>

