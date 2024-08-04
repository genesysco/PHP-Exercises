<?php
    require_once 'init.php';

    if($main->isLogin())
        $main->redirect('index.php');

    if($main->post('login'))
    {
        $r = $main->logIn();
        if($r)
        {
            $main->redirect('profile.php');
        }
        else
        {
            $main->redirect('?msg=UserPassError');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <title>صفحه ورود</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-5 my-3 mx-auto">
                <?php
                    $main->setDanger('UserPassError','نام کاربری یا رمز اشتباه میباشد یا در سیستم موجود نمیباشد !');
                    $main->setWarning('NotLoggedIn','برای دیدن پروفایل خود ابتدا باید وارد شوید !');
                ?>
                <form action="?" method="post">
                    ایمیل : <input type="email" name="email" class="form form-control">
                    رمز : <input type="text" name="pass" class="form form-control">
                    <input type="submit" value="ورود" class="btn btn-info my-2" name="login">
                </form>
                <a href="register.php" class="btn btn-success">صفحه ثبت نام</a>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
</body>
</html>