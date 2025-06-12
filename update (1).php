<?php

    include "connection.php";
    
    // Enable error report
    error_reporting(E_ALL);
    // display errors
    ini_set('display_errors', 1);
    
    // Update record from form submission (edit.php)
    if(isset($_POST['update']))
    {
        // prepare update statement
        $update = $connection->prepare("update scp set name=?, class=?, description=?, containment=?, image=? where id=?");
        $update->bind_param("ssssi", $_POST['name'], $_POST['class'], $_POST['description'], $_POST['containment'], $_POST['image'], $_POST['id']);
        
        if($update->execute())
        {
            echo "
                <p>Record successfully update</p>
                <p>Back to <a href='index.php'>Index page</a></p>
            ";
        }
        else
        {
            echo "
                <p>Error: {$update->error}</p>
                <p>Back to <a href='index.php'>Index page</a></p>
            ";
        }
    }

?>