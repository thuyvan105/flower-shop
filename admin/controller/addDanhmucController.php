<?php
    include_once "../config/dbconnect.php";
    
    if(isset($_POST['submit']))
    {
       
        $name_dm = $_POST['name_dm'];
       
         $insert = mysqli_query($conn,"INSERT INTO danhmuc
         (name_dm) 
         VALUES ('$name_dm')");
 
         if(!$insert)
         {
             echo mysqli_error($conn);
             header("Location: ../addDanhmuc.php?category=error");
         }
         else
         {
             echo "Thêm thành công.";
             header("Location: ../addDanhmuc.php?category=success");
         }
     
    }

?>