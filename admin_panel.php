<?php 
session_start();
if(!isset($_SESSION['adminlogin'])) {
  header("location: login.php");
}

include 'db_connection.php';
$db = db_connect();

function redirect_to() {
  header("Location: " . $_SERVER["PHP_SELF"]);
exit;
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>

    <!-- ==== Google fonts ==== -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap"
      rel="stylesheet"
    />

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="./admin.css" />
  </head>
  <body>
    <div class="container">
      <div class="admin-top-bar">
        <h4>Admin Panel</h4>
        <form method="POST" class="logout-form">
          <button name="logout" class="logout-btn">Log Out</button>
        </form>
        <?php 
          if(isset($_POST['logout'])){
            session_destroy();
            header("location: login.php");
          }
        ?>
      </div>
      <div class="admin-wrap">
        <div class="side-bar">
          <div class="navigation-wrap">
            <ul class="navigation-menu">
              <li onclick="certificatesShow()">
                <a href="#">Insert Certificates</a>
              </li>
              <li onclick="submissionShow()">
                <a href="#">View Submissions</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="content-panel">
        
          <div class="insert-certificates-wrap panel-item">
            <h3 class="form-title">Enter certificate Details</h3>
            <div class="form-container">
        <form method="post" id="ad-cert-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  onsubmit="validateAdminForm(event)">
          <label for="student-name">Student Name<span class="star"> *</span></label>
          <input type="text" name="student-name" id="student-name" />
          <span id="student-error" class="error"></span>
        

          <label for="admin-cert-number">Certificate Number<span class="star"> *</span></label>
          <input type="number" name="admin-certificate-number" id="admin-cert-number" min="0" />
          <span id="admin-cert-error" class="error"></span>
   

          <label for="admin-achiev-date">Date of achievement<span class="star"> *</span></label>
          <input type="date" name="ad-achive-date" id="admin-achiev-date" />
          <span id="admin-date-error" class="error"></span>

          <input type="submit" name="ad-submit-btn" id="ad-submit-btn" />
        </form>  

        <?php 
        
        $student_name = "";
        $certificate_num = "";
        $date = "";

        function validate_inputs($data) {
          $data = trim($data);
          $data = stripcslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

        if($_SERVER['REQUEST_METHOD'] == "POST") {
          $student_name = isset($_POST['student-name']) ? validate_inputs($_POST['student-name']) : "";

          // $student_name = validate_inputs($_POST['student-name']);
          // $certificate_num = validate_inputs($_POST['admin-certificate-number']);
          // $date = validate_inputs($_POST['ad-achive-date']);

          $student_name = isset($_POST['student-name']) ? validate_inputs($_POST['student-name']) : "";
          $certificate_num = isset($_POST['admin-certificate-number']) ? validate_inputs($_POST['admin-certificate-number']) : "";
          $date = isset($_POST['ad-achive-date']) ? validate_inputs($_POST['ad-achive-date']) : "";

          $errors = array();

          if(empty($student_name)) {
            $errors[] = "Student Name is required.";
          }

          if(empty($certificate_num)) {
            $errors[] = "Certificate Number is required.";
          }

          if(empty($date)) {
            $errors[] = "Date is required.";
          }

          if(empty($errors)) {
            insert_certificate($student_name, $certificate_num, $date, $db);
            redirect_to();
          } else {
            foreach($errors as $error) {
              echo $error . "<br>";
            }
          }

      
        }


         // insert certificates
         function insert_certificate($name, $number, $date, $db) {

          $sql = "INSERT INTO certificates_records (name, certificate_number, date) VALUES (?, ?, ?)";

          $stmt = mysqli_prepare($db, $sql);

          if($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $name, $number, $date);

            if(mysqli_stmt_execute($stmt)) {
              echo "New Certificate Add Successfully";
            } else {
              echo "Database Error";
            }
             // Close the prepared statement
            mysqli_stmt_close($stmt);
          } else {
            echo "Query failed";
          }
         }

        ?>
       
        </div>    
          </div>

          <div class="f-submission-wrap panel-item">
            <div class="submisson-table-wrap">
            <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Certificate Number</th>
            <th>Date of achievement</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
$sql = "SELECT id, name, certificate_number, achieve_date FROM form_submissions";
$stmt = mysqli_prepare($db, $sql);

if ($stmt) {
 
    if (mysqli_stmt_execute($stmt)) {
    
        mysqli_stmt_bind_result($stmt, $id, $name, $certificate_number, $achieve_date);

        if (mysqli_stmt_fetch($stmt)) {
            
            do {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($certificate_number, ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td>" . htmlspecialchars($achieve_date, ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td> <form method='POST' action='delete_submissions.php'>
                <input type='hidden' name='delete_id' value='" . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . "'>
                <button class='delete-btn' type='submit' name='delete_records'>Delete</button>
                </form> </td>";
                echo "</tr>";
            } while (mysqli_stmt_fetch($stmt));
            
            echo "</table>";
        } else {
            echo "No records found.";
        }
    } else {
        echo "Statement execution failed";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Database error";
}





        
        db_disconnect($db);
        ?>
    </tbody>
</table>
            </div>
          

          </div>
        </div>
      </div>
    </div>

    <script>
      const certificatePanel = document.querySelector(
        ".insert-certificates-wrap"
      );
      const formSubmitPanel = document.querySelector(".f-submission-wrap");

      function certificatesShow() {
        certificatePanel.style.display = "block";
        formSubmitPanel.style.display = "none";
      }
      function submissionShow() {
        certificatePanel.style.display = "none";
        formSubmitPanel.style.display = "block";
      }
    </script>

    <!-- ==== Validate Js ==== -->
    <script src="./validate.js"></script>
  </body>
</html>
