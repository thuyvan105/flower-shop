<?php
include_once './includes/header.php';
include_once './includes/navbar.php';

require_once './config/dbconnect.php';

$id_dm = $_GET['id_dm'];

?>
<body>
    
<div style="overflow-x:auto; ">
<table class="table table-hover" style="width:80%; margin-left: 10%; margin-top:0.5%;   text-align: center;">
  <thead>
    <tr style = "background-color: #a05099; color:white; margin-left:500px;">
    <th scope="col" >STT</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <!-- <th scope="col">Classification</th> -->
      <th scope="col">Description image </th>
      <th scope="col">Product details </th>

      <!-- <th scope="col">Chỉnh sừa</th>
      <th scope="col">Xóa</th> -->
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
    $perRow = ($page - 1) * $rowPerPage;
    // tham số cần tính toán( ts đầu tiên của limit (vd: t1: 0-4=>perpage=0)), số sp hiển thị 1 trang 
    $sql = "SELECT * from sanpham inner join danhmuc on sanpham.id_dm=danhmuc.id_dm where sanpham.id_dm='$id_dm' limit $perRow, $rowPerPage";
    $query = mysqli_query($conn, $sql);
    $result=$conn-> query($sql);

    // tính tổng số có bn trang
    $totalRow = mysqli_num_rows(mysqli_query($conn, "SELECT * from sanpham inner join danhmuc on sanpham.id_dm=danhmuc.id_dm where sanpham.id_dm='$id_dm'"));
    $totalPage = ceil($totalRow/$rowPerPage);

    $listPage = "";
    for($i=1; $i<=$totalPage; $i++){
        if($page==$i){
          $listPage.='<li class="page-item active"><a href="danhmucSP.php?id_dm=' . $id_dm . '&page='.$i.'" class="page-link" >'.$i.' <span class="sr-only">(current)</span></a></li>';
        }else{
          $listPage .='<li class="page-item"><a href="danhmucSP.php?id_dm=' . $id_dm . '&page='.$i.'" class="page-link">'.$i.'</a></li>';
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
      <!-- <td style="font-size:18px; text-transform: capitalize;"> <?= $row['name_dm'] ?> </td> -->
      <th> <img src="img/<?= $row['anh_mota'] ?>" alt="" style ="width:80px; height:80px;">  </th>
      <td style="font-size:18px;"><?= $row['chitiet_sp'] ?> </td>

      
    </tr>
    <?php
    $count=$count+1;
      }
    }
    ?>
  </tbody>
</table>

<!-- <button type="button" class="btn btn-success" style="margin-left:15%; background-color: #a05099; border: 1px solid #a05099;" data-toggle="modal" data-target="#myModal">Thêm sản phẩm</button> -->

                  <nav>
                  <ul class="pagination" style="float:right; margin-right: 150px;">
                      <!-- <li class="page-item"><a href="" class="page-link">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                      <?php
                      echo $listPage;
                      ?>
                </ul>
                  </nav>

</div>

</div>
