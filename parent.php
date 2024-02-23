
<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="assets/css/style.css" />

    <!----===== Iconscout CSS ===== -->
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />

    <title>Parent Regisration Form</title>
  </head>
  <body>
    <div class="container">
      <header>Registration</header>

      <form id="parent_form" method="post" action="parent_action.php">
        <div class="form first">
          <div class="details personal">
            <span class="title">Personal Details</span>

            <div class="fields">
              <div class="input-field">
                <label>First Name</label>
                <input
                  type="text"
                  name="parent_first_name"
                  id="parent_first_name"
                  placeholder="Enter first name"
                  required
                />
              </div>

              <div class="input-field">
                <label>last Name</label>
                <input
                  type="text"
                  name="parent_last_name"
                  id="parent_last_name"
                  placeholder="Enter first name"
                  required
                />
              </div>

              <div class="input-field">
                <label>Gender</label>
                <select name="parent_sex" id="parent_sex" required>
                  <option value="">Select your sex</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>

              <div class="input-field">
                <label>Parent Type</label>
                <select name="parent_type" id="parent_type" required>
                  <option value="">Select your Type</option>
                  <option value="father">Father</option>
                  <option value="mother">Mother</option>
                  <option value="grand_mother">Grand Mother</option>
                  <option value="grand_father">Grand Father</option>
                  <option value="aunt">Aunt</option>
                  <option value="uncle">Uncle</option>
                  <option value="elder_sister">Elder Sister</option>
                  <option value="elder_brother">Elder Brother</option>
                </select>
              </div>

              <div class="input-field">
                <label>child Name</label>
                <input
                  type="text"
                  name="parent_child"
                  id="parent_child"
                  placeholder="Enter child number"
                  required
                />
              </div>

              <!-- <div class="input-field">
                <label>Date of Birth</label>
                <input type="date" placeholder="Enter birth date" required />
              </div> -->

              <div class="input-field">
                <label>Email</label>
                <input
                  type="text"
                  name="parent_email"
                  id="parent_email"
                  placeholder="Enter your email"
                  required
                />
              </div>

              <div class="input-field">
                <label>Mobile Number</label>
                <input
                  type="number"
                  name="parent_mobile"
                  id="parent_mobile"
                  placeholder="Enter mobile number"
                  required
                />
              </div>

              <div class="input-field">
                <label> Alternative Mobile Number</label>
                <input
                  type="number"
                  name="alternate_parent_mobile"
                  id="alternate_parent_mobile"
                  placeholder="Enter alternative M N.O"
                  required
                />
              </div>

              <div class="input-field">
                <label>Occupation</label>
                <input
                  type="text"
                  name="parent_job"
                  id="parent_job"
                  placeholder="Enter your ccupation"
                  required
                />
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
                  required
                />
              </div>
              <div class="input-field">
                <label>image</label>
                <input
                  type="file"
                  name="parent_image"
                  id="parent_image"
                  placeholder="Only .jpg and .png allowed"
                  required
                />
              </div>
            </div>
            <button class="nextBtn">
              <span class="btnText">Next</span>
              <i class="uil uil-navigator"></i>
            </button>
          </div>
        </div>
        <div class="form second">
          <div class="details address">
            <span class="title">Username And Password</span>

            <div class="fields">
              <div class="input-field">
                <label>Username</label>
                <input
                  type="text"
                  name="parent_username"
                  id="parent_username"
                  placeholder="create username"
                  required
                />
              </div>

              <div class="input-field">
                <label>Password</label>
                <input
                  type="password"
                  name="parent_password"
                  id="parent_password"
                  placeholder="password"
                  required
                />
              </div>

              <div class="input-field">
                <label>Confirm Password</label>
                <input
                  type="password"
                  name="confirm_password"
                  id="confirm_password"
                  placeholder="confirm password"
                  required
                />
              </div>
            </div>
          </div>

          <div class="details family">
            <div class="buttons">
              <div class="backBtn">
                <i class="uil uil-navigator"></i>
                <span class="btnText">Back</span>
              </div>

              <button class="sumbit">
              <input type="submit" name="action" id="action" class="btnText" value="Add" />
                <span class="btnText">Submit</span>
                <i class="uil uil-navigator"></i>
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <script src="assets/js/script.js"></script>
  </body>
</html>


<script>
$(document).ready(function(){
  function clear_field() {
    $('#parent_form')[0].reset();
  }

  $('#parent_form').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
      url: "parent_action.php",
      method: "POST",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      processData: false,
      success: function(data) {
        if(data.success) {
          
          location.href="index.php";
        
        } else {
          $('#error_confirm_password').text('');
        }
      }
    });
  });
});

</script>