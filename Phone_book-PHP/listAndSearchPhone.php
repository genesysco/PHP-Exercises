<?php
    require_once 'init.php';

    if(!$main->isLogin())
        $main->redirect('login.php');
    
        $fn = $main->safer($main->post('fn'));
        $ln = $main->safer($main->post('ln'));
        $tel = $main->safer($main->post('tel'));
        $mobile = $main->safer($main->post('mobile'));

    $id = (int)$main->get('id');
    if($id > 0)
    {
        $r = $main->phoneDel($id);
        if($r == 1)
        {
            $main->redirect('?msg=deletedUser');
        }
        else
        {
            $main->redirect('?msg=noDelUser');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لیست تلفن</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
</head>
<body>


    <!--------------------- MODAL ----------------------------->

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"> بازگشت </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">کنسل</button>
                <button type="button" class="btn btn-danger" id="deleteUser">حذف</button>
            </div>
            </div>
        </div>
        </div>

    <!-------------------- MODAL End -------------------------->


    <div class="container">
        <div class="row my-5">
            <div class="col-md-5 mx-auto">
                <form action="" method="post" class="my-2">
                    <input type="text" placeholder="نام" name="fn" class="form-control">
                    <input type="text" placeholder="نام خانوادگی" name="ln" class="form-control my-2">
                    <input type="text" placeholder="تلفن ثابت" name="tel" class="form-control">
                    <input type="text" placeholder="شماره موبایل" name="mobile" class="form-control my-2">
                    <input type="submit" class="btn btn-primary" name="search" value="جستجو">
                </form>
                    <a href="?" class="btn btn-info">ریست</a>
                    <a href="index.php" class="btn btn-warning">بازگشت</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?php
                    $main->setSuccess('deletedUser','کاربر با موفقیت حذف شد !');
                    $main->setDanger('noDelUser','خطا در حذف کاربر !!!');

                    $result = $main->getPhoneList($fn,$ln,$tel,$mobile);
                    if($result->num_rows == 0)
                    {
                        ?>
                        <div class="alert alert-warning text-center">
                            موردی یافت نشد !
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <table class="text-center table table-bordered">
                            <tr>
                                <th>نام</th>
                                <th>نام خانوادگی</th>
                                <th>تلفن</th>
                                <th>موبایل</th>
                                <th>عملیات</th>
                            </tr>
                            <?php
                            while($row = $main->getRows($result))
                            {
                                ?>
                                <tr>
                                    <td><?php print $row['fn']; ?></td>
                                    <td><?php print $row['ln']; ?></td>
                                    <td><?php print $row['tel']; ?></td>
                                    <td><?php print $row['mobile']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal" data-id="<?php print $row['id']; ?>"
                                        data-name="<?php print $row['fn'] . " " . $row['ln']; ?>">
                                            <svg width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </button>
                                        <a href="editPhone.php?id=<?php print $row['id']; ?>" class="btn btn-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
</svg>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
        $(document).ready(function(){
            var id = null;
            $('[data-bs-toggle]').click(function(){
                id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                $('.modal-body').text('آیا می خواهید کاربر ' + name + ' حذف شود ؟');
            });

            $('#deleteUser').click(function(){
                window.location.href = "?id="+id;
            });
        });
    </script>
</body>
</html>