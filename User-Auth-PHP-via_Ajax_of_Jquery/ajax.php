<?php

    require_once 'function.php';
    connect();

    $task = isset($_POST['task']) ? $_POST['task'] : '';

    if($task == 'delUser')
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if($id > 0)
        {
            $q = "DELETE FROM users where id='$id'";
            $r = query($q);
            if($r == 1)
            {
                print 1;
            }
            else
            {
                print 0;
            }
        }
    }
    elseif($task == 'alterUser')
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if($id > 0)
        {
            $name = isset($_POST['name']) ? $_POST['name'] : '';
            $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
            $uname = isset($_POST['uname']) ? $_POST['uname'] : '';
            if($name != '' && $lname != '' && $uname != '')
            {
                $q = "UPDATE users SET
                    `name`='$name',`lastname`='$lname',`username`='$uname' WHERE id='$id'";
                $r = query($q);
                print $r;
            }
            
        }
    }
    elseif($task == 'loadUser')
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if($id > 0)
        {
            $q = "SELECT * FROM users where id='$id'";
            $r = query($q);
            $row = getRow($r);
            print json_encode($row);
        }
    }
    elseif($task == 'logIn')
    {
        $user = isset($_POST['uname']) ? sanitize($_POST['uname']) : '';
        $pass = isset($_POST['pass']) ? sanitize($_POST['pass']) : '';
        if($user != '' && $pass != '')
        {
            $p = sha1($pass);
            $q = "select * from users where username='$user' and password='$p'";
            $r = query($q);
            if($row = getRow($r))
            {
                print 'OK<br><br>';
                $_SESSION['user'] = $user;
                print "You Are Logged In with user $user !<br><br>";
                print "<a name=\"logOut\" id=\"logOut\" class=\"btn btn-danger\">Log OUT !</a>";
            }
            else
            {
                print 'Can not!';
            }
        }
    }
    elseif($task == 'logOut')
    {
        unset($_SESSION['user']);
    }
