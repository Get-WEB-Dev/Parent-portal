<?php

//student.php

include('header.php');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>School Grading System</title>
    <style media="screen">
      body{
        background-color:white;
      }
      .myform{
        text-align: center;
        position:absolute;
        top:25%;
        width:70%;
        font-family:century gothic;
        color:aqua;
      }
      input{
        background-color:transparent;
        border:1px solid grey;
        width:25%;
        padding:10px;
        color:white;
        font:14px century gothic;
        border-radius:5px;
      }
      input:focus{
        border:none;
	      border:2px solid white;
	      outline:none !important;
      }
      input:active{
	      border:none;
        border:1px solid transparent;
       }
      .button{
        cursor:pointer;
      }
      .button:hover{
        background-color:white;
        color:black;
      }
      .errs{
        font-family:monospace;
        position:absolute;
        text-align: right;
        top:40%;
        background-color:#fff;
        color:#000;
        width:25%;
        padding:1%;
        border-radius:5px;
        margin:5%;
      }
      .errs p{
        text-align: left;
      }
      .reveal{
        color:blue;
        position: absolute;
        top:100%;
        font-family:century gothic;
        text-align: center;
      }
      table{
        padding:5%;
      }
      td{
        padding:2%;
        width:5%;
      }
    </style>
  </head>
  <body>
  <div class="container" style="margin-top:30px">
  <div class="card">
  	<div class="card-header">
      <div class="row">
        <div class="col-md-9">Subject List</div>
        <div class="col-md-3" align="right">
        	<button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
        </div>
      </div>
    </div>
  	<div class="card-body">
  		<div class="table-responsive">
        	<span id="message_operation"></span>
        	<table class="table table-striped table-bordered" id="subject_table">
  				<thead>
  					<tr>
            <th>Student</th>
          <th>quiz</th>
          <th>assignment</th>
          <th>project</th>
          <th>mid</th>
          <th>final</th>
          <th>Total(%)</th>
          <th>Grade</th>
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
    <div class="myform">
      <h1>School Grading System</h1>
      <form class="gsystem" action="" method="post">
      <div class="form-group">
    <div class="row">
      <label class="col-md-4 text-right">Activities<span class="text-danger">*</span></label>
      <div class="col-md-8">
        <input type="text" name="active" id="active" class="form-control" />
        <span id="error_active" class="text-danger"></span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class="col-md-4 text-right">Quiz<span class="text-danger">*</span></label>
      <div class="col-md-8">
        <input type="text" name="quiz" id="quiz" class="form-control" />
        <span id="error_quiz" class="text-danger"></span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class="col-md-4 text-right">Assignment<span class="text-danger">*</span></label>
      <div class="col-md-8">
        <input type="text" name="assignment" id="assign" class="form-control" />
        <span id="error_assign" class="text-danger"></span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class="col-md-4 text-right">Project<span class="text-danger">*</span></label>
      <div class="col-md-8">
        <input type="text" name="project" id="project" class="form-control" />
        <span id="error_project" class="text-danger"></span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class="col-md-4 text-right">Mid-Exam<span class="text-danger">*</span></label>
      <div class="col-md-8">
        <input type="text" name="mid" id="mid" class="form-contro" />
        <span id="error_mid" class="text-danger"></span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class="col-md-4 text-right">Final-Exam<span class="text-danger">*</span></label>
      <div class="col-md-8">
        <input type="text" name="final" id="final" class="form-control" />
        <span id="error_final" class="text-danger"></span>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row">
      <label class="col-md-4 text-right">Final-Exam<span class="text-danger">*</span></label>
      <div class="col-md-8">
        <input type="text" name="final" id="final" class="form-control"  />
        <span id="error_final" class="text-danger"></span>
      </div>
    </div>
  </div>
        <input  class="button" type="submit" name="submit" value="submit"><br>
      </form>

<!-- Modal body -->
      <div class="errs">
      <?php
      /*
      Grading system
      By Evans Wanjau
      */
      //Assigning variables
      if (isset($_POST['submit'])){

        function test_input($data) {
	         $data = trim($data);
	         $data = stripslashes($data);
	         $data = htmlspecialchars($data);
	         return $data;
	      }

        //Variables
        $nameErr = $quizErr = $assignmentErr = $projectErr = $midErr = $finalErr = "";
        $name = $quiz = $assignment = $project = $mid = $final = "";

        //Students name assignment
        if(empty($_POST['name'])){
          $nameErr = "<p>You have not entered a students name</p>";
        }else {
          $name = test_input($_POST['name']);
        }

        //quiz
        if(empty($_POST['quiz'])){
          $quizErr = "<p>You have not entered quiz marks</p>";
        }else {
          $quiz = test_input(intval($_POST['quiz']));
        }

        //assignment
        if(empty($_POST['assignment'])){
          $assignmentErr = "<p>You have not entered assignment marks</p>";
        }else {
          $assignment = test_input(intval($_POST['assignment']));
        }

        //project marks
        if(empty($_POST['project'])){
          $projectErr = "<p>You have not entered project marks</p>";
        }else {
          $project = test_input(intval($_POST['project']));
        }

        //mid marks
        if(empty($_POST['mid'])){
          $midErr = "<p>You have not entered mid marks</p>";
        }else {
          $mid = test_input(intval($_POST['mid']));
        }

        //final marks
        if(empty($_POST['final'])){
          $finalErr = "<p>You have not entered final marks</p>";
        }else {
          $final = test_input(intval($_POST['final']));
        }

        $m = ($quiz * 100) / 50;
        $e = ($assignment * 100) / 50;
        $s = ($project * 100) / 50;
        $sc = ($mid * 100) / 50;
        $ss = ($final * 100) / 50;

        $total = $m + $e + $s + $sc + $ss;
        $t = ($total * 100) / 500;
        //Grading system
        function getGrade($value){
            if($value >= 80 && $value <= 100){
              $grade = 'A - Excellent';
            }
            elseif ($value >= 60 && $value < 80) {
              $grade = 'B - Very Good';
            }
            elseif ($value >= 40 && $value < 60) {
              $grade = 'C - Good';
            }
            elseif ($value >= 20 && $value < 40) {
              $grade = 'D - Fail';
            }
            elseif ($value >= 0 && $value < 20) {
              $grade = 'E - Jembe';
            }
            else {
              $grade = 'X - You did not do the exam';
            }
          return $grade;
          }

          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "db";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $grade = getGrade($t);

          if($name == true){
            $sql = "INSERT INTO students (name, quiz, assignment, project, mid, final, total, grade)
            VALUES ('$name', '$quiz', '$assignment', '$project', '$mid', '$final', '$t', '$grade')";

            if ($conn->query($sql) === TRUE) {
              echo "<p>Student: " . $name . '</p>';
              echo '<p>quiz: '. $m . '</p><p>assignment: ' . $e . '</p><p>project: ' . $s .'</p><p>mid: '. $sc . '</p><p>final: ' . $ss . '</p>';
              echo '<p>' . intval($t) . '% ' . $grade . '</p>';
            }else{
              echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }else{
            echo $nameErr;
            echo $quizErr;
            echo $assignmentErr;
            echo $projectErr;
            echo $midErr;
            echo $finalErr;
          }


      }
       ?>
     </div>
    </div>
    <div class="reveal">
      <h1>Student's results</h1>
      <table border="1">
        <tr>
          <th>Student</th>
          <th>quiz</th>
          <th>assignment</th>
          <th>project</th>
          <th>mid</th>
          <th>final</th>
          <th>Total(%)</th>
          <th>Grade</th>
        </tr>
      <?php

      $sql2 = "SELECT * FROM students ORDER BY `total` DESC";
      $result = $conn->query($sql2);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["name"] . "</td><td>" . $row["quiz"] . "</td><td>" . $row["assignment"] . "</td><td>" . $row["project"] . "</td><td>" . $row["mid"] . "</td><td>" . $row["final"] . "</td><td>" . $row["total"] . "</td><td>" . $row["grade"] . "</td></tr>";
      }
    }else{
        echo "No data to display";
      }

       ?>

     </table>
    </div>
  </body>
</html>
