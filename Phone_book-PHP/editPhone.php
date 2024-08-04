<?php
    require_once 'init.php';
    if(!$main->isLogin())
        $main->redirect('login.php');

    $id = (int)$main->get('id');
    $row = $main->getPhone($id);

    if($main->post('save'))
    {
        $result = $main->editPhone($id);
        if($result != -1)
            $main->redirect('?msg=editOk&id='.$id);
        else
            $main->redirect('?msg=repetitiousMob&id='.$id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <title>ویرایش اطلاعات</title>
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto my-5">
                <?php
                    $main->setSuccess('editOk','مشخصات با موفقیت تغییر کرد !');
                    $main->setDanger('repetitiousMob','خطا ! موبایل تکراری می باشد .');
                ?>
                <form action="" method="post">
                    <input type="text" placeholder="نام" name="fn" class="form-control" value="<?php print $row['fn']; ?>">
                    <input type="text" placeholder="نام خانوادگی" name="ln" class="form-control my-2" value="<?php print $row['ln']; ?>">
                    <input type="text" placeholder="تلفن ثابت" name="tel" class="form-control" value="<?php print $row['tel']; ?>">
                    <input type="text" placeholder="شماره موبایل" name="mobile" 
                    class="form-control my-2" value="<?php print $row['mobile']; ?>">
                    <input type="submit" class="btn btn-primary" name="save" value="ویرایش">
                </form>
                <a href="listAndSearchPhone.php" class="btn btn-warning my-2">بازگشت</a>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>