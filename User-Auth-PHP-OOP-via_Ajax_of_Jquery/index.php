<?php
    require_once 'function.php';
    connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>

    <div class="container" >
        <div class="row" id="regisetration">
            <div class="col-md-4 my-5 mx-auto" id="loggedIn">
                <form action="" method="post">
                    <input type="text" name="uname" id="uname" class="form-control" placeholder="User Name">
                    <input type="password" name="pass" id="pass" class="form-control my-2" placeholder="Password">
                    <a name="logIn" id="logIn" class="btn btn-warning">Log In</a>
                </form>
                <a name="logOut" id="logOut" class="btn btn-danger my-2" <?php if(!isset($_SESSION['user']))
                {
                    print 'hidden';
                }
                ?>>Log Out</a>
                <a name="uPage" id="uPage" class="btn btn-primary" href="users.php" 
                <?php if(!isset($_SESSION['user']))
                {
                    print 'hidden';
                }
                ?>>Users Page</a>
            </div>
            
        </div>
    </div>


<script src="bootstrap.js"></script>
<script src="jquery-3.6.3.min.js"></script>
<script>

    $(document).ready(function(){
        $('#logIn').click(function(e){
            e.preventDefault;
            logIn();
        });

        $(document).on('click','#logOut',function(e){
            e.preventDefault;
            logOut();
        });
    });
    
    function logIn(){
        user = $('#uname').val();
        pass = $('#pass').val();
        params = {'task':'logIn',
            'uname':user,
            'pass':pass
        };
        $.post('ajax.php',params,function(data){
            $('#loggedIn').html(data);
        });
    }

    function logOut(){
        $.post('ajax.php',{'task':'logOut'},function(data){
            location.href='index.php';
        });
    }
</script>
</body>
</html>
