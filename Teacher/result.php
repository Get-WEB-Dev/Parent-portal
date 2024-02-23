<?php

//attendance.php

include('header.php');

?>

<div class="container" style="margin-top:30px">
  <div class="card">
  	<div class="card-header">
      <div class="row">
        <div class="col-md-9">Attendance List</div>
        <div class="col-md-3" align="right">
          <!-- <button type="button" id="report_button" class="btn btn-danger btn-sm">Report</button> -->
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
              <th>Activity</th>
              <th>quiz</th>
              <th>Assignment</th>
              <th>project</th>
              <th>Mid-exam</th>
              <th>final-exam</th>
              <!-- <th>Edit</th> -->
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
</style>

<!-- <?php
$query = "
    SELECT * FROM tbl_subject 
    WHERE subject_id = (
        SELECT subject FROM tbl_teacher 
        WHERE teacher_id = '".$_SESSION["teacher_id"]."'
    )
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?> -->

<div class="modal" id="formModal">
  <div class="modal-dialog">
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
          {
          ?>
           <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Activities<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="active" id="active" class="form-control"  />
                <span id="error_active" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Quiz<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="quiz" id="quiz" class="form-control"  />
                <span id="error_quiz" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Assignment<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="assignment" id="assign" class="form-control"  />
                <span id="error_assign" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Project<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="project" id="project" class="form-control"  />
                <span id="error_project" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Mid-Exam<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="mid" id="mid" class="form-control"  />
                <span id="error_mid" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Final-Exam<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="txt" name="final" id="final" class="form-control" />
                <span id="error_final" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group" id="student_details">
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Roll No.</th>
                    <th>Student Name</th>
                  </tr>
                </thead>
                <!-- <?php
                $sub_query = "
                SELECT * FROM tbl_student 
                INNER JOIN tbl_teacher ON tbl_teacher.subject = '".$row["subject_name"]."'
                WHERE tbl_teacher.teacher_id = '".$_SESSION["teacher_id"]."
                ";
                $statement = $connect->prepare($sub_query);
                $statement->execute();
                $student_result = $statement->fetchAll();
                foreach($student_result as $student)
                {
                ?> -->
                  <tr>
                    <td><?php echo $student["student_roll_number"]; ?></td>
                    <td>
                      <?php echo $student["student_name"]; ?>
                      <input type="hidden" name="student_id[]" value="<?php echo $student["student_id"]; ?>" />
                    </td>
                  </tr>
                <?php
                }
                ?>
              </table>
            </div>
          </div>
          <?php
          }
          ?>
        </div>

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

<!-- <div class="modal" id="reportModal">
  <div class="modal-dialog">
    <div class="modal-content">

      Modal Header
      <div class="modal-header">
        <h4 class="modal-title">Make Report</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <!-- <div class="modal-body">
        <div class="form-group">
          <div class="input-daterange">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"  />
            <span id="error_from_date" class="text-danger"></span>
            <br />
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"  />
            <span id="error_to_date" class="text-danger"></span>
          </div>
        </div>
      </div> -->
      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" name="create_report" id="create_report" class="btn btn-success btn-sm">Create Report</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div> -->

<script>
$(document).ready(function(){
	
  var dataTable = $('#result_table').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"result_action.php",
      method:"POST",
      data:{action:"fetch"}
    }
  });
  function clear_field()
  {
    $('#result_form')[0].reset();
    $('#error_active').text('');
    $('#error_quiz').text('');
    $('#error_assign').text('');
    $('#error_project').text('');
    $('#error_mid').text('');
    $('#error_final').text('');
  }

  $('#add_button').click(function(){
    $('#modal_title').text("Add Result");
    $('#formModal').modal('show');
    clear_field();
  });

  $('#result_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"result_action.php",
      method:"POST",
      data:$(this).serialize(),
      dataType:"json",
      beforeSend:function(){
        $('#button_action').val('Validate...');
        $('#button_action').attr('disabled', 'disabled');
      },
      success:function(data)
      {
        $('#button_action').attr('disabled', false);
        $('#button_action').val($('#action').val());
        if(data.success)
        {
          $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
          clear_field();
          $('#formModal').modal('hide');
          dataTable.ajax.reload();
        }
        if(data.error)
        {
          if(data.error_active != '')
          {
            $('#error_active').text(data.error_active);
          }
          else
          {
            $('#error_active').text('');
          }
          if(data.error_quiz != '')
          {
            $('#error_quiz').text(data.error_quiz);
          }
          else
          {
            $('#error_quiz').text('');
          }
          if(data.error_assign != '')
          {
            $('#error_assign').text(data.error_assign);
          }
          else
          {
            $('#error_assign').text('');
          }
          if(data.error_project != '')
          {
            $('#error_project').text(data.error_project);
          }
          else
          {
            $('#error_project').text('');
          }
          if(data.error_mid != '')
          {
            $('#error_mid').text(data.error_mid);
          }
          else
          {
            $('#error_mid').text('');
          }
          if(data.error_final != '')
          {
            $('#error_final').text(data.error_final);
          }
          else
          {
            $('#error_final').text('');
          }
        }
      }
    })
  });
});
</script>