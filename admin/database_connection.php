<?php

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=parent_portal","root","");

$base_url = "http://localhost/parent1/";

function get_total_records($connect, $table_name)
{
	$query = "SELECT * FROM $table_name";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}



function load_relation_list($connect)
{
	$query = "
	SELECT * FROM tbl_relation
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["relation_type"].'">'.$row["relation_type"].'</option>';
	}
	return $output;
}

function load_sex_list($connect)
{
	$query = "
	SELECT * FROM tbl_sex
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["sex_type"].'">'.$row["sex_type"].'</option>';
	}
	return $output;
}
function load_grade_list($connect)
{
	$query = "
	SELECT * FROM tbl_grade ORDER BY grade_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["grade_id"].'">'.$row["grade_name"].'</option>';
	}
	return $output;
}
function load_teacher_list($connect)
{
	$query = "
	SELECT * FROM tbl_teacher ORDER BY teacher_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["teacher_id"].'">'.$row["teacher_name"].'</option>';
	}
	return $output;
}

function load_student_list($connect, $grade_id)
{
	$query = "SELECT * FROM tbl_student 
	WHERE student_grade_id = '".$row["grade_id"]."'
	ORDER BY Student_name ASC";
	
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["Student_id"].'">'.$row["Student_name"]. " ---------------" .$row["Student_roll_number"].'</option>';
	}
	
	return $output;
}
function load_subject_list($connect)
{
	$query = "
	SELECT * FROM tbl_subject ORDER BY subject_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["subject_id"].'">'.$row["subject_name"].'</option>';
	}
	return $output;
}
function get_attendance_percentage($connect, $student_id)
{
	$query = "
	SELECT 
		ROUND((SELECT COUNT(*) FROM tbl_attendance 
		WHERE attendance_status = 'Present' 
		AND student_id = '".$student_id."') 
	* 100 / COUNT(*)) AS percentage FROM tbl_attendance 
	WHERE student_id = '".$student_id."'
	";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		if($row["percentage"] > 0)
		{
			return $row["percentage"] . '%';
		}
		else
		{
			return 'NA';
		}
	}
}

function Get_student_name($connect, $student_id)
{
	$query = "
	SELECT student_name FROM tbl_student 
	WHERE student_id = '".$student_id."'
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		return $row["student_name"];
	}
}

function Get_student_grade_name($connect, $student_id)
{
	$query = "
	SELECT tbl_grade.grade_name FROM tbl_student 
	INNER JOIN tbl_grade 
	ON tbl_grade.grade_id = tbl_student.student_grade_id 
	WHERE tbl_student.student_id = '".$student_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['grade_name'];
	}
}

function Get_student_teacher_name($connect, $student_id)
{
	$query = "
	SELECT tbl_teacher.teacher_name 
	FROM tbl_student 
	INNER JOIN tbl_grade 
	ON tbl_grade.grade_id = tbl_student.student_grade_id 
	INNER JOIN tbl_teacher 
	ON tbl_teacher.teacher_grade_id = tbl_grade.grade_id 
	WHERE tbl_student.student_id = '".$student_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["teacher_name"];
	}
}

function Get_grade_name($connect, $grade_id)
{
	$query = "
	SELECT grade_name FROM tbl_grade 
	WHERE grade_id = '".$grade_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["grade_name"];
	}
}

function calculate_student_result($connect, $student_id)
{
	$query = "
	SELECT 
		SUM(subject_marks) AS total_marks,
		COUNT(*) AS total_subjects
	FROM tbl_result
	WHERE student_id = '".$student_id."'
	";

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		if($row["total_subjects"] > 0)
		{
			$percentage = ($row["total_marks"] / ($row["total_subjects"] * 100)) * 100;
			return round($percentage, 2) . '%';
		}
		else
		{
			return 'NA';
		}
	}
}

// function add_subject($connect, $subject_name)
// {
//     $query = "
//     INSERT INTO tbl_subject (subject_name)
//     VALUES (:subject_name)
//     ";

//     $statement = $connect->prepare($query);
//     $statement->bindParam(':subject_name', $subject_name);
//     $result = $statement->execute();

//     if ($result) {
//         return true; // Subject added successfully
//     } else {
//         return false; // Failed to add subject
//     }
// }
?>