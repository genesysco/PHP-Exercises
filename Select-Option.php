<form action="?" method="post">
    <select name="names[]" multiple>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
    </select>
    <input type="submit" name="submit" value='RUN'>
</form>

<?php
    if(isset($_POST['names']))
    {
        $n = $_POST['names'];
        foreach($n as $m)
        {
            print "You Selected $m <br>";
        }
    }
?>