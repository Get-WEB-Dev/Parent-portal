<?php

//student_action.php

include('database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM tbl_student 
		INNER JOIN tbl_grade 
		ON tbl_grade.grade_id = tbl_student.student_grade_id 
		";

		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			WHERE tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_student.student_dob LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_grade.grade_name LIKE "%'.$_POST["search"]["value"].'%" 
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
			ORDER BY tbl_student.student_id DESC 
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
			$sub_array[] = '<img src="teacher_image/'.$row["student_image"].'" class="img-thumbnail" width="50" />';
			$sub_array[] = $row["student_name"];
			$sub_array[] = $row["student_roll_number"];
			$sub_array[] = $row["student_dob"];
			$sub_array[] = $row["grade_name"];
			$sub_array[] = '<button type="button" name="edit_student" class="btn btn-primary btn-sm edit_student" id="'.$row["student_id"].'">Edit</button>';
			$sub_array[] = '<button type="button" name="delete_student" class="btn btn-danger btn-sm delete_student" id="'.$row["student_id"].'">Delete</button>';
			$data[] = $sub_array;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'tbl_student'),
			"data"				=>	$data
		);

		echo json_encode($output);
	}

	if($_POST["action"] == 'Add' || $_POST["action"] == "Edit")
	{
		$student_name = '';
		$student_roll_number = '';
		$student_dob = '';
		$student_grade_id = '';
		$parent_phone = '';
		$error_student_name = '';
		$error_student_roll_number = '';
		$error_student_dob = '';
		$error_student_grade_id = '';
		$error_parent_phone = '';
		$error_student_image = '';
		$error = 0;
		$student_image = $_POST["hidden_student_image"];
		if($_FILES["student_image"]["name"] != '')
		{
			$file_name = $_FILES["student_image"]["name"];
			$tmp_name = $_FILES["student_image"]["tmp_name"];
			$extension_array = explode(".", $file_name);
			$extension = strtolower($extension_array[1]);
			$allowed_extension = array('jpg','png');
			if(!in_array($extension, $allowed_extension))
			{
				$error_student_image = 'Invalid Image Format';
				$error++;
			}
			else
			{
				$student_image = uniqid() . '.' . $extension;
				$upload_path = 'teacher_image/' . $student_image;
				move_uploaded_file($tmp_name, $upload_path);
			}
		}
		else
		{
			if($student_image == '')
			{
				$error_student_image = 'Image is required';
				$error++;
			}
		}
		if(empty($_POST["student_name"]))
		{
			$error_student_name = 'Student Name is required';
			$error++;
		}
		else
		{
			$student_name = $_POST["student_name"];
		}
		if(empty($_POST["student_roll_number"]))
		{
			$error_student_roll_number = 'Student Roll Number is required';
			$error++;
		}
		else
		{
			$student_roll_number = $_POST["student_roll_number"];
		}
		if(empty($_POST["student_dob"]))
		{
			$error_student_dob = 'Student Date of Birth is required';
			$error++;
		}
		else
		{
			$student_dob = $_POST["student_dob"];
		}
		if(empty($_POST["student_grade_id"]))
		{
			$error_student_grade_id = "Grade is required";
			$error++;
		}
		else
		{
			$student_grade_id = $_POST["student_grade_id"];
		}
		if(empty($_POST["parent_phone"]))
		{
			$error_parent_phone = "parent phone is required";
			$error++;
		}
		else
		{
			$parent_phone = $_POST["parent_phone"];
		}
		if($error > 0)
		{
			$output = array(
				'error'							=>	true,
				'error_student_name'			=>	$error_student_name,
				'error_student_roll_number'		=>	$error_student_roll_number,
				'error_student_dob'				=>	$error_student_dob,
				'error_student_grade_id'		=>	$error_student_grade_id,
				'error_parent_phone'				=>	$error_parent_phone,
				'error_student_image'			=>	$error_student_image
			);
		}
		else
		{
			if($_POST["action"] == 'Add')
			{
				$data = array(
					':student_name'		=>	$student_name,
					':student_roll_number'	=>	$student_roll_number,
					':student_dob'		=>	$student_dob,			
					':student_grade_id'	=>	$student_grade_id,
					':parent_phone'		=>	$parent_phone,
					':student_image'		=>	$student_image
				);
				$query = "
				INSERT INTO `tbl_student` (`student_id`, `student_name`, `student_roll_number`, `student_dob`, `student_grade_id`, `student_parent_id`, `student_image`) 
				VALUES (:student_name, :student_roll_number, :student_dob, :student_grade_id, :parent_phone, :student_image)
				";

				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output = array(
						'success'		=>	'Data Added Successfully',
					);
				}
			}
			if($_POST["action"] == "Edit")
			{
				$data = array(
					':student_name'			=>	$student_name,	
					':student_roll_number'	=>	$student_roll_number,
					':student_dob'			=>	$student_dob,
					':student_grade_id'		=>	$student_grade_id,
					':parent_phone'		=>	$parent_phone,
					':student_image'		=>	$student_image,
					':student_id'			=>	$_POST["student_id"]
				);
				$query = "
				UPDATE tbl_student 
				SET student_name = :student_name, 
				student_roll_number = :student_roll_number, 
				student_dob = :student_dob, 
				student_grade_id = :student_grade_id,
				student_parent_id = :parent_phone,
				student_image = :student_image
				WHERE student_id = :student_id
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

	if($_POST["action"] == "edit_fetch")
	{
		$query = "
		SELECT * FROM tbl_student 
		WHERE student_id = '".$_POST["student_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$output["student_name"] = $row["student_name"];
				$output["student_roll_number"] = $row["student_roll_number"];
				$output["student_dob"] = $row["student_dob"];
				$output["student_grade_id"] = $row["student_grade_id"];
				$output["student_parent_id"] = $row["student_parent_id"];
				$output["student_image"] = $row["student_image"];
				$output["student_id"] = $row["student_id"];
			}
			echo json_encode($output);
		}
	}
	if($_POST["action"] == "delete")
	{
		$query = "
		DELETE FROM tbl_student 
		WHERE student_id = '".$_POST["student_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			echo 'Data Delete Successfully';
		}
	}
}

?>