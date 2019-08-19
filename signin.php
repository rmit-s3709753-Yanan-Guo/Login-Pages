<?php
session_start();
?>

<?php
session_start();
if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {
    $Username = $_POST['username'];
    $Password = $_POST['password'];
    if ($Username == null || !$Username){
        echo "Please Eneter UserId";
    }
    elseif($Password == null || !$Password){
        echo "Please Enter Password";
    }
    else{
        //check if any txt file exists in google cloud storage 
        //check if this is the first time signing up
        if(file_exists('gs://s3709753-storage/user.txt'))
        {
        $Array = explode(",",file_get_contents('gs://s3709753-storage/user.txt'));
        $arrlength=count($Array);
        $handle = fopen('gs://s3709753-storage/user.txt','w') or exit("Unable to open file!");
        for($x=0;$x<$arrlength;$x++)
            {
            fwrite($handle, $Array[$x].",");
            }

        fwrite($handle,$Username." ".$Password);
        fclose($handle);
        $_SESSION['user'] = $Username;
        
        }
        else
        {
            $handle = fopen('gs://s3709753-storage/user.txt','w') or exit("Unable to open file!");
            fwrite($handle,$Username." ".$Password);
            fclose($handle);
            $_SESSION['user'] = $Username;
        }
        echo 'Signup Successful';
        echo '<script language=javascript>window.location.href="/main"</script>';
        
    }
}    
?>

<html>
    <body>    
        <form action="/signin" method="post">
        UserId:<br>
        <input type="text" name="username" >
        <br>
        Password:<br>
        <input type="text" name="password" >
        <br><br>
        <input type="submit" value="Submit">
        </form>
        
    </body>
</html>