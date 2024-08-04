<?php
    if(isset($_POST['run']))
    {
        $a = isset($_POST['a']) || is_numeric($_POST['a']) ? (float)$_POST['a'] : '';
        $opt = isset($_POST['opt']) ? $_POST['opt'] : '';
        $b = isset($_POST['b']) || is_numeric($_POST['b']) ? (float)$_POST['b'] : '';

        if($a == 0 || $b == 0)
            print 'Wrong Input Entry Or Operation By Zero !';
        else
        {
            if($opt == '-')
            {
                $c = $a - $b;
                print 'Result : ' . $c;
            }
            elseif($opt == '+')
            {
                $c = $a + $b;
                print 'Result : ' . $c;
            }
            elseif($opt == 'x')
            {
                $c = $a * $b;
                print 'Result : ' . $c;
            }
            elseif($opt == '/')
            {
                $c = $a / $b;
                print 'Result : ' . $c;
            }
            elseif($opt == '%')
            {
                $c = $a % $b;
                print 'Result : ' . $c;
            }
            elseif($opt == '^')
            {
                $c = $a ** $b;
                print 'Result : ' . $c;
            }
            else
                print 'Wrong Operation Entry !';
        }
    }
?>

<form action="" method="post">
    <input type="text" name="a" value="<?php print $a; ?>"><br><br>
    <input type="text" placeholder="- , + , / , x , % , ^" name="opt" value="<?php print $opt; ?>"><br><br>
    <input type="text" name="b" value="<?php print $b; ?>"><br><br>
    <input type="submit" value="Calculate !" name="run">
    <br>
</form>