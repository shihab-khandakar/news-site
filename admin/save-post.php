<?php

    include("config.php");

    if(isset($_FILES["fileToUpload"])){
        $errors = array();

        $file_name = $_FILES["fileToUpload"]["name"];
        $file_size = $_FILES["fileToUpload"]["size"];
        $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
        $file_type = $_FILES["fileToUpload"]["type"];
        $file_ext = end(explode('.',$file_name));

        $extention = array("jpeg","jpg","png");

        if(in_array($file_ext,$extention) === false){

            $errors[] = "This extention is not support, please choose jpg or png ";

        }

        if($file_size > 2097152){
            $errors[] = "File must be 2mb or lower" ;
        }

        if(empty($errors) == true){

            move_uploaded_file($file_tmp,"upload/" . $file_name);

        }else{
            print_r($errors);
            die();
        }

    }

    session_start();

    $title = mysqli_real_escape_string($conn,$_POST["post_title"]);
    $post_desc = mysqli_real_escape_string($conn,$_POST["postdesc"]);
    $category = mysqli_real_escape_string($conn,$_POST["category"]);
    $date = date("d M, Y");
    $author = $_SESSION["user_id"];

    $sql = "insert into post(title,description,category,post_date,author,post_img)
        values('{$title}','{$post_desc}','{$category}','{$date}',{$author},'{$file_name}');";
    $sql .= "update category set post = post + 1 where category_id = {$category}";

    if(mysqli_multi_query($conn , $sql)){
        header("location: {$hostname}/admin/post.php");
    }else{
        echo "query failed";
    }



?>