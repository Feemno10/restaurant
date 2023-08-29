<?php
include('./database.php');
session_start();


$db = new database();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = [
        'username' => $usernanme,
        'password' => $password
    ];
    
    $db->select("register","*","username = '$username' AND password = '$password'");

    if ($db-> query -> num_rows > 0) {
        $fetch  = $db -> query -> fetch_object();
        $_SESSION['user_id'] = $fetch -> id_u;
        header('location:./Homepage.php');
        return;
    } else {
        $_SESSION['alert'] = 'Username / Password Wrong !!';
        header('location:' . $_SERVER['REQUEST_URI']);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<div class="container-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
                <div class="col-8">
                    <div class="fading-box">
                        <div class="cardshadow" style="border-radius : 8px;">
                     <div class="card-body m-0 p-0 ">
                      <div class="row">
                          <div class="col-8">
                          <form action="" method="post">
                            <div class="form-container m-4">
                            
                            <?php include('./error.php') ?>

                                <h3 class="text-canter mb-4 " >Login page</h3>
                                <input type="text"   placeholder = "Username "name="username" 
                                class= "form-control mb-3 shadow-sm" style="border-radius:20px" id="">
                                <hr>
                                <input type="password"   placeholder = "Password "name="password" 
                                class= "form-control mb-3 shadow-sm" style="border-radius:20px" id="">

                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class ="btn btn-outline-success" name="login" 
                                        style="border-radius:20px">เข้าสู่ระบบ</button>
                                    </div>
                                    <div class="col mt-auto text-center"><a href="./register.php"
                                       class=  "link-primary">ยังไม่มีบัญชี</a></div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <img src ="./image/55.jpg" class="img-fluid h-100 w-200" alt="..."
                                style = "border-radius: 8px;">
                            </div>
                        </div>

                      </div>
                     </div>
                    </div>

                    </div>
                <div class="col-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>