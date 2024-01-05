<?php
require_once './config/dbconnect.php';
$id_sp = $_GET['id_sp'];

    $sql = "DELETE FROM sanpham where id_sp ='$id_sp' ";
    
    $data=mysqli_query($conn,$sql);

    if($data){
        // echo"Category Item Deleted";
        // alert('Category Successfully deleted');
        header('location: addSanPham.php');
    }
    else{
        echo"Not able to delete";
    }
    ?>