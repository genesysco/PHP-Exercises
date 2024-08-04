<form action="?" method="POST" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit" value="UPLOAD" name="upload">
</form>

<?php
    if(isset($_POST['upload']))
    {
        if($_FILES['file']['error'] == 0)
        {
            $name = $_FILES['file']['name'];
            $path = $_FILES['file']['tmp_name'];
            $myPath = "Uploads/$name";
            $mvResult = move_uploaded_file($path,$myPath);
            if($myPath)
            {
                print "UPLOAD Done!";
            }
            else
            {
                print "Error !";
            }
        }
    }
?>

<!-- Array ( 
    [name] => photo_2023-08-17_21-54-53.jpg 
    [full_path] => photo_2023-08-17_21-54-53.jpg 
    [type] => image/jpeg 
    [tmp_name] => /tmp/phpnEb6Z8 
    [error] => 0 [size] => 60906 )  -->