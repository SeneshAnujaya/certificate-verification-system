<?php 

include 'db_connection.php';
$db = db_connect();

// $q = intVal($_GET['q']);
$q = json_decode($_POST['certValue']);
echo $q;

$sql = "SELECT * FROM certificates_records WHERE certificate_number = '" . $q . "'";
// $sql = "SELECT * FROM certificates_records";
$result = mysqli_query($db, $sql);

if($result) {
    $rowCount = mysqli_num_rows($result);
    if($rowCount > 0){
        echo "Number already Exist : $rowCount";
    } else {
        echo "Number Available";
    }

} else {
    echo "Query Error";
}


?>