<?php
require_once './config/dbconnect.php';
$id_dm = $_GET['id_dm'];

    $sql = "DELETE FROM danhmuc where id_dm ='$id_dm' ";
    
    $data=mysqli_query($conn,$sql);

    if($data){
        // echo"Category Item Deleted";
        // alert('Category Successfully deleted');
        header('location: addDanhmuc.php');
    }
    else{
        echo"Not able to delete";
    }
    ?>