<?php

include('header.php');

?>

<div class="container" style="margin-top:30px">
  <div class="card">
  	<div class="card-header">
      <div class="row">
        <div class="col-md-9">parent List</div>
        <div class="col-md-3" align="right">
          <button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
        </div>
      </div>
    </div>
  	<div class="card-body">
  		<div class="table-responsive">
        <span id="message_operation"></span>
  			<table class="table table-striped table-bordered" id="parent_table">
  				<thead>
  					<tr>
  						<th>Image</th>
  						<th>parent Name</th>
  						<th>Email Address</th>
              <th>sex</th>
              <th>relation</th>
  						<th>View</th>
  						<th>Edit</th>
  						<th>Delete</th>
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

<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="../css/datepicker.css" />

<style>
    .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>

<div class="modal" id="formModal">
  <div class="modal-dialog">
    <form method="post" id="parent_form" enctype="multipart/form-data">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal_title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">parent Name <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="parent_name" id="parent_name" class="form-control" />
                <span id="error_parent_name" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Address <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <textarea name="parent_address" id="parent_address" class="form-control"></textarea>
                <span id="error_parent_address" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Email Address <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="parent_emailid" id="parent_emailid" class="form-control" />
                <span id="error_parent_emailid" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Password <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="password" name="parent_password" id="parent_password" class="form-control" />
                <span id="error_parent_password" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">mobile<span class="text-danger">*</span></label>
              <div class="col-md-8">
              <input
                  type="number"
                  name="parent_mobile"
                  id="parent_mobile"
                  placeholder="Enter mobile number"
                  class="form-control"
                />
                <span id="error_parent_mobile" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">alternate <span class="text-danger">*</span></label>
              <div class="col-md-8">
              <input
                  type="number"
                  name="alternate_parent_mobile"
                  id="alternate_parent_mobile"
                  placeholder="Enter alternative M N.O"
                  class="form-control"
                />
                <span class="text-primary">It is advicable if you put alternative Mobile number</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">job <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="parent_job" id="parent_job" class="form-control" />
                <span id="error_parent_job" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">sex <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <select name="parent_sex" id="parent_sex" class="form-control">
                  <option value="">Select sex</option>
                  <?php
                  echo load_sex_list($connect);
                  ?>
                </select>
                <span id="error_parent_sex" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">relation <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <select name="parent_relation" id="parent_relation" class="form-control">
                  <option value="">Select relation</option>
                  <?php
                  echo load_relation_list($connect);
                  ?>
                </select>
                <span id="error_parent_relation" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Date of Joining <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="parent_doj" id="parent_doj" class="form-control" />
                <span id="error_parent_doj" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <label class="col-md-4 text-right">Image <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="file" name="parent_image" id="parent_image" />
                <span class="text-muted">Only .jpg and .png allowed</span><br />
                <span id="error_parent_image" class="text-danger"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="hidden" name="hidden_parent_image" id="hidden_parent_image" value="" />
          <input type="hidden" name="parent_id" id="parent_id" />
          <input type="hidden" name="action" id="action" value="Add" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Add" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
        </div>

      </div>
    </form>
  </div>
</div>

<div class="modal" id="viewModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">parent Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="parent_details">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Delete Confirmation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 align="center">Are you sure you want to remove this?</h3>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="button" name="ok_button" id="ok_button" class="btn btn-primary btn-sm">OK</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script>
$(document).ready(function(){
	var dataTable = $('#parent_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"parent_action.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 4, 5, 6],
				"orderable":false,
			},
		],
	});

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
    $('#error_parent_emailid').text('');
    $('#error_parent_mobile').text('');
   
    $('#error_parent_password').text('');
    $('#error_parent_job').text('');
    $('#error_parent_doj').text('');
    $('#error_parent_image').text('');
    $('#error_parent_sex').text('');
    $('#error_parent_relation').text('');
  }

  $('#add_button').click(function(){
    $('#modal_title').text("Add parent");
    $('#button_action').val('Add');
    $('#action').val('Add');
    $('#formModal').modal('show');
    clear_field();
  });

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
          $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
          clear_field();
          $('#formModal').modal('hide');
          dataTable.ajax.reload();
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
          if(data.error_parent_mobile != '')
          {
            $('#error_parent_mobile').text(data.error_parent_mobile);
          }
          else
          {
            $('#error_parent_mobile').text('');
          }
          if(data.error_parent_sex != '')
          {
            $('#error_parent_sex').text(data.error_parent_sex);
          }
          else
          {
            $('#error_parent_sex').text('');
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

  var parent_id = '';

  $(document).on('click', '.view_parent', function(){
    parent_id = $(this).attr('id');
    $.ajax({
      url:"parent_action.php",
      method:"POST",
      data:{action:'single_fetch', parent_id:parent_id},
      success:function(data)
      {
        $('#viewModal').modal('show');
        $('#parent_details').html(data);
      }
    });
  });

  $(document).on('click', '.edit_parent', function(){
  	parent_id = $(this).attr('id');
  	clear_field();
  	$.ajax({
  		url:"parent_action.php",
  		method:"POST",
  		data:{action:'edit_fetch', parent_id:parent_id},
  		dataType:"json",
  		success:function(data)
  		{
  			$('#parent_name').val(data.parent_name);
  			$('#parent_address').val(data.parent_address);
  			$('#parent_relation').val(data.parent_relation);
        $('#parent_sex').val(data.parent_sex);
  			$('#parent_job').val(data.parent_job);
  			$('#parent_doj').val(data.parent_doj);
  			$('#error_parent_image').html('<img src="parent_image/'+data.parent_image+'" class="img-thumbnail" width="50" />');
  			$('#hidden_parent_image').val(data.parent_image);
  			$('#parent_id').val(data.parent_id);
  			$('#modal_title').text('Edit parent');
  			$('#button_action').val('Edit');
  			$('#action').val('Edit');
  			$('#formModal').modal('show');
  		}
  	});
  });

  $(document).on('click', '.delete_parent', function(){
  	parent_id = $(this).attr('id');
  	$('#deleteModal').modal('show');
  });

  $('#ok_button').click(function(){
  	$.ajax({
  		url:"parent_action.php",
  		method:"POST",
  		data:{parent_id:parent_id, action:'delete'},
  		success:function(data)
  		{
  			$('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
  			$('#deleteModal').modal('hide');
  			dataTable.ajax.reload();
  		}
  	})
  });

});
</script>