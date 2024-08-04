<?php
    require_once 'function.php';
    connect();
    if(!isset($_SESSION['user']))
        header('location:index.php');
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

    <?php
        if(isset($_POST['submit']))
        {
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
            $uname = isset($_POST['uname']) ? $_POST['uname'] : '';
            $pass = isset($_POST['pass']) ? sha1($_POST['pass']) : '';
            if($name != '' && $lname != '' && $uname != '' && $pass != '')
            {
                $q = "INSERT into `users` VALUES (NULL,'$name','$lname','$uname','$pass')";
                $r = query($q);
            }
        }
    ?>

    <div class="container" >
        <div class="row" id="regisetration">
            <div class="col-md-4 my-5 mx-auto">
                <form action="" method="post">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                    <input type="text" name="lname" id="lname" class="form-control my-2" placeholder="Last Name">
                    <input type="text" name="uname" id="uname" class="form-control" placeholder="User Name">
                    <input type="text" name="pass" id="pass" class="form-control my-2" placeholder="Password">
                    <input type="submit" name="submit" id="submit" value="Register" class="btn btn-success">
                    <a href="#" class="btn btn-primary" hidden id="alterButton">  Alter  </a>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8  my-5 mx-auto">
                <table class="table text-center table-hover">
                    <thead  class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Password</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $q = "SELECT * From users";
                        $r = query($q);
                        while($row = getRow($r))
                        {
                            print '<tr>';
                            print "<td>" .$row['id']."</td>";
                            $data_id = "data-id='".$row['id']."'";
                            $data_user = "data-user='".$row['username']."'";
                            print "<td>" .$row['name']."</td>";
                            print "<td>" .$row['last name']."</td>";
                            print "<td>" .$row['username']."</td>";
                            print "<td>" .$row['password']."</td>";
                            print "<td><input type='button' id='editUser' 
                                $data_id class='btn btn-primary' value='EDIT' ></td>";
                            print "<td><input type='button' id='delUser' 
                                $data_id $data_user class='btn btn-danger' value='DELETE'></td>";
                            print '</tr>';
                        }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
<script src="bootstrap.js"></script>
<script src="jquery-3.6.3.min.js"></script>
<script>
    $(document).ready(function(){

        $(document).on('click','#editUser',function(){
            id = $(this).attr('data-id');
            editUser(id);
            loadUser(id);
        });

        $(document).on('click','#delUser',function(){
            id = $(this).attr('data-id');
            user = $(this).attr('data-user');
            _this = $(this).parent().parent();
            c = confirm("Are You Sure Want To Delete User " +user+ " ?")
            if(c)
            {
                delUser(id,_this);
            }
        });

        $('#alterButton').click(function(e){
            e.preventDefault;
            name = $('#name').val();
            lname = $('#lname').val();
            uname = $('#uname').val();
            params = {'task':'alterUser',
                    'id':id,
                    'name':name,
                    'lname':lname,
                    'uname':uname
                };
            $.post('ajax.php',params,function(data){
                if(data > 0)
                {
                    alert('User ' + params['uname'] +' Changed Successfully !');
                }
                else
                {
                    alert('User hasn\'t Altered !');
                }
            });
        });

    });

    function editUser(id)
    {
        location.href="#regisetration";
        $('#submit').attr('hidden','');
        $('#alterButton').removeAttr('hidden');        
    }

    function loadUser(id)
    {
        param = {'task':'loadUser' ,'id':id};
        $.post('ajax.php',param,function(uI){
            u = JSON.parse(uI);
            $('#name').val(u.name);
            $('#lname').val(u["last name"]);
            $('#uname').val(u.username);
            $('#pass').val(u.password);
        });
    }
    function delUser(id,_this)
    {
        params = {"task":"delUser","id":id};
        $.post('ajax.php',params,function(data){
            if(data == 1)
                _this.remove();
            else
                alert("User Hasen't Deleted !");
        })        
    }
</script>
</body>
</html>