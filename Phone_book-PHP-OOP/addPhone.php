<?php
    require_once 'init.php';

    if(!$main->isLogin())
        $main->redirect('login.php');
    
    if($main->post('save'))
    {
        $r = $main->addPhone();
        if($r > 0)
            $main->redirect('?msg=saved');
        else
            $main->redirect('?msg=mobError');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن تلفن</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-5 mx-auto">
                <?php
                    $main->setSuccess('saved','مشخصات با موفقیت ثبت شد .');
                    $main->setDanger('mobError','موبایل تکراری میباشد .');
                ?>
                <form action="" method="post">
                    <input type="text" placeholder="نام" name="fn" class="form-control">
                    <input type="text" placeholder="نام خانوادگی" name="ln" class="form-control my-2">
                    <input type="text" placeholder="تلفن ثابت" name="tel" class="form-control">
                    <input type="text" placeholder="شماره موبایل" name="mobile" class="form-control my-2">
                    <input type="submit" class="btn btn-primary" name="save" value="ثبت">
                </form>
                <a href="index.php" class="btn btn-danger mt-2">بازگشت</a>
            </div>
        </div>
    </div>
</body>
</html>