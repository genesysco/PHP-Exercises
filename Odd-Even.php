
<form action="" method="POST">
    <input type="text" name="num">
    <input type="submit" value="OK!">
</form>


<?php

	$num = $_POST['num'];
    if($num < 10)
    {
        print $num * $num . '<br>';
    }

    if($num < 0)
    {
        print 'It\'s Negative...';
    }
    else
    {
        print 'It\'s Positive...<br>';
        if($num % 2 == 0)
        {
            print "It's Zoj!";
        }
        else
        {
            print "It's Fard!";
        }
    }

    

?>