<form action="" method="post">
    <input type="text" name="number">
    <input type="submit" value="Grade" name="run">
</form>

<?php

    if(isset($_POST['run']))
    {
        $num = isset($_POST['number']) ? (int)$_POST['number']: '';
        if($num == 20 )
            print "Grade Is A";
        elseif($num >= 16 && $num <= 19)
            print "Grade Is B";
        elseif($num >= 10 && $num <= 15)
            print "Grade Is C";
        elseif($num >= 0 && $num <= 9)
            print "Grade Is D";
        else
           print "Error !";
        
        print '<br>' . $num;
    }

?>