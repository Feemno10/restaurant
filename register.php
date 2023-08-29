<?php
include('./database.php');
session_start();


$db = new database();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
   

    $data = [
        'username' => $username,
        'password' => $password,
        'Email' => $email
        
    ];

    $db->insertWhere('register', $data,"(SELECT username FROM register WHERE username = '$username')");

    if ($db->mysqli->affected_rows > 0) {
        $_SESSION['alert'] = 'Register Success !';
        header('location:' . $_SERVER['REQUEST_URI']);
        return;
    } else {
        $_SESSION['alert'] = 'Error Register !';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="dol-8">
                    <div class="fading-box">
                        <div class="card shadow" style="border-radius:8px;">
                            <div class="card-body m-0 p-0">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="./image/17.jpg" class="img-fluid h-100 w-100" alt="..."
                                            style="border-radius: 8px;">
                                    </div>
                                    <div class="col-8">
                                        <form action="" method="post">
                                            <div class="form-container m-4">
                                                <?php  include('./error.php'); ?>
                                                
                                                <h3 class="text-center mb-4">Register Page</h3>

                                                <input type="text" placeholder="Username" name="username"
                                                    class="form-control mb-3 shadow-sm" style="border-radius:20px"
                                                    id="">

                                                <input type="text" placeholder="Email Address" name="email"
                                                    style="border-radius:20px" class="form-control mb-3 shadow-sm"
                                                    id="">

                                                <hr>

                                                <input type="text" placeholder="Password" name="password"
                                                    class="form-control mb-3 shadow-sm" style="border-radius:20px"
                                                    id="">

                                                <input type="text" placeholder="Password Confirm" name="password-con"
                                                    style="border-radius:20px" class="form-control mb-3 shadow-sm"
                                                    id="">

                                                <div class="row">
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            name="register"
                                                            style="border-radius:20px">สมัครสมาชิก</button>


                                                    </div>
                                                    <div class="col mt-auto text-center"> <a href="./login.php"
                                                            class="link-primary">มีบัญชีอยู่แล้ว</a>
                                                    </div>
                                                </div>



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
</body>

</html>