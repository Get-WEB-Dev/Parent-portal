<?php

include('head.php');



?>
<div class="view-page">
    <!-- ===== ===== Body Main-Background ===== ===== -->
    <span class="main_bg"></span>


    <!-- ===== ===== Main-Container ===== ===== -->
    <div class="container-1">

        <!-- ===== ===== Header/Navbar ===== ===== -->
        <header>
            <div class="brandLogo">
                <figure><img src="web_logo.jpg" alt="logo" width="40px" height="40px"></figure>
                <span>Student Page</span>
            </div>
        </header>
    

        <!-- ===== ===== User Main-Profile ===== ===== -->
        <section class="userProfile card">
        
            <div class="profile">
                <figure><img src="admin/teacher_image"alt="profile" width="250px" height="250px"></figure>
            </div>
         >
        </section>


        <!-- ===== ===== Work & Skills Section ===== ===== -->
        <section class="work_skills card">

            <!-- ===== ===== Work Contaienr ===== ===== -->
            <div class="work">
                <h1 class="heading">work</h1>
                <div class="primary">
                    <h1>Spotify New York</h1>
                    <span>Primary</span>
                    <p>170 William Street <br> New York, NY 10038-212-315-51</p>
                </div>

                <div class="secondary">
                    <h1>Metropolitan <br> Museum</h1>
                    <span>Secondary</span>
                    <p>S34 E 65th Street <br> New York, NY 10651-78 156-187-60</p>
                </div>
            </div>

            <!-- ===== ===== Skills Contaienr ===== ===== -->
            <div class="skills">
                <h1 class="heading">Skills</h1>
                <ul>
                    <li style="--i:0">Android</li>
                    <li style="--i:1">Web-Design</li>
                    <li style="--i:2">UI/UX</li>
                    <li style="--i:3">Video Editing</li>
                </ul>
            </div>
        </section>


        <!-- ===== ===== User Details Sections ===== ===== -->
        <section class="userDetails card">
            <div class="userName">
                <h1 class="name">Jeremy Rose</h1>
                <div class="map">
                    <i class="ri-map-pin-fill ri"></i>
                    <span>New York, NY</span>
                </div>
                <p>Product Designer</p>
            </div>

            <div class="rank">
                <h1 class="heading">Rankings</h1>
                <span>8,6</span>
                <div class="rating">
                    <i class="ri-star-fill rate"></i>
                    <i class="ri-star-fill rate"></i>
                    <i class="ri-star-fill rate"></i>
                    <i class="ri-star-fill rate"></i>
                    <i class="ri-star-fill rate underrate"></i>
                </div>
            </div>

            <div class="btns">
                <ul>
                    <li class="sendMsg">
                        <i class="ri-chat-4-fill ri"></i>
                        <a href="#">Send Message</a>
                    </li>

                    <li class="sendMsg active">
                        <i class="ri-check-fill ri"></i>
			
                        <a href="#" ><button type="button" name="view_parent" class="btn btn-info btn-sm view_parent" id="view">View</button></a>
                    </li>

                    <li class="sendMsg">
                        <a href="#">Report User</a>
                    </li>
                </ul>
            </div>
        </section>


        <!-- ===== ===== Timeline & About Sections ===== ===== -->
        <section class="timeline_about card">
       
        </section>
    </div>
</div>

<script>
$(document).ready(function(){
	var dataTable = $('#parent_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"admin/parent_action.php",
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
      url:"admin/parent_action.php",
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

  $('#view').click(function(){
    parent_id = $(this).attr('id');
    $.ajax({
      url:"admin/parent_action.php",
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