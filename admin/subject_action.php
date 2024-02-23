<?php

//subject_action.php

include('database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM tbl_subject 
		INNER JOIN tbl_teacher 
		ON tbl_teacher.teacher_id = tbl_subject.teacher_id
		";

		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			WHERE tbl_subject.subject_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_subject.subject_code LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_teacher.teacher_name LIKE "%'.$_POST["search"]["value"].'%" 
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
			ORDER BY tbl_subject.subject_id DESC 
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
			$sub_array[] = $row["subject_name"];
			$sub_array[] = $row["subject_code"];
			$sub_array[] = '<img src="teacher_image/'.$row["teacher_image"].'" class="img-thumbnail" width="50" />'.'  '.$row["teacher_name"];
			$sub_array[] = '<button type="button" name="edit_subject" class="btn btn-primary btn-sm edit_subject" id="'.$row["subject_id"].'">Edit</button>';
			$sub_array[] = '<button type="button" name="delete_subject" class="btn btn-danger btn-sm delete_subject" id="'.$row["subject_id"].'">Delete</button>';
			$data[] = $sub_array;
		}
		$output = array(
			"draw"				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'tbl_subject'),
			"data"				=>	$data
		);

		echo json_encode($output);
	}

	if($_POST["action"] == 'Add' || $_POST["action"] == "Edit")
	{
		$subject_name = '';
		$subject_code = '';
		$teacher_id= '';
		$error_subject_name = '';
		$error_subject_code = '';
		$error_teacher_id= '';
		$error = 0;
		if(empty($_POST["subject_name"]))
		{
			$error_subject_name = 'subject Name is required';
			$error++;
		}
		else
		{
			$subject_name = $_POST["subject_name"];
		}
		if(empty($_POST["subject_code"]))
		{
			$error_subject_code = 'subject code is required';
			$error++;
		}
		else
		{
			$subject_code = $_POST["subject_code"];
		}
		if(empty($_POST["teacher_id"]))
		{
			$error_teacher_id= "teacher is required";
			$error++;
		}
		else
		{
			$teacher_id= $_POST["teacher_id"];
		}
		if($error > 0)
		{
			$output = array(
				'error'							=>	true,
				'error_subject_name'			=>	$error_subject_name,
				'error_subject_code'		=>	$error_subject_code,
				'error_teacher_id'		=>	$error_teacher_id
			);
		}
		else
		{
			if($_POST["action"] == 'Add')
			{
				$data = array(
					':subject_name'		=>	$subject_name,
					':subject_code'	=>	$subject_code,
					':teacher_id'	=>	$teacher_id
				);
				$query = "
				INSERT INTO tbl_subject 
				(subject_name, subject_code, teacher_id) 
				VALUES (:subject_name, :subject_code, :teacher_id)
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
					':subject_name'			=>	$subject_name,	
					':subject_code'	=>	$subject_code,
					':teacher_id'		=>	$teacher_id,
					':subject_id'			=>	$_POST["subject_id"]
				);
				$query = "
				UPDATE tbl_subject 
				SET subject_name = :subject_name, 
				subject_code = :subject_code, 
				teacher_id= :teacher_id
				WHERE subject_id = :subject_id
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
		SELECT * FROM tbl_subject 
		WHERE subject_id = '".$_POST["subject_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				$output["subject_name"] = $row["subject_name"];
				$output["subject_code"] = $row["subject_code"];
				// $output["subject_dob"] = $row["subject_dob"];
				$output["teacher_id"] = $row["teacher_id"];
				$output["subject_id"] = $row["subject_id"];
			}
			echo json_encode($output);
		}
	}
	if($_POST["action"] == "delete")
	{
		$query = "
		DELETE FROM tbl_subject 
		WHERE subject_id = '".$_POST["subject_id"]."'
		";
		$statement = $connect->prepare($query);
		if($statement->execute())
		{
			echo 'Data Delete Successfully';
		}
	}
}

?>