<?php
// <!-- DB Credentials -->




function db_connect() {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "certificate";


    $connection = mysqli_connect($servername, $username, $password, $dbname);
    return $connection;
}

// Close database connection
function db_disconnect($connection) {
    if(isset($connection))
    mysqli_close($connection);
}

?>
