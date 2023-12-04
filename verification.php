
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

    <!-- ==== Google fonts ==== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&family=Roboto:wght@300;400;500&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./style.css" />
  </head>
  <body>
    <div class="container">
      <div class="form-container">
        <h3 class="form-title">Enter Your certificate Details</h3>
        <form method="post" id="cert-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm(event)" >
          <label for="name">Learner Name<span class="star"> *</span></label>
          <input type="text" name="learner-name" id="name" />
          <span id="name-error" class="error"></span>

          <label for="certificate">Certificate Number<span class="star"> *</span></label>
          <input type="number" name="certificate-number" id="certificate" min="0" />
          <span id="cert-error" class="error"></span>
            <span id="searchMessage"></span>
          <!-- onkeyup="checkAvailable()" -->

          <label for="date">Date of achievement<span class="star"> *</span></label>
          <input type="date" name="achive-date" id="date" />
          <span id="date-error" class="error"></span>

          <input type="submit" name="submit-btn" id="submit-btn" />
 
        </form>      

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



          $errors = array();

          if(empty($learner_name)) {
            $errors[] = "Learner Name is required.";
          }

          if(empty($certificate_number)) {
            $errors[] = "certificate number is required.";
          } 


          if(empty($date)) {
            $errors[] = "Date is required.";
          } 

          if(empty($errors)) {
            $sql = "SELECT * FROM certificates_records WHERE certificate_number = ?";
            $stmt = mysqli_prepare($db, $sql);

            if($stmt) {
              mysqli_stmt_bind_param($stmt, "s", $certificate_number);
              
              if(mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if($result) {
                  $rowCount = mysqli_num_rows($result);

                  if($rowCount > 0) {
                    insert_certificate($learner_name, $certificate_number, $date, $db);
                    echo "Form submit success!";
                    redirect_to();
                  } else {
                    echo  "<p class='invalid-num-error'>Please enter valid certification number</p>";
                  }
              
                } else {
                  echo "Database Error.";
                }
              }
               // free result
                mysqli_free_result($result);
               // Close the prepared statement
              mysqli_stmt_close($stmt);
            } 

          }  else {
            foreach($errors as $error) {
                    echo $error . "<br>";
                   }
          }

        }
          

        
          // if(empty($errors)) {
            // if no error place here
            // Check certificate numbers exist in database
        //     $sql = "SELECT * FROM certificates_records WHERE certificate_number = '" . $certificate_number . "'";
        //     $result = mysqli_query($db, $sql);

        //     if($result) {
        //       $rowCount = mysqli_num_rows($result);
        //       if($rowCount > 0) {
        //         insert_certificate($learner_name, $certificate_number, $date, $db);
        //         echo "Form submit success!";
        //         redirect_to();
        //       } else {
        //         echo "Please enter valid certification number";
        //       }
        //     } else {
        //       echo "Data Base Error";
        //     }
        //   } else {
        //     foreach($errors as $error) {
        //       echo $error . "<br>";
        //     }
    
        // } 
        // } 
        
 // insert certificates
        function insert_certificate($name, $number, $date, $db) {
          $sql = "INSERT INTO form_submissions (name, certificate_number, achieve_date) VALUES (?, ?, ?)";

          $stmt = mysqli_prepare($db, $sql);

          if($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $number, $date);

            if(mysqli_stmt_execute($stmt)) {
              echo "New Record Add Successfully";
            } else {
              echo "Database Error";
            }
             // Close the prepared statement
            mysqli_stmt_close($stmt);
          } else {
            echo "Query failed";
          }
        }
        
     
         db_disconnect($db);
        
        ?>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Validate Script -->
    <script src="./validate.js"></script>
    <script src="./check.js"></script>
  </body>
</html>
