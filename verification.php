
<?php include 'db_connection.php';

$db = db_connect();

function redirect_to() {
  header("Location: " . $_SERVER["PHP_SELF"]);
exit;
}

?>


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
        <form method="post" id="cert-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm(event)" >
          <label for="name">Learner Name*</label>
          <input type="text" name="learner-name" id="name" />
          <span id="name-error" class="error"></span>

          <label for="certificate">Certificate Number*</label>
          <input type="number" name="certificate-number" id="certificate"/>
          <span id="cert-error" class="error"></span>
            <span id="searchMessage"></span>
          <!-- onkeyup="checkAvailable()" -->

          <label for="date">Date of achievement*</label>
          <input type="date" name="achive-date" id="date" />
          <span id="date-error" class="error"></span>

          <input type="submit" name="submit-btn" id="submit-btn" />
        </form>

        <?php

// if(isset($data->certificateNumber)) {

  

//   $certificate_number = mysqli_real_escape_string($db, $data->certificateNumber);
//   $certificate_number =  $data->certificateNumber;


  // $query = "SELECT COUNT(*) AS count FROM certificates_records WHERE certificate_number = '$certificate_number'";
//  $sql = "SELECT * FROM certificates_records WHERE certificate_number = '" . $certificate_number. "'";
  // $result = mysqli_query($db, $sql);

  // if(!$result) {
  //   die("Query failed: " . mysqli_error($db));
  // }
  
  // $row = mysqli_fetch_assoc($result);
  // echo $row;
  // Send a JSON response indicating whether the certificate number exists
//   $response = ['exists' => ($row['count'] > 0)];
//   echo json_encode($response);

// } else {
//   echo json_encode(['exists' => false]);
// }
// ?>

      

        <?php
        // define variables and set to empty values
        $learner_name = "";
        $certificate_number = "";
        $date = "";

        function validate_inputs($data) {
          $data = trim($data);
          $data = stripcslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        if($_SERVER['REQUEST_METHOD'] == "POST") {
          $learner_name = validate_inputs($_POST['learner-name']);
          $certificate_number = validate_inputs($_POST['certificate-number']);
          $date = validate_inputs($_POST['achive-date']);

          echo "Learner Name: " . $learner_name . "<br/>";
          echo "Certificate Number: " . $certificate_number . "<br/>";
          echo "Date: " . $date . "<br/>";

          $errors = array();

          if(empty($learner_name)) {
            $errors[] = "Learner Name is required.";
          }

          if(empty($certificate_number)) {
            $errors[] = "certificate number is required.";
          }

          if(empty($errors)) {
            // if no error place here
            redirect_to();
 
          } else {
            foreach($errors as $error) {
              echo $error . "<br>";
            }
    
        } 
        } 
        
      // insert certificates
        function insert_certificate($name, $number, $date, $db) {
          $sql = "INSERT INTO certificates_records ";
          $sql .= "(name, certificate_number, date) ";
          $sql .= "VALUES (";
          $sql .= "'" . $name . "',";
          $sql .= "'" . $number . "',";
          $sql .= "'" . $date . "'";
          $sql .= ")";
          
          if(mysqli_query($db, $sql)) {
            echo "New Record Add Successfully";
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
          }

         }
        
     
         db_disconnect($db);
        
        ?>
      </div>
    </div>

    <!-- Validate Script -->
    <script src="./validate.js"></script>
        <script src="./check.js"></script>
  </body>
</html>
