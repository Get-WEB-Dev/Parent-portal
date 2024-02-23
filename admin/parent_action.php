<?php

//parent_action.php

include('database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
    SELECT * FROM tbl_parent
 
		";
		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			WHERE tbl_parent.parent_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_parent.parent_emailid LIKE "%'.$_POST["search"]["value"].'%" 		
			';
		}
		if(isset($_POST["order"]))
		{
			$query .= '
			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].'
			';
		}
		else
		{
			$query .= '
			ORDER BY tbl_parent.parent_id DESC 
			';
		}
		if($_POST["length"] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$data = array();
		$filtered_rows = $statement->rowCount();
		foreach($result as $row)
		{
			$sub_array = array();
			$sub_array[] = '<img src="teacher_image/'.$row["parent_image"].'" class="img-thumbnail" width="50" />';
			$sub_array[] = $row["parent_name"];
			$sub_array[] = $row["parent_emailid"];
			$sub_array[] = $row["sex"];
			$sub_array[] = $row["parent_relation"];
			$sub_array[] = '<button type="button" name="view_parent" class="btn btn-info btn-sm view_parent" id="'.$row["parent_id"].'">View</button>';
			$sub_array[] = '<button type="button" name="edit_parent" class="btn btn-primary btn-sm edit_parent" id="'.$row["parent_id"].'">Edit</button>';
			$sub_array[] = '<button type="button" name="delete_parent" class="btn btn-danger btn-sm delete_parent" id="'.$row["parent_id"].'">Delete</button>';
			$data[] = $sub_array;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'tbl_parent'),
			"data"				=>	$data
		);
		echo json_encode($output);
	}

	if($_POST["action"] == 'Add' || $_POST["action"] == "Edit")
	{
		$parent_name = '';
		$parent_address = '';
		$parent_emailid = '';
		$parent_password = '';
		$parent_sex = '';
		$parent_relation = '';
		$parent_mobile = '';
		$alternate_parent_mobile = '';
		$parent_job = '';
		$parent_doj = '';
		$parent_image = '';
		$error_parent_name = '';
		$error_parent_address = '';
		$error_parent_mobile = '';
		$error_parent_emailid = '';
		$error_parent_password = '';
		$error_parent_sex = '';
		$error_parent_relation = '';
		$error_parent_job = '';
		$error_parent_doj = '';
		$error_parent_image = '';
		$error = 0;

		$parent_image = $_POST["hidden_parent_image"];
		if($_FILES["parent_image"]["name"] != '')
		{
			$file_name = $_FILES["parent_image"]["name"];
			$tmp_name = $_FILES["parent_image"]["tmp_name"];
			$extension_array = explode(".", $file_name);
			$extension = strtolower($extension_array[1]);
			$allowed_extension = array('jpg','png');
			if(!in_array($extension, $allowed_extension))
			{
				$error_parent_image = 'Invalid Image Format';
				$error++;
			}
			else
			{
				$parent_image = uniqid() . '.' . $extension;
				$upload_path = 'teacher_image/' . $parent_image;
				move_uploaded_file($tmp_name, $upload_path);
			}
		}
		else
		{
			if($parent_image == '')
			{
				$error_parent_image = 'Image is required';
				$error++;
			}
		}
		if(empty($_POST["parent_name"]))
		{
			$error_parent_name = 'parent Name is required';
			$error++;
		}
		else
		{
			$parent_name = $_POST["parent_name"];
		}
		if(empty($_POST["parent_address"]))
		{
			$error_parent_address = 'parent Address is required';
			$error++;
		}
		else
		{
			$parent_address = $_POST["parent_address"];
		}
		if($_POST["action"] == "Add")
		{
			if(empty($_POST["parent_emailid"]))
			{
				$error_parent_emailid = 'Email Address is required';
				$error++;
			}
			else
			{
				if(!filter_var($_POST["parent_emailid"], FILTER_VALIDATE_EMAIL))
				{
					$error_parent_emailid = 'Invalid email format';
					$error++;
				}
				else
				{
					$parent_emailid = $_POST["parent_emailid"];
				}
			}
			if(empty($_POST["parent_password"]))
			{
				$error_parent_password = "Password is required";
				$error++;
			}
			else
			{
				$parent_password = $_POST["parent_password"];
			}
		}
		if(empty($_POST["parent_sex"]))
		{
			$error_parent_sex = "sex is required";
			$error++;
		}
		else
		{
			$parent_sex = $_POST["parent_sex"];
		}
		if(empty($_POST["parent_mobile"]))
		{
			$error_parent_mobile = "Mobile number is required";
			$error++;
		}
		else
		{
			$parent_mobile = $_POST["parent_mobile"];
		}
	
		if(empty($_POST["parent_relation"]))
		{
			$error_parent_relation = "relation is required";
			$error++;
		}
		else
		{
			$parent_relation = $_POST["parent_relation"];
		}
		if(empty($_POST["parent_job"]))
		{
			$error_parent_job = 'job Field is required';
			$error++;
		}
		else
		{
			$parent_job = $_POST["parent_job"];
		}
		if(empty($_POST["parent_doj"]))
		{
			$error_parent_doj = 'Date of Join Field is required';
			$error++;
		}
		else
		{
			$parent_doj = $_POST["parent_doj"];
		}
		if($error > 0)
		{
			$output = array(
				'error'							=>	true,
				'error_parent_name'			=>	$error_parent_name,
				'error_parent_address'			=>	$error_parent_address,
				'error_parent_emailid'			=>	$error_parent_emailid,
				'error_parent_password'		=>	$error_parent_password,
				'error_parent_sex'		=>	$error_parent_sex,
				'error_parent_relation'		=>	$error_parent_relation,
				'error_parent_mobile'		=>	$error_parent_mobile,
				'error_parent_job'	=>	$error_parent_job,
				'error_parent_doj'				=>	$error_parent_doj,
				'error_parent_image'			=>	$error_parent_image
			);
		}
		else
		{
			if($_POST["action"] == 'Add')
			{
				$data = array(
					':parent_name'			=>	$parent_name,
					':parent_address'		=>	$parent_address,
					':parent_emailid'		=>	$parent_emailid,
					':parent_password'		=>	password_hash($parent_password, PASSWORD_DEFAULT),
					':parent_job'	=>	$parent_job,
					':parent_doj'			=>	$parent_doj,
					':parent_mobile'			=>	$parent_mobile,
					':alternate_parent_mobile'			=>	$alternate_parent_mobile,
					':parent_image'		=>	$parent_image,
					':parent_sex'		=>	$parent_sex,
					':parent_relation'		=>	$parent_relation
				);
				$query = "
				INSERT INTO tbl_parent 
				(parent_name, parent_address, parent_emailid, parent_password, parent_mobile, Alternate_mobile, parent_job, parent_doj, sex, parent_relation, parent_image) 
				SELECT * FROM (SELECT :parent_name, :parent_address, :parent_emailid, :parent_password,:parent_mobile, :alternate_parent_mobile, :parent_job, :parent_doj,  :parent_sex, :parent_relation, :parent_image) as temp 
				WHERE NOT EXISTS (
					SELECT parent_emailid FROM tbl_parent WHERE parent_emailid = :parent_emailid
				) LIMIT 1
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					if($statement->rowCount() > 0)
					{
						$output = array(
							'success'		=>	'Data Added Successfully',
						);
					}
					else
					{
						$output = array(
							'error'					=>	true,
							'error_parent_emailid'	=>	'Email Already Exists'
						);
					}
				}
			}
			if($_POST["action"] == "Edit")
			{
				$data = array(
					':parent_name'		=>	$parent_name,
					':parent_address'	=>	$parent_address,
					':parent_job'	=>	$parent_job,
					':parent_doj'		=>	$parent_doj,
					':parent_image'	=>	$parent_image,
					':parent_mobile'			=>	$parent_mobile,
					':alternate_parent_mobile'			=>	$alternate_parent_mobile,
					':parent_sex'	=>	$parent_sex,
					':parent_relation'	=>	$parent_relation,
					':parent_id'		=>	$_POST["parent_id"]
				);
				$query = "
				UPDATE tbl_parent 
				SET parent_name = :parent_name, 
				parent_address = :parent_address,
				sex = :parent_sex,   
        parent_relation		=	:parent_relation,
				parent_relation = :parent_relation,
				parent_mobile = :parent_mobile,
				Alternate_mobile = :alternate_parent_mobile, 
				parent_job = :parent_job, 
				parent_doj = :parent_doj, 
				parent_image = :parent_image
				WHERE parent_id = :parent_id
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output = array(
						'success'		=>	'Data Edited Successfully',
					);
				}
			}
		}
		echo json_encode($output);
	}



	if($_POST["action"] == "single_fetch")
	{
		$query = "
		SELECT * FROM tbl_parent 
		WHERE tbl_parent.parent_id = '".$_POST["parent_id"]."'";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$result = $statement->fetchAll();
			$output = '
			<div class="row">
			';
			foreach($result as $row)
			{
				$output .= '
				<div class="col-md-3">
					<img src="teacher_image/'.$row["parent_image"].'" class="img-thumbnail" />
				</div>
				<div class="col-md-9">
					<table class="table">
						<tr>
							<th>Name</th>
							<td>'.$row["parent_name"].'</td>
						</tr>
						<tr>
							<th>Address</th>
							<td>'.$row["parent_address"].'</td>
						</tr>
						<tr>
							<th>Email Address</th>
							<td>'.$row["parent_emailid"].'</td>
						</tr>
						<tr>
						<th>Email Address</th>
						<td>'.$row["parent_mobile"].'</td>
					</tr>
						<tr>
							<th>job</th>
							<td>'.$row["parent_job"].'</td>
						</tr>
						<tr>
							<th>Date of Joining</th>
							<td>'.$row["parent_doj"].'</td>
						</tr>
						<tr>
							<th>sex</th>
							<td>'.$row["sex"].'</td>
						</tr>
						<tr>
							<th>relation</th>
							<td>'.$row["parent_relation"].'</td>
						</tr>
					</table>
				</div>
				';
			}
			$output .= '</div>';
			echo $output;
		}
	}

	if($_POST["action"] == "edit_fetch")
	{
		$query = "
		SELECT * FROM tbl_parent WHERE parent_id = '".$_POST["parent_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$output["parent_name"] = $row["parent_name"];
				$output["parent_address"] = $row["parent_address"];
				$output["parent_mobile"] = $row["parent_mobile"];
				$output["parent_job"] = $row["parent_job"];
				$output["parent_doj"] = $row["parent_doj"];
				$output["parent_image"] = $row["parent_image"];
				$output["sex"] = $row["sex"];
				$output["parent_relation"] = $row["parent_relation"];	
				$output["parent_id"] = $row["parent_id"];
			}
			echo json_encode($output);
		}
	}

	if($_POST["action"] == "delete")
	{
		$query = "
		DELETE FROM tbl_parent 
		WHERE parent_id = '".$_POST["parent_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			echo 'Data Deleted Successfully';
		}
	}
	
}

?>