<?php

//student.php

include('header.php');

?>

<div class="container" style="margin-top:30px">
  <div class="card">
  	<div class="card-header">
      <div class="row">
        <div class="col-md-9 mr-5" >Student List</div>
    
      </div>
    </div>
  	<div class="card-body">
  		<div class="table-responsive">
        	<span id="message_operation"></span>
        	<table class="table table-striped table-bordered" id="student_table">
  				<thead>
  					<tr>
  						<th>Student Name</th>
  						<th>Roll No.</th>
  						<th>Date of Birth</th>
              			<th>Grade</th>
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

<script>
$(document).ready(function(){
	
	var dataTable = $('#student_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"student_action.php",
			method:"POST",
			data:{action:'fetch'},
		}
	});

});
</script>