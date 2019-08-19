<?php

session_start();

?>

<?php
if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST) ) {
    // Obtain username and password value from html form
    $Username = $_POST['username']; 
    $Password = $_POST['password'];
    
    //check if username or password are empty
    if ($Username == null || !$Username){
        echo "Please Enter Username";
    }
    elseif($Password == null || !$Password){
        echo "Please Enter Password";
    }

    else{
        //read txt from google cloud storage and store obtained content in array
        $Array = explode(",",
            file_get_contents('gs://s3709753-storage/user.txt')
        );
        
        
        $arrlength=count($Array);
        //Initiate flag as false
        $Flag = FALSE;

        for($x=0;$x<$arrlength;$x++)
        {
            $Token = explode(' ',$Array[$x]);
            $Stroed_Username = $Token[0];
            $Stored_Password = $Token[1];
            if ($Stored_Password == $Password && $Stroed_Username == $Username)
            {   
                //check if password inputed by user is same as stored in txt on google cloud
                //If passed check, change flag as true
                $Flag = TRUE;  
                break;                                                                      
            }                      
        }                
        
        if ($Flag == TRUE)
        { 
            //redirect to the main page if passed validation
            $_SESSION['user'] = $Username;
            echo '<script language=javascript>window.location.href="/main"</script>';
        }
        else
        {
            echo "User name or password is invalid";
        }
                    
    }  
}        
?>

<html>
    <body>
        <form action="/login" method="post">
        UserId:<br>
        <input type="text" name="username" >
        <br>
        Password:<br>
        <input type="text" name="password" >
        <br><br>
        <input type="submit" value="Login">
        <a href='/signin' target="_blank">Register</a>
        </form>
    </body>
</html>