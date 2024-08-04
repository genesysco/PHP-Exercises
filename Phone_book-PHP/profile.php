<?php
    require_once 'init.php';

    if(!$main->isLogin())
        $main->redirect('login.php?msg=NotLoggedIn');
    
    $profile = $main->getProfile();

    if($main->post('saveProfile'))
    {
        $main->saveProfile();
        $main->redirect('?msg=saved');
    }

    $del = $main->get('del');
    if($del == 1)
    {
        $main->delProfImg();
        $main->redirect('?msg=delProfImg');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>! پروفایل من</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-5 mx-auto">
                <?php
                    $main->setSuccess('saved','تغییرات ثبت شد !');
                    $main->setSuccess('delProfImg','عکس پروفایل حذف شد !');
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    ایمیل : <input type="text" class="form-control my-3" value="<?php print $profile['email']; ?>" disabled>
                    رمز : <input type="text" class="form-control my-3" value="<?php print $profile['password']; ?>" name="pass">
                    عکس کاربری : <?php
                        if(file_exists($profile['image_profile']))
                        {
                            ?>
                            <a href="<?php print $profile['image_profile']?>" target="_blank">
                                <img src="<?php print $profile['image_profile']?>" alt="" class="m-2" id="profileImage" target='blank'>
                            </a><br>
                            <a href="?del=1" class="btn btn-danger">
                                حذف عکس
                            </a>
                            <?php
                        }
                        else
                        {
                            print "<input type=\"file\" name=\"userImage\" class=\"form-control my-3\">";
                        }
                    ?>
                        <input type="submit" value="ثبت" class="btn btn-primary" name="saveProfile">
                </form>
                <a href="index.php" class="btn btn-info my-2">صفحه اصلی</a>
            </div>
        </div>
    </div>

</body>
</html>