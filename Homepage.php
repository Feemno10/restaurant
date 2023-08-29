<?php 
session_start();
include('./database.php');

$db = new database();



if(isset($_POST['admin'])){
    $name_a = $_POST['name_a'];
    $email_a = $_POST['email_a'];
    $img_a = $_FILES['img_a'];
    $password_a = $_POST['password_a'];
    $imgold = $_POST['imgold'];
    
    $fileNew = $db -> uploadFile($img);


    $data = [
        "name_a" => $name_a,
        "img_a" => $fileNew,
        "email_a" => $email_a,
        "password_a" => $password_a
    ];

    $db -> insert("admin",$data);

    if($db -> query ){
        $_SESSION['success'] = "เพิ่มข้อมูลสำเร็จ !";
        header('location:'.$_SERVER['REQUEST_URI']);
        return;
    }else{
        $_SESSION['alert'] = "เพิ่มข้อมูลไม่สำเร็จ !";
        header('location:'.$_SERVER['REQUEST_URI']);
        return;
    }
}

if (isset($_POST['edit_admin'])) {
    $admin_id = $_POST['admin_id'];
    $name_a = $_POST['name_a'];
    $email_a = $_POST['email_a'];
    $img_a = $_FILES['img_a'];
    $password_a =$_POST['password_a'];
    $imgold = $_POST['imgold'];


    if($img['name'] != ""){
        $fileNew = $db -> uploadFile($img);
    }else{
        $fileNew = $imgold;
    }

    $data = [
        "name_a" => $name_a,
        "email_a" => $email_a,
        "img_a" => $fileNew,
        "password_a" => $password_a
    ];

    $db -> update("admin",$data,"admin_id = $id");

    if($db -> query){
        $_SESSION['success'] = "แก้ไขข้อมูลสำเร็จ!";
      header('location:'.$_SERVER['REQUEST_URI']);
        return;
    }else{
       $_SESSION['alert'] ="แก้ไขข้อมูลไม่สำเร็จ!";
      header('location:'.$_SERVER['REQUEST_URI']);
       return;
    }


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="contianer">


        <form action="" method="post" enctype="multipart/form-data">
            <?php include('./error.php')  ?>
            <div class="form-container m-4">
                <h1 class="text-container mb-4">รายชื่อแอดมิน</h1>
                <input type="text" placeholder="ชื่อแอดมิน" name="name_a" class="form-control mb-3 shadow-sm"
                    style="border-radius:20px" id="">

                <input type="text" placeholder="อีเมลล์แอดมิน" name="email_a" class="form-control mb-3 shadow-sm"
                    style="border-radius:20px" id="">
                    <input type="text" placeholder="รหัสผ่าน" name="password_a" class="form-control mb-3 shadow-sm"
                    style="border-radius:20px" id="">
                <hr>
                <input type="file" name="img_a" class="form-control mb-3" style="border-radius:20px" id="">

                <button type="submit" class="btn btn-outline-info" name="admin"
                    style="border-radius:20px">เพิ่มข้อมูล</button>

                <div class="col mt-auto text-center"><a href="./login.php" class="link-primary">logout</a>
                </div>
            </div>
        </form>

        <div class="row row-cols-3">
            <?php 
                $db_2 = new database();
                $db_2 -> select("admin","*");
                while($fetch_admin = $db_2 -> query -> fetch_object()){
                {?>

            <div class="col">
                <div class="card">
                    <img src="./image/<?= $fetch_admin -> img_a ?>" class="card-img-top" alt="Hollywood Sign on The Hill"
                        style="width:100%;height:200px" />
                    <div class="card-body">
                        <h5 class="card-title"><?= $fetch_admin -> name_a  ?></h5>
                        <p class="card-text">Price : <?= $fetch_admin -> email_a?></p>
                        <form action="" method="post" enctype="multipart/form-data">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal<?= $fetch_admin -> admin_id ?>">
                                        Edit
                                    </button>

                                    <div class="modal fade" id="exampleModal<?= $fetch_admin ->admin_id ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit information</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                <input type="hidden" name="admin_id" value="<?= $fetch_admin -> admin_id?>">
                                                <input type="hidden" name="imgold" value="<?= $fetch_admin -> img_a ?>">
                                                <input type="text" name="name_a" class="form-control" placeholder="adminname">

                                                    <div class="col mt-auto ">
                                                        <h5 class="text-left mb-2">email</h5>
                                                        <input type="text" name="email_a" class="form-control"
                                                            placeholder="adminemail" id="" required>
                                                        <h5 class="text-left mb-2">image</h5>
                                                        <input type="file" name="img_a" id="img_upload"
                                                            class="form-control mb-4" onchange="PreviewImage()">
                                                        <div class="row">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="edit_food" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                </form>
                </div>
            </div>
            <?php } }?>
        </div>
    </div>
  </div>
 </div>


</body>


</html>