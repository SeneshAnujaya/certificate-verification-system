
<?php include 'db_connection.php';

$db = db_connect();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>verification page</title>

    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div class="container">
      <div class="form-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
          <label for="name">Learner Name*</label>
          <input type="text" name="learner-name" id="name" />
          <label for="certificate">Certificate Number*</label>
          <input type="text" name="certificate-number" id="certificate" />
          <label for="date">Date of achievement*</label>
          <input type="date" name="achive-date" id="date" />
          <input type="submit" name="submit" id="submit-btn" />
        </form>

        <?php
        // define variables and set to empty values
        $learner_name = "";
        $certificate_number = "";
        $date = "";

        if($_SERVER['REQUEST_METHOD'] == "POST") {
          $learner_name = $_POST['learner-name'];
          $certificate_number = $_POST['certificate-number'];
          $date = $_POST['achive-date'];

          echo "Learner Name: " . $learner_name . "<br/>";
          echo "Certificate Number: " . $certificate_number . "<br/>";
          echo "Date: " . $date . "<br/>";

          

         

          $sql = "INSERT INTO certificates_records ";
          $sql .= "(name, certificate_number, date) ";
          $sql .= "VALUES (";
          $sql .= "'" . $learner_name . "',";
          $sql .= "'" . $certificate_number . "',";
          $sql .= "'" . $date . "'";
          $sql .= ")";

       
          
          if(mysqli_query($db, $sql)) {
            echo "New Record Add Successfully";
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
          }

          db_disconnect($db);

       

      
        }
        

        
        ?>
      </div>
    </div>
  </body>
</html>
