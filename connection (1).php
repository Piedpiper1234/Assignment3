<?php
    
    include "credentials.php";
    
    // make a database connection
    $connection = new mysqli('localhost', $user, $pw, $db);
    
    // select all records from our table
    $records = $connection->prepare("select * from scp");
    $records->execute();
    $result = $records->get_result();


?>