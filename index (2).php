<!doctype html>
<html>
    <head>
        <title>PHP SCP Application</title>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    </head>
    <body class="container">
        <?php include "connection.php"; ?>
        <h1>PHP CRUD Application</h1>
        <nav>
            <a href="index.php">Index Page</a>
            
            <?php foreach($result as $link): ?>
                <a href="index.php?link=<?php echo $link['name']; ?>"><?php echo $link['name']; ?></a>
            <?php endforeach; ?>
            
            <a href="create.php">Add new record</a>
        </nav>
        <div class="boarder rounded shadow p-3">
            <?php
            
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                // Display record contents based on link get value
                if(isset($_GET['link']))
                {
                    $name = trim($_GET['link']); // Remove any leading/trailing spaces
                    
                    // echo "<p>{$name}</p>";
                    
                    // retrieve record from database
                    $record = $connection->query("select * from scp where name = '$name'");
                    if($record)
                    {
                        $array = $record->fetch_assoc();
                        $edit = "edit.php?edit=" . $array['id'];
                        $delete = "index.php?del=" . $array['id']; 
                        
                        // display record fields on screen
                        echo "
                            <h1>{$array['name']}</h1>
                            <h3>{$array['class']}</h3>
                            <p>{$array['description']}</p>
                            <p>{$array['containment']}</p>
                            <p><img src='{$array['image']}' alt='{$array['name']}class ='img-fluid'></p>
                            <p>
                                <a href='{$edit}' class=btn-warning>Edit Record</a>||<a href='{$delete}'>Delete Record</a>
                            </p>
                        ";
                    }
                    else
                    {
                        echo "<p>Record did not display</p>";
                    }
                    
                }
                else
                {
                    // Ths content will display at first visit.
                    echo"
                        <h1>Welcome to this site</h1>
                        <p>Use the menu above to view SCP</p>
                    ";
                }
            if(isset($_GET['del']))
            {
                //convert del get valur to varible
                $ID = $_GET['del'];
                // prepare delete sql statement
                $delete =  $connection -> prepare ("delete from scp where id = ?");
                $delete->bind_param("i", $ID);
                
                if($delete->execute())
                {
                    echo "<p>Record Deleted</p>";
                }
                else
                {
                   
                    echo "<p>Error: {$delete->error}</p>";
                }
            }
            ?>
            
        </div>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    </body>
</html>