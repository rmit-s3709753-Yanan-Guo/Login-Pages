<?php

session_start();

?>

<?php
        
        $Username = $_SESSION['user'];
        echo "Logged in as: ";
        echo $Username."   ";
        echo '<a href="/login">Lougout</a>';
        echo "<br>";
        echo "_______________________________________";
        echo "<p> <font color=black size='8pt'> Main Content</p>";
        session_destroy();

        
