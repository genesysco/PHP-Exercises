<?php
    require_once 'init.php';

    if(!isset($_SESSION['userId']))
        $main->redirect('login.php');

    if($main->get('logOut'))
    {
        $main->logOut();
        $main->redirect('login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <title>صفحه اصلی</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3 mx-auto my-5">
                <a href="?logOut=1" class="btn btn-danger">خروج از سیستم</a>
                <a href="profile.php" class="btn btn-info">ویرایش پروفایل</a>
                <a href="addPhone.php" class="btn btn-warning m-2">افزودن تلفن</a>
                <a href="listAndSearchPhone.php" class="btn btn-primary m-2">لیست تلفن</a>
            </div>
        </div>
    </div>
</body>
</html>