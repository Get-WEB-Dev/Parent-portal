<?php

//result_action.php

include('admin/database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM tbl_result 
		INNER JOIN tbl_student 
		ON tbl_student.student_id = tbl_result.student_id 
		WHERE tbl_result.teacher_id = '".$_SESSION["teacher_id"]."' AND (
		";

		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%") 
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
			$sub_array[] = $row["mathes"];
      $sub_array[] = $row["physics"];
      $sub_array[] = $row["english"];
      $sub_array[] = $row["chemistry"];
      $sub_array[] = $row["biology"];
      $sub_array[] = $row["civic"];
      $sub_array[] = $row["ict"];
      $sub_array[] = $row["sport"];
      $sub_array[] = $row["ethics"];
			$sub_array[] = $row["acedamic_year"];
			$sub_array[] = $row["semister"];
			$data[] = $sub_array;
		}

		$output = array(
			'draw'				=>	intval($_POST["draw"]),
			"recordsTotal"		=> 	$filtered_rows,
			"recordsFiltered"	=>	get_total_records($connect, 'tbl_result'),
			"data"				=>	$data
		);

		echo json_encode($output);
	}

	if($_POST["action"] == "Add")
	{
		$acedamic_date = '';
		$error_acedamic_date = '';
		$semister = '';
		$error_semister = '';
		$error = 0;
		if(empty($_POST["acedamic_date"]))
		{
			$error_acedamic_date = 'Academic year is required';
			$error++;
		}
		else
		{
			$acedamic_date = $_POST["acedamic_date"];
		}
	
		if(empty($_POST["semister"]))
		{
			$error_semister = 'Semester is required';
			$error++;
		}
		else
		{
			$semister = $_POST["semister"];
		}
	
		if($error > 0)
		{
			$output = array(
				'error' => true,
				'error_acedamic_date' => $error_acedamic_date,
				'error_semister' => $error_semister
			);
		}
		else
		{
			$mathes = $_POST["mathes"];
			$physics = $_POST["physics"];
			$english = $_POST["english"];
			$chemistry = $_POST["chemistry"];
			$biology = $_POST["biology"];
			$civic = $_POST["civic"];
			$ict = $_POST["ict"];
			$sport = $_POST["sport"];
			$ethics = $_POST["ethics"];

			$student_id = $_POST["student_id"];
			$query = '
			SELECT acedamic_year FROM tbl_result 
			WHERE teacher_id = "'.$_SESSION["teacher_id"].'" 
			AND acedamic_year = "'.$acedamic_date.'"
			';
			$statement = $connect->prepare($query);
			$statement->execute();
			if($statement->rowCount() > 0)
			{
				$output = array(
					'error'					=>	true,
					'error_acedamic_date'	=>	'Attendance Data Already Exists on this date'
				);
			}
		else
		{
			
				$data = array(
					':student_id' => $student_id[$count],
					':acedamic_date' => $acedamic_date,
					':semister' => $semister,
					':mathes' => $mathes,
					':physics' => $physics,
					':english' => $english,
					':chemistry' => $chemistry,
					':biology' => $biology,
					':civic' => $civic,
					':ict' => $ict,
					':sport' => $sport,
					':ethics' => $ethics,
					':teacher_id' => $_SESSION["teacher_id"]
				);
	
				$query = "
					INSERT INTO tbl_result 
					(student_id, acedamic_year, semister, mathes, physics, english, chemistry, biology, civic, ict, sport, ethics, teacher_id) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
					// Prepare the statement
					$statement = $connect->prepare($query);
					
					// Bind the parameters
					$statement->bind_param("sssssssssssss", $acedamic_date, $semister, $student_id, $mathes, $physics, $english, $chemistry, $biology, $civic, $ict, $sport, $ethics, $teacher_id);
					
					// Execute the statement in a loop for each student
					foreach ($student_ids as $index => $student_id) {
							$acedamic_date = $acedamic_date;
							$semister = $semister;
							$student_id = $student_id;
							$mathes = $mathes[$index];
							$physics = $physics[$index];
							$english = $english[$index];
							$chemistry = $chemistry[$index];
							$biology = $biology[$index];
							$civic = $civic[$index];
							$ict = $ict[$index];
							$sport = $sport[$index];
							$ethics = $ethics[$index];
							$teacher_id = $teacher_id;
			
							$statement->execute();
					}
			
					// Close the statement
					$statement->close();
				$statement = $connect->prepare($query);
					$statement->execute($data);
		
		$output = array(
			'success'		=>	'Data Added Successfully',
		);
	}
	
	
}
echo json_encode($output);
}
}
?>