<?php

//attendance.php

include('header.php');

?>

<div class="container" style="margin-top:30px">
  <div class="card">
  	<div class="card-header">
      <div class="row">
        <div class="col-md-9">result List</div>
        <div class="col-md-3" align="right">
          <button type="button" id="report_button" class="btn btn-danger btn-sm">Report</button>
          <button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
        </div>
      </div>
    </div>
  	<div class="card-body">
  		<div class="table-responsive">
        <span id="message_operation"></span>
        <table class="table table-striped table-bordered" id="result_table">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Roll Number</th>
              <th>Total</th>
              <th>Average</th>
              <th>Status</th>
              <th>Rank</th>
            
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
  		</div>
  	</div>
  </div>
</div>

</body>
</html>

<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="css/datepicker.css" />

<style>
    .datepicker
    {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
 
.custom-width {
    width: 100px; /* Adjust the width value as per your requirements */
}

</style>

<?php

$query = "
SELECT * FROM tbl_grade WHERE grade_id = (SELECT teacher_grade_id FROM tbl_teacher 
    WHERE teacher_id = '".$_SESSION["teacher_id"]."')
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

?>

<div class="modal" id="formModal">
  <div class="modal-dialog modal-xl">
    <form method="post" id="result_form">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal_title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <?php
          foreach($result as $row)
          $grade_id = $row["grade_id"];
          {
          ?>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Grade <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <?php
                echo '<label>'.$row["grade_name"].'</label>';
                ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Academic Year<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <select name="acedamic_date" id="acedamic_date" class="form-control">
              <option value="">Select Acedamic Year</option>
                  <option value="2010">2010 E.C</option>
                  <option value="2011">2011 E.C</option>
                  <option value="2012">2012 E.C</option>
                  <option value="2013">2013 E.C</option>
                  <option value="2014">2014 E.C</option>
                  <option value="2015">2015 E.C</option>
                  <option value="2016">2016 E.C</option>
                </select>
                <span id="error_acedamic_date" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Semister<span class="text-danger">*</span></label>
              <div class="col-md-8">
              <select name="semister" id="semister" class="form-control">
              <option value="">Select semister</option>
                  <option value="semister_1">Semister-1</option>
                  <option value="semister_2">Semister-2</option>
                </select>
                <span id="error_semister" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
             <label class="col-md-4 text-right">Student<span class="text-danger">*</span></label>
                 <div class="col-md-8">
                  <select name="student_id" id="student_id" class="form-control">
                     <option value="">Select Student</option>
        <?php
                	$query = "
                  SELECT * FROM tbl_student 	WHERE student_grade_id = '".$row["grade_id"]."'
                  ORDER BY Student_name ASC";
                  
                  $statement = $connect->prepare($query);
                  $statement->execute();
                  $result = $statement->fetchAll();
                  
                  $output = '';
                  foreach($result as $row)
                  {
                    echo'<option value="'.$row["student_id"].'">'.$row["student_name"].'</option>';
                  }
                  
                  
                  ?>
      </select>
      <span id="error_student_id" class="text-danger"></span>
    </div>
  </div>
</div>

          <div class="form-group" id="Subject_details">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                   
                  
                    <th>Mathes</th>
                    <th>Physics</th>
                    <th>English</th>
                    <th>Chemistry</th>
                   
                  </tr>
                </thead>
                      <td>
                <input type="number" name="mathes" id="mathes"  class="form-control custom-width" />
                </td>
        
         <td>
                <input type="number" name="physics" id="physics"  class="form-control custom-width" />
                </td>
         <td>
                <input type="number" name="english" id="english"   class="form-control custom-width"/>
        <td>
                <input type="number" name="chemistry" id="chemistry"  class="form-control custom-width" />
                </td>

                  </tr>
              </table>
            </div>
          </div>
          <div class="form-group" id="Subject_detail">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                   
                    <th>Biology</th>
                     <th>Civic</th>
                    <th>ICT</th>
                    <th>Sport</th>
                   <th>Ethics</th>
                  </tr>
                </thead>
         <td>
                <input type="number" name="biology" id="biology"   class="form-control custom-width"/>
                </td>
         <td>
                <input type="number" name="civic" id="civic"  class="form-control custom-width"/>
                </td>
                <td>
                <input type="number" name="ict" id="ict" class="form-control custom-width" />
                </td>
                <td>
                <input type="number" name="sport" id="sport" class="form-control custom-width" />
                </td>
                <td>
              <select name="ethics" id="ethics" >
              <option value="">Select value</option>
                  <option value="A">A VERY GOOD</option>
                  <option value="B+">B+ GOOD</option>
                  <option value="B">B MEDIUM</option>
                  <option value="C">C NEEDS ATTENTION</option>
                  <option value="D">D SERIOUS PROBLEM</option>
                </select>
                </td>
                  </tr>
              </table>
            </div>
          </div>
              
          <?php
          }
          ?>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="hidden" name="action" id="action" value="Add" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>

      </div>
    </form>
  </div>
</div>

<!--  -->

<script>
$(document).ready(function() {
  var dataTable = $('#result_table').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      url: "result_action.php",
      method: "POST",
      data: { action: "fetch" }
    }
  });

  function clear_field() {
    $('#result_form')[0].reset();
    $('#error_acedamic_date').text('');
    $('#error_semister').text('');
    $('#error_student_id').text('');
  }

  $('#add_button').click(function() {
    $('#modal_title').text("Add Result");
    $('#formModal').modal('show');
    clear_field();
  });

  $('#result_form').on('submit', function(event) {
    event.preventDefault();
    $.ajax({
      url: "result_action.php",
      method: "POST",
      data: $(this).serialize(),
      dataType: "json",
      beforeSend: function() {
        $('#button_action').val('Validate...');
        $('#button_action').attr('disabled', 'disabled');
      },
      success: function(data) {
        $('#button_action').attr('disabled', false);
        $('#button_action').val($('#action').val());
        if (data.success) {
          $('#message_operation').html('<div class="alert alert-success">' + data.success + '</div>');
          clear_field();
          $('#formModal').modal('hide');
          dataTable.ajax.reload();
        }
        if (data.error) {
          if (data.error_acedamic_date != '') {
            $('#error_acedamic_date').text(data.error_acedamic_date);
          } else {
            $('#error_acedamic_date').text('');
          }
          if (data.error_semister != '') {
            $('#error_semister').text(data.error_semister);
          } else {
            $('#error_semister').text('');
          }
          if (data.error_student_id != '') {
            $('#error_student_id').text(data.error_student_id);
          } else {
            $('#error_student_id').text('');
          }
        }
      }
    });
  });
});

</script>