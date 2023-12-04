<?php
 include 'db_connection.php';

$db = db_connect();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>

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
    <div class="container login-container">
      <div class="login-form-wrap">
        <?php 

        $submit_error = "";

          function validate_inputs($data) {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = validate_inputs($_POST['user-name']);
            $password = validate_inputs($_POST['password']);
        
     
            $sql = "SELECT * FROM admin_logins WHERE admin_name=? AND admin_password=?";
            $stmt = mysqli_prepare($db, $sql);
        
            if ($stmt) {
            
                mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        
          
                if (mysqli_stmt_execute($stmt)) {
              
                    mysqli_stmt_store_result($stmt);
        
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        session_start();
                        $_SESSION['adminlogin'] = $username;
                        echo "<p>Correct</p>";
                        header("location: admin_panel.php");
                        exit; // Ensure the script stops here
                    } else {
                        $submit_error = "Incorrect username or password";
                    }
                } else {
                    echo "errors found";
                }
        
                // Close the prepared statement
                mysqli_stmt_close($stmt);
            } else {
                echo "login failed";
            }
        }
        

          // if($_SERVER["REQUEST_METHOD"] == "POST") {

          //   $username = validate_inputs($_POST['user-name']);
          //   $password = validate_inputs($_POST['password']);

           
          //   $sql = "SELECT * FROM admin_logins WHERE admin_name='" . $username . "' AND admin_password='" . $password . "'";
          //   $result = mysqli_query($db, $sql);

          //   if($result) {
          //    if(mysqli_num_rows($result) == 1) {
          //     session_start();
          //     $_SESSION['adminlogin'] = $username;
          //     echo "<p>Correct</p>";
          //     header("location: admin_panel.php");
          //    } else {
          //      $submit_error = "Incorrect username or Password";
          //    }
          //   } else {
          //     echo "query failed";
          //   }

          // }
        ?>
        <form method="POST" id="login-form" onsubmit="validateLogin(event)">
          <label for="username">User Name</label>
          <input type="text" name="user-name" id="username" />
          <span id="username-error" class="error"></span>

          <label for="ad-password">Password</label>
          <input type="password" name="password" id="ad-password" />
          <span id="password-error" class="error"></span>
          <p class="submit-error"><?php echo $submit_error; ?></p>

          <input
            type="submit"
            value="Login"
            name="login-btn"
            id="ad-login-btn"
          />
        </form>
      </div>
    </div>

      <!-- ==== Validate Js ==== -->
      <script src="./validate.js"></script>
  </body>
</html>
