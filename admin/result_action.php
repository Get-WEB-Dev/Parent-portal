<?php

//result_action.php

include('database_connection.php');

session_start();

if(isset($_POST["action"]))
{
	if($_POST["action"] == "fetch")
	{
		$query = "
		SELECT * FROM tbl_result 
		INNER JOIN tbl_student 
		ON tbl_student.student_id = tbl_result.student_id 
		INNER JOIN tbl_subject 
		ON tbl_subject.subject_id = tbl_teacher.subject
		WHERE tbl_result.teacher_id = '".$_SESSION["teacher_id"]."'
		";

		if(isset($_POST["search"]["value"]))
		{
			$query .= '
			tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_result.activity LIKE "%'.$_POST["search"]["value"].'%" 
			OR tbl_result.quiz LIKE "%'.$_POST["search"]["value"].'%"
      OR tbl_result.assignment LIKE "%'.$_POST["search"]["value"].'%"
      OR tbl_result.project LIKE "%'.$_POST["search"]["value"].'%"
      OR tbl_result.mid_exam LIKE "%'.$_POST["search"]["value"].'%"
      OR tbl_result.final_exam LIKE "%'.$_POST["search"]["value"].'%"
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
			ORDER BY tbl_result.result_id DESC 
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
			$sub_array[] = $row["subject_name"];
      $sub_array[] = $row["activity"];
      $sub_array[] = $row["quiz"];
      $sub_array[] = $row["assignment"];
			$sub_array[] = $row["project"];
      $sub_array[] = $row["mid_exam"];
      $sub_array[] = $row["final_exam"];
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
		$active = '';
    $quiz = '';
    $assignment = '';
    $project = '';
    $mid = '';
    $final = '';
		$error_active = '';
    $error_quiz = '';
    $error_assign = '';
    $error_project = '';
    $error_mid = '';
    $error_final = '';
		$error = 0;
		if(empty($_POST["active"]))
		{
			$error_active = 'active Date is required';
			$error++;
		}
		else
		{
			$active = $_POST["active"];
		}
    if(empty($_POST["quiz"]))
		{
			$error_quiz = 'quiz Date is required';
			$error++;
		}
		else
		{
			$quiz = $_POST["quiz"];
		}
    if(empty($_POST["assignment"]))
		{
			$error_assign = 'assignment Date is required';
			$error++;
		}
		else
		{
			$assignment = $_POST["assignment"];
		}
    if(empty($_POST["project"]))
		{
			$error_project = 'project Date is required';
			$error++;
		}
		else
		{
			$project = $_POST["project"];
		}
    if(empty($_POST["mid"]))
		{
			$error_mid = 'mid Date is required';
			$error++;
		}
		else
		{
			$mid = $_POST["mid"];
		}
    if(empty($_POST["final"]))
		{
			$error_final = 'final Date is required';
			$error++;
		}
		else
		{
			$final = $_POST["final"];
		}

		

            if ($error > 0) {
                $output = array(
                    'error'             => true,
                    'error_active'      => $error_active,
                    'error_quiz'        => $error_quiz,
                    'error_assign'      => $error_assign,
                    'error_project'     => $error_project,
                    'error_mid'         => $error_mid,
                    'error_final'       => $error_final
                );
            } else {
              for($count = 0; $count < count($student_id); $count++) {
                    $data = array(
                        ':student_id'   => $student_id[$count],
                        ':active'       => $active,
                        ':quiz'         => $quiz,
                        ':assignment'   => $assignment,
                        ':project'      => $project,
                        ':mid'          => $mid,
                        ':final'        => $final,
                        ':teacher_id'   => $_SESSION["teacher_id"]
                    );
                    $query = "
                        INSERT INTO tbl_result 
                        (student_id, activity, quiz, assignment, project, mid_exam, final_exam, teacher) 
                        VALUES (:student_id, :active, :quiz, :assignment, :project, :mid, :final, :teacher_id)
                    ";

                  	$statement = $connect->prepare($query);
					$statement->execute($data);
				}
				$output = array(
					'success'		=>	'Data Added Successfully',
				);
                }
            }
            echo json_encode($output);
        }

// 	if($_POST["action"] == "index_fetch")
// 	{
// 		$query = "
// 		SELECT * FROM tbl_result 
// 		INNER JOIN tbl_student 
// 		ON tbl_student.student_id = tbl_result.student_id 
// 		INNER JOIN tbl_subject 
// 		ON tbl_subject.subject_id = tbl_teacher.subject
// 		WHERE tbl_result.teacher_id = '".$_SESSION["teacher_id"]."' AND (
// 		";
// 		if(isset($_POST["search"]["value"]))
// 		{
// 			$query .= '
// 			tbl_student.student_name LIKE "%'.$_POST["search"]["value"].'%" 
// 			OR tbl_student.student_roll_number LIKE "%'.$_POST["search"]["value"].'%" 
// 			OR tbl_result.activity LIKE "%'.$_POST["search"]["value"].'%" 
// 			OR tbl_result.quiz LIKE "%'.$_POST["search"]["value"].'%"
//       OR tbl_result.assignment LIKE "%'.$_POST["search"]["value"].'%"
//       OR tbl_result.project LIKE "%'.$_POST["search"]["value"].'%"
//       OR tbl_result.mid_exam LIKE "%'.$_POST["search"]["value"].'%"
//       OR tbl_result.final_exam LIKE "%'.$_POST["search"]["value"].'%") 
// 			';
// 		}
// 		$query .= 'GROUP BY tbl_student.student_id ';
// 		if(isset($_POST["order"]))
// 		{
// 			$query .= '
// 			ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' 
// 			';
// 		}
// 		else
// 		{
// 			$query .= '
// 			ORDER BY tbl_student.student_roll_number ASC 
// 			';
// 		}

// 		if($_POST["length"] != -1)
// 		{
// 			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
// 		}

// 		$statement = $connect->prepare($query);
// 		$statement->execute();
// 		$result = $statement->fetchAll();
// 		$data = array();
// 		$filtered_rows = $statement->rowCount();
// 		foreach($result as $row)
// 		{
// 			$sub_array = array();
// 			$sub_array[] = $row["student_name"];
// 			$sub_array[] = $row["student_roll_number"];
// 			$sub_array[] = $row["subjec_name"];
//       $sub_array[] = $row["activity"];
//       $sub_array[] = $row["quiz"];
//       $sub_array[] = $row["assignment"];
// 			$sub_array[] = $row["project"];
//       $sub_array[] = $row["mid_exam"];
//       $sub_array[] = $row["final_exam"];
// 			$data[] = $sub_array;
// 		}
// 		$output = array(
// 			'draw'					=>	intval($_POST["draw"]),
// 			"recordsTotal"		=> 	$filtered_rows,
// 			"recordsFiltered"	=>	get_total_records($connect, 'tbl_student'),
// 			"data"				=>	$data
// 		);
// 		echo json_encode($output);
// 	}
// }


?>