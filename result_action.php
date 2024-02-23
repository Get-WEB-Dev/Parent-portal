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
			$sub_array[] = $row["total"];
      $sub_array[] = $row["average"];
      $sub_array[] = $row["status"];
      $sub_array[] = $row["rank"];
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
        $student_id = '';
        $error_student_id = '';
		$error_semister = '';
        $mathes = $_POST["mathes"];
        $physics = $_POST["physics"];
        $english = $_POST["english"];
        $chemistry = $_POST["chemistry"];
        $biology = $_POST["biology"];
        $civic = $_POST["civic"];
        $ict = $_POST["ict"];
        $sport = $_POST["sport"];
        $ethics = $_POST["ethics"];
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
        if(empty($_POST["student_id"]))
		{
			$error_student_id = 'Student  is required';
			$error++;
		}
		else
		{
			$student_id = $_POST["student_id"];

		}

       
		if($error > 0)
		{
			$output = array(
				'error' => true,
				'error_acedamic_date' => $error_acedamic_date,
				'error_semister' => $error_semister,
        'error_student_id' => $error_student_id
			);
		}
		else
		{
			$existingQuery = "SELECT * FROM tbl_result WHERE student_id = :student_id AND acedamic_year = :acedamic_year AND semister = :semister";
			$existingStatement = $connect->prepare($existingQuery);
			$existingStatement->bindParam(':student_id', $student_id);
			$existingStatement->bindParam(':acedamic_year', $acedamic_date);
			$existingStatement->bindParam(':semister', $semister);
			$existingStatement->execute();
			$existingResult = $existingStatement->fetch();
			
			if ($existingResult) {
					$output = array(
							'error' => true,
							'error_student_id' => 'Student result on this semister already exists'
					);
			}
			
			else {

				   $total = $mathes + $physics + $english + $chemistry + $biology + $civic + $ict + $sport;
        $average = $total / 8;
        $status = ($average >= 50) ? "Pass" : "Fail";
				 $rank_query = "SELECT COUNT(*) AS rank FROM tbl_result WHERE semister = ? AND acedamic_year = ? AND average > ?";
        $rank_statement =$connect->prepare($rank_query);
        $rank_statement->execute([$semister, $acedamic_date, $average]);
        $rank_data = $rank_statement->fetch(PDO::FETCH_ASSOC);
        $total_students = $rank_data["rank"];
        $rank = $total_students + 1;

				$data = array(
					':student_id' => $student_id,
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
          ':total' => $total,
          ':average' => $average,
          ':status' => $status,
         ':rank' => $rank,
					':teacher_id' => $_SESSION["teacher_id"]
				);
	
				$query = "
					INSERT INTO tbl_result 
					(student_id, acedamic_year, semister, mathes, physics, english, chemistry, biology, civic, ict, sport, ethics, total, average, status, rank, teacher_id) 
					VALUES (:student_id, :acedamic_date, :semister, :mathes, :physics, :english, :chemistry, :biology, :civic, :ict, :sport, :ethics, :total, :average, :status, :rank,  :teacher_id)
				";
                $statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$output = array(
						'success'		=>	'Data Added Successfully',
					);
				}
			
	}
	
		}
	

 $rank_query = "SELECT student_id, average FROM tbl_result WHERE semister = ? AND acedamic_year = ? ORDER BY average DESC";
$rank_statement = $connect->prepare($rank_query);
$rank_statement->execute([$semister, $acedamic_date]);
$rank_data = $rank_statement->fetchAll(PDO::FETCH_ASSOC);

$rank = 1;
$prev_average = null;
foreach ($rank_data as $row) {
    $student_id = $row['student_id'];
    $average = $row['average'];

    if ($average != $prev_average) {
        $prev_average = $average;
        $update_query = "UPDATE tbl_result SET rank = ? WHERE semister = ? AND acedamic_year = ? AND student_id = ?";
        $update_statement = $connect->prepare($update_query);
        $update_statement->execute([$rank, $semister, $acedamic_date, $student_id]);
    }

    $rank++;
}
echo json_encode($output);
}
	}


?>