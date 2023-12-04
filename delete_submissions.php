<?php 

include 'db_connection.php';
$db = db_connect();


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_records'])) {
    if (isset($_POST['delete_id'])) {
      $id_to_delete = intval($_POST['delete_id']);
  
      $sql = "DELETE FROM form_submissions WHERE id =? LIMIT 1";
      $stmt = mysqli_prepare($db, $sql);
  
      if($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_to_delete);
  
        if(mysqli_stmt_execute($stmt)) {
          // sucess delete
          header("Location: admin_panel.php");
        } else {
          echo "Error deleting the record: " . mysqli_error($db);
        }
  
       mysqli_stmt_close($stmt); 
      } else {
        echo "Can't Proceed: " , mysqli_error($db);
      }
  
    }
  }

?>