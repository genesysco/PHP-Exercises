<?php
    // ini_set('displaying_errors',0);
    // error_reporting(0);
    session_start();

    function connect()
    {
        global $c;
        $c = mysqli_connect('localhost','root','') or die(mysqli_connect_error());
        mysqli_select_db($c,'db') or die(getError());
        mysqli_query($c,"SET NAMES 'UTF8'");
    }
    
    function disconnect()
    {
        global $c;
        mysqli_close($c);
    }

    function query($q)
    {
        global $c;
        $result = mysqli_query($c,$q);
        if(stristr('insert',$q))
            return mysqli_insert_id($c);
        elseif(stristr($q,'update') || stristr($q,'delete'))
            return mysqli_affected_rows($c);
        else
            return $result;

    }

    function getRow($r)
    {
        return mysqli_fetch_assoc($r);
    }

    function getError()
    {
        global $c;
        mysqli_error($c);
    }

    function sanitize($entry)
    {
        $e = htmlentities($entry,ENT_QUOTES, 'UTF8');
        return $e;
    }

?>
