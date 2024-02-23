<?php

//login.php

include('database_connection.php');

session_start();

if(isset($_SESSION["admin_id"]))
{
  header('location:index.php');
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
    <link rel="stylesheet" href="../style.css" />
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
            <form method="post" id="admin_login_form">
              <div class="input-boxes">
                <div class="input-box">
                  <i class="fas fa-envelope"></i>
                  <input type="text" name="admin_user_name" id="admin_user_name"             
                    placeholder="Enter your email"
                    required
                  />
                  <span id="error_admin_user_name" class="text-danger"></span>
                </div>
                <div class="input-box">
                  <i class="fas fa-lock"></i>
                  <input type="password" name="admin_password" id="admin_password"
                    placeholder="Enter your password"
                    required
                  />
                  <span id="error_admin_password" class="text-danger"></span>
                </div>
                <div class="text"><a href="#">Forgot password?</a></div>
                <div class="button input-box">
                  <input
                    type="submit"
                    name="admin_login" id="admin_login"
                    value="Login"
                  />
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
$(document).ready(function(){
  $('#admin_login_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"check_admin_login.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function(){
        $('#admin_login').val('Validate...');
        $('#admin_login').attr('disabled', 'disabled');
      },
      success:function(data)
      {
        if(data.success)
        {
          location.href = "<?php echo $base_url; ?>admin";
        }
        if(data.error)
        {
          $('#admin_login').val('Login');
          $('#admin_login').attr('disabled', false);
          if(data.error_admin_user_name != '')
          {
            // $('#error_admin_user_name').text(data.error_admin_user_name);
            location.href = "<?php echo $base_url; ?>admin";
          }
          else
          {
            $('#error_admin_user_name').text('');
          }
          if(data.error_admin_password != '')
          {
            // $('#error_admin_password').text(data.error_admin_password);
            location.href = "<?php echo $base_url; ?>admin";
          }
          else
          {
            $('#error_admin_password').text('');
          }
        }
      }
    });
  });
});
</script>