<style>
    table{
        border: solid 1px #000;
        border-radius: 5px;
    }
    table td{
        border: solid 1px #000;
    }
</style>

<table>
    <?php
        for($i = 1; $i < 11; $i++)
        {
            print '<tr>';
            for($j = 1; $j < 11; $j++)
            {
                print '<td>';
                $c = $i * $j;
                print "$i * $j = $c";
                print '</td>';
            }
            print '</tr>';
        }
    ?>
</table> 
