<?php include "header.php";

if($_SESSION['user_role'] == 0){
    header("location: {$hostname}/admin/post.php");
}

    if(isset($_POST["sumbit"])){

        include('config.php');

        $cate_id = mysqli_real_escape_string($conn,$_POST["cat_id"]);
        $cate_name = mysqli_real_escape_string($conn,$_POST["cat_name"]);

        $sql1 = "update category set category_name = '{$cate_name}' where category_id = {$cate_id}";

        if(mysqli_query($conn , $sql1)){
            header("location: {$hostname}/admin/category.php");
        }

    }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

              <?php

              include('config.php');

              $category_id = $_GET["id"];

              $sql = "select * from category where category_id = {$category_id}";
                $result = mysqli_query($conn,$sql) or die("qurey failed");

                if(mysqli_num_rows($result) > 0){

                    while($row = mysqli_fetch_assoc($result)){

              ?>

                  <form action="<?php $_SERVER['PHP_SELF'];  ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row["category_id"];  ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row["category_name"];  ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>

                  <?php 
                    }
                        }

                    ?>

                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
