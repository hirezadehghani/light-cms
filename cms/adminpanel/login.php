<?php
    require_once("./include/config.php");
    require_once("./include/db.php");
    session_start();

    if (isset($_POST['submit'])) {
        if (trim($_POST['email']) != "" || trim($_POST['password']) != "") {
            // if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
        //your site secret key
        // $secret = '';
        //get verify response data
        // $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        // $responseData = json_decode($verifyResponse);
        // if($responseData->success){
            if(trim($_POST['sec-code']) == $_SESSION['captcha-code']){
                $email = htmlentities(trim($_POST['email']));
                $password = htmlentities(trim($_POST['password']));
                $user_select = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
                $user_select->execute(['email' => $email, 'password' => $password]);
                $_SESSION['email'] = $email;
                if ($user_select->rowCount() == 1) {
                    header("Location:index.php");
                    exit();
                }
        }
    }
            else {
            header("Location:login.php?err_msg=کد امنیتی را به طور صحیح وارد کنید");
            exit();
    }
            }

    ?>

    <!DOCTYPE html>

    <html lang="fa" dir="rtl">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
        <link rel="stylesheet" href="css/admin.css">
        <title>HiReza admin panel - Login</title>
        <link rel="shortcut icon" type="image/ico" href="../../img/hireza_favicon.ico"/>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>

    <body>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="card bg-dark" style="width: 400px;">
                    <?php
                    if (isset($_GET['err_msg'])) {
                    ?>
                        <div class="alert alert-danger" role="start">
                            <?php echo htmlentities($_GET['err_msg']) ?>
                        </div>
                    <?php
                    }
                    ?>
                    <h3 class="text-white text-center pt-3">ورود</h3>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="email" class="text-white">ایمیل</label>
                                <input type="email" name="email" id="email" required class="w-100">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-white">رمز عبور</label>
                                <input type="password" name="password" id="password" required class="w-100">

                                <!-- captcha -->
                                <img src="captcha.php">
                                <label for="sec-code" class="my-3 text-white">کد کپچا</label>
                                <input name="sec-code" type="number" name="sec-code" pattern="[0-9]*" inputmode="numeric" placeholder="کد امنیتی"><br>
                                    <!-- <div name="g-recaptcha" class="g-recaptcha" data-sitekey=""></div> -->
                                <button type="submit" name="submit" class="btn btn-success w-100 mt-3">ورود</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>