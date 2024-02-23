<?php

//parent_action.php

include('database_connection.php');
session_start();

?>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="Parent/style.css" />

    <!----===== Iconscout CSS ===== -->
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/dataTables.bootstrap4.min.js"></script>
    <title>Parent Regisration Form</title>
  </head>
  <body>
    <div class="container">
      <header>Registration</header>

      <form  method="post" id="parent_form" enctype="multipart/form-data">
        <div class="form first">
          <div class="details personal">
            <span class="title">Personal Details</span>

            <div class="fields">
              <div class="input-field">
                <label>Full Name</label>
                <input type="text" name="parent_name" id="parent_name" class="form-control"  />
                <span id="error_parent_name" class="text-danger"></span>
              </div>

              <div class="input-field">
                <label>Sex</label>
                <select name="parent_sex" id="parent_sex" class="form-control" >
                  <option value="">Select sex</option>
                  <?php
                  echo load_sex_list($connect);
                  ?>
                </select>
              </div>

              <div class="input-field">
                <label>Relation</label>
                <select name="parent_relation" id="parent_relation" >
                  <option value="">Select relation</option>
                  <?php
                  echo load_relation_list($connect);
                  ?>
                </select>
                <span id="error_parent_relation" class="text-danger"></span>
              </div>

              <div class="input-field">
                <label>Email</label>
                <input type="text" name="parent_emailid" id="parent_emailid"  />
                <span id="error_parent_emailid" class="text-danger"></span>
              </div>

              <div class="input-field">
                <label>Create Password</label>
                <input type="password" name="parent_password" id="parent_password"  />
                <span id="error_parent_password" class="text-danger"></span>
              </div>

              <div class="input-field">
                <label>Mobile Number</label>
                <input
                  type="number"
                  name="parent_mobile"
                  id="parent_mobile"
                  placeholder="Enter mobile number"
             
                />
                <span id="error_parent_mobile" class="text-danger"></span>
              </div>

              <div class="input-field">
                <label> Alternative Mobile Number</label>
                <input
                  type="number"
                  name="alternate_parent_mobile"
                  id="alternate_parent_mobile"
                  placeholder="Enter alternative M N.O"
               
                />
                <span class="text-primary">It is advicable if you put alternative Mobile number</span>
              </div>

              <div class="input-field">
                <label>Job</label>
                <input type="text" name="parent_job" id="parent_job"  />
                <span id="error_parent_job" class="text-danger"></span>
              </div>

              <div class="input-field">
                <label>Date of Joining </label>
                <input type="text" name="parent_doj" id="parent_doj"  />
                <span id="error_parent_doj" class="text-danger"></span>
              </div>
            </div>
          </div>

          <div class="details ID">
            <span class="title">Address</span>

            <div class="fields">
              <div class="input-field">
                <label>Address</label>
                <input
                  name="parent_address"
                  id="parent_address"
                  placeholder="Permanent or Temporary"
                 
                />
                <span id="error_parent_address" class="text-danger"></span>
              </div>
              <div class="input-field">
                <label>image</label>
                <input
                  type="file"
                  name="parent_image"
                  id="parent_image"
                  placeholder="Only .jpg and .png allowed"
                />
              </div>
            </div>
            <div class="nextBtn">
          <input type="hidden" name="action" id="action" value="Add" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
</div>
          </div>
        </div>
      </form>
    </div>

    <!-- <script src="Parent/script.js"></script> -->
    </body>
</html>
    <script>

 $(document).ready(function(){

  $('#parent_doj').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        container: '#formModal modal-body'
    });

  function clear_field()
  {
    $('#parent_form')[0].reset();
    $('#error_parent_name').text('');
    $('#error_parent_address').text('');
    $('#error_parent_mobile').text('');
    $('#error_parent_emailid').text('');
    $('#error_parent_password').text('');
    $('#error_parent_job').text('');
    $('#error_parent_doj').text('');
    $('#error_parent_image').text('');
    $('#error_parent_sex').text('');
    $('#error_parent_relation').text('');
  }

  $('#parent_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"parent_action.php",
      method:"POST",
      data:new FormData(this),
      dataType:"json",
      contentType:false,
      processData:false,
      beforeSend:function()
      {        
        $('#button_action').val('Validate...');
        $('#button_action').attr('disabled', 'disabled');
      },
      success:function(data){
        $('#button_action').attr('disabled', false);
        $('#button_action').val($('#action').val());
       
          if(data.success)
        {
          location.href = "<?php echo $base_url; ?>admin";
        }
        
        if(data.error)
        { 
          if(data.error_parent_name != '')
          {
            $('#error_parent_name').text(data.error_parent_name);
          }
          else
          {
            $('#error_parent_name').text('');
          }
          if(data.error_parent_address != '')
          {
            $('#error_parent_address').text(data.error_parent_address);
          }
          else
          {
            $('#error_parent_address').text('');
          }
          if(data.error_parent_emailid != '')
          {
            $('#error_parent_emailid').text(data.error_parent_emailid);
          }
          else
          {
            $('#error_parent_emailid').text('');
          }
          if(data.error_parent_password != '')
          {
            $('#error_parent_password').text(data.error_parent_password);
          }
          else
          {
            $('#error_parent_password').text('');
          }
          if(data.error_parent_sex != '')
          {
            $('#error_parent_sex').text(data.error_parent_sex);
          }
          else
          {
            $('#error_parent_sex').text('');
          }
          if(data.error_parent_mobile != '')
          {
            $('#error_parent_mobile').text(data.error_parent_mobile);
          }
          else
          {
            $('#error_parent_mobile').text('');
          }
          if(data.error_parent_relation != '')
          {
            $('#error_parent_relation').text(data.error_parent_relation);
          }
          else
          {
            $('#error_parent_relation').text('');
          }
          if(data.error_parent_job != '')
          {
            $('#error_parent_job').text(data.error_parent_job);
          }
          else
          {
            $('#error_parent_job').text('');
          }
          if(data.error_parent_doj != '')
          {
            $('#error_parent_doj').text(data.error_parent_doj);
          }
          else
          {
            $('#error_parent_doj').text('');
          }
          if(data.error_parent_image != '')
          {
            $('#error_parent_image').text(data.error_parent_image);
          }
          else
          {
            $('#error_parent_image').text('');
          }
        }
      }
    });
  });
    });
  </script>

