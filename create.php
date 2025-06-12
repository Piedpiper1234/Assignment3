<!doctype html>
<html>
    <head>
        <title>Add new record</title>
    </head>
    <body>
        <?php
        
            // enable error reporting
            error_reporting(E_ALL);
            
            // display errors
            ini_set('display_errors', 1);
        
            include "connection.php";
            
            // when form is submitted prepare contents to send to database
            if(isset($_POST['create']))
            {
                // prepare sql statement to insert data
                $insert = $connection->prepare("insert into scp(name, class, description, containment, image) values(?,?,?,?,?)");
                $insert->bind_param("sssss", $_POST['name'], $_POST['class'], $_POST['description'], $_POST['containment'], $_POST['image']);
                
                if($insert->execute())
                {
                    echo "
                        <p>Record successfully created.</p>
                    ";
                }
                else
                {
                    echo "
                        <p>Error creating record {$insert->error}.</p>
                    ";
                }
                
            }
        
        ?>
        <h1>Add new record</h1>
        <p><a href="index.php">Back to index page</a></p>
        
        <form method="post" action="create.php">
            <label>Name</label>
            <br>
            <input type="text" name="name" placeholder="Enter SCP Name">
            <br>
            <label>Class</label>
            <br>
            <input type="text" name="class" placeholder="Enter SCP Class">
            <br>
            <label>Description</label>
            <br>
            <input type="text" name="description" placeholder="Enter SCP Description">
            <br>
            <label>Containment</label>
            <br>
            <input type="text" name="containment" placeholder="Enter SCP Containment">
            <br>
            <label>Image</label>
            <br>
            <input type="text" name="image" placeholder="e.g images/name_of_image.png">
            <br>
            <input type="submit" name="create" value="Add new record">
        </form>
        
    </body>
</html>