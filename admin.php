<?php include 'db_connection.php';
    $db = db_connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    
    <!-- Display Records Available in Cert Log Table -->
    
    <?php

        //Write query to get all data from database
        $sql = "SELECT training_status, full_name From cert_log ORDER BY id";

        //Run query to get the result
        $result = mysqli_query($db, $sql);

        //fetch the resulting rows as an array 
        $certicate_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
      
        print_r($certicate_data);

        //free up the memory
        mysqli_free_result($result);

        //disconnect from database
        db_disconnect($db);


    ?>
    

    <h4 class="title">Certificates Details</h4>

    <div class="row">

        <?php

        //Foreach the certificate data 
        foreach($certicate_data as $certicate_item) { ?>

            <div class="single-row">
                <p><?php echo htmlspecialchars($certicate_item['full_name'])  ?></p>
                <p><?php echo htmlspecialchars($certicate_item['training_status'])  ?></p>
            </div>

        <?php 
        }
        ?>

    </div>

    <div class="admin-panel-wrapper">
        <div class="sidebar">
            Sidebar Here
        </div>
        <div class="main-content">

        </div>
    </div>


</body>
</html>
