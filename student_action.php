<?php

//student_action.php

include('admin/database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM tbl_student 
		INNER JOIN tbl_grade 
		ON tbl_grade.grade_id = tbl_student.student_grade_id 
		INNER JOIN tbl_teacher
		ON tbl_grade.grade_id = (SELECT teacher_grade_id FROM tbl_teacher 
    WHERE teacher_id = '".$_SESSION["teacher_id"]."')

		";

		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			WHERE tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_student.student_dob LIKE "%'.$_POST["search"]["value"].'%" 
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

}

?>