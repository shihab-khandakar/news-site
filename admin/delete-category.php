<?php

if($_SESSION['user_role'] == 0){
    header("location: {$hostname}/admin/post.php");
}

include('config.php');

$cate_id = $_GET["id"];

$sql = "delete from category where category_id = {$cate_id} ";

    if(mysqli_query($conn , $sql)){
        header("location: {$hostname}/admin/category.php");
    }

    mysqli_close($conn);

?>