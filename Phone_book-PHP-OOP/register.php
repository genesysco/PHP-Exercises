<?php
    require_once 'init.php';
    if(isset($_SESSION['userId']))
        $main->redirect('index.php');

    if($main->post('register'))
    {
        $email = $main->safer($main->post('email'));
        $pass = $main->safer($main->post('pass'));
        $r = $main->register($email,$pass);
        if($r)
        {
            $main->redirect('?msg=regOk');
            
        }
        else
        {
            $main->redirect('?msg=repetitiousEmail');
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <title>صفحه ثبت نام</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 my-3 mx-auto">
                <form action="?" method="post">
                    <?php
                        $main->setSuccess('regOk','ثبت نام با موفقیت انجام شد !');
                        $main->setDanger('repetitiousEmail','خطا ! ایمیل تکراری میباشد ...');
                    ?>
                    ایمیل : <input type="email" name="email" class="form form-control">
                    رمز : <input type="password" name="pass" class="form form-control">
                    <input type="submit" value="ثبت نام" class="btn btn-info my-2" name="register">
                </form>
                <a href="login.php" class="btn btn-success">صفحه ورود</a>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
</body>
</html>
