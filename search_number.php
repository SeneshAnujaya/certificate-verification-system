<?php 

include 'db_connection.php';
$db = db_connect();

// if(isset($_POST['certValue'])) {

//     $q = $_POST['certValue'];

// $sql = "SELECT * FROM certificates_records WHERE certificate_number = '" . $q . "'";
// $result = mysqli_query($db, $sql);

// if($result) {
//     $rowCount = mysqli_num_rows($result);
//     if($rowCount > 0){
//         echo "Valid certification number";
//     } else {
//     //    echo "invalid certification number";
//     }

// } else {
//     echo "Data Base Query Error";
// }
// }

if(isset($_POST['certValue'])) {
    $q = $_POST['certValue'];

    $sql = "SELECT * FROM certificates_records WHERE certificate_number = ?";
    $stmt = mysqli_prepare($db, $sql);

    if($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $q);

        if(mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if($result) {
                $rowCount = mysqli_num_rows($result);
                if($rowCount > 0) {
                    echo "Valid certification number";
                }
            }
            mysqli_free_result($result);
        } else {
            echo "Database error";
        }
        
    }
    mysqli_stmt_close($stmt);
}

?>