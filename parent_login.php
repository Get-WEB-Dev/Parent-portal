<?php

//login.php

include('admin/database_connection.php');

session_start();

if(isset($_SESSION["parent_id"]))
{
  header('location:dashboard.php');
}
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="container">
      <input type="checkbox" id="flip" />
      <div class="cover">
        <div class="front">
          <img src="images/frontImg.jpg" alt="" />
          <div class="text">
            <span class="text-1"
              >Every new friend is a <br />
              new adventure</span
            >
            <span class="text-2">Let's get connected</span>
          </div>
        </div>
        <div class="back">
          <img class="backImg" src="assets/images/pactech.jpg" alt="" />
          <div class="text">
            <span class="text-1"
              >Complete miles of journey <br />
              with one step</span
            >
            <span class="text-2">Let's get started</span>
          </div>
        </div>
      </div>
      <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
            <form method="post" id="parent_login_form">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input
                    type="text"
                    name="parent_emailid"
                    id="parent_emailid"
                    placeholder="Enter your email"
                    required
                  />
                  <span id="error_parent_emailid" class="text-danger"></span>
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input
                    type="password"
                    type="password"
                    name="parent_password"
                    id="parent_password"
                    placeholder="Enter your password"
                    required
                  />
                  <span id="error_parent_password" class="text-danger"></span>
                </div>
                <div class="text"><a href="#">Forgot password?</a></div>
                <div class="button input-box">
                  <input
                    type="submit"
                    name="parent_login"
                    id="parent_login"
                    value="Login"
                  />
                </div>
                <div class="text sign-up-text">
                  Don't have an account? <a href="admin/parent_register.php">Sigup now</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </body>
</html>
<script>
  $(document).ready(function () {
    $("#parent_login_form").on("submit", function (event) {
      event.preventDefault();
      $.ajax({
        url: "check_parent.php",
        method: "POST",
        data: $(this).serialize(),
        dataType: "json",
        beforeSend: function () {
          $("#parent_login").val("Validate...");
          $("#parent_login").attr("disabled", "disabled");
        },
        success: function (data) {
          if (data.success) {
            location.href = "dashboard.php";
          }
          if (data.error) {
            $("#parent_login").val("Login");
            $("#parent_login").attr("disabled", false);
            if (data.error_parent_emailid != "") {
              $("#error_parent_emailid").text(data.error_parent_emailid);
            } else {
              $("#error_parent_emailid").text("");
            }
            if (data.error_parent_password != "") {
              $("#error_parent_password").text(data.error_parent_password);
            } else {
              $("#error_parent_password").text("");
            }
          }
        },
      });
    });
});
</script>
