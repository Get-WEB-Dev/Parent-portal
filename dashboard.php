<?php
include('head.php');
?>

<?php
$query = "
SELECT * FROM tbl_student
INNER JOIN tbl_grade 
ON tbl_grade.grade_id = tbl_student.student_grade_id 
INNER JOIN tbl_teacher
ON tbl_grade.grade_id = tbl_teacher.teacher_grade_id 
 WHERE student_parent_id = (SELECT parent_id FROM tbl_parent 
    WHERE parent_id = '".$_SESSION["parent_id"]."')
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="wrapper-container" >
        <?php
        foreach ($result as $row) {
            $academicYearsQuery = "SELECT DISTINCT acedamic_year FROM tbl_result WHERE student_id = '".$row["student_id"]."'";
            $academicYearsStatement = $connect->prepare($academicYearsQuery);
            $academicYearsStatement->execute();
            $academicYears = $academicYearsStatement->fetchAll();
        ?>
        <div class="wrapper">
            <div class="left">
                <img src="admin/teacher_image/<?php echo $row["student_image"]; ?>" alt="user" width="100">
                <h4><?php echo $row["student_name"]; ?></h4>
                <p>Grade <?php echo $row["grade_name"]; ?></p>
            </div>
            <div class="right">
                <div class="info">
                    <h3>Information</h3>
                    <div class="info_data">
                        <div class="data">
                            <h4>Name</h4>
                            <p><?php echo $row["student_name"]; ?></p>
                        </div>
                        <div class="data">
                            <h4>Date of Birth</h4>
                            <p><?php echo $row["student_dob"]; ?></p>
                        </div>
                    </div>
                </div>
                <div class="projects">
                    <h3>Section</h3>
                    <div class="projects_data">
                        <div class="data">
                            <h4>Grade</h4>
                            <p>Grade <?php echo $row["grade_name"]; ?></p>
                        </div>
                        <div class="data">
                            <h4>Teacher</h4>
                            <p><?php echo $row["teacher_name"]; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="view-button">
                    <button type="button" onclick="hideShow('<?php echo $row["student_id"]; ?>')" id="viewButton_<?php echo $row["student_id"]; ?>">View Status</button>
                </div>
                </div>
        </div>
 <div class="view-page" id="viewPage_<?php echo $row["student_id"]; ?>" style="display: none;">
                <span class="main_bg"></span>

<!-- ===== ===== Main-Container ===== ===== -->
   <div class="container-1">
    <!-- ===== ===== Header/Navbar ===== ===== -->
    <div class="brand d-flex">
        <div class="brandLogo">
            <figure><img src="assets\images\logo.png" alt="logo" width="40px" height="40px"></figure>
            <span>Student Status Page</span>
        </div>
        </div>

    <!-- ===== ===== User Main-Profile ===== ===== -->
    <section class="userProfile card">
        <div class="profile">
            <figure><img src="admin/teacher_image/<?php echo $row["student_image"]; ?>" alt="profile" width="150px" height="150px"></figure>
        </div>
    </section>

    <!-- ===== ===== Work & Skills Section ===== ===== -->
    <section class="work_skills card">
        <!-- ===== ===== Work Container ===== ===== -->
        <div class="work">
            <h1 class="heading">work</h1>
            <div class="primary">
                <h1>jimma</h1>
                <span>Primary</span>
                <p>hermata primary school <br> kebele 01</p>
            </div>

            <div class="secondary">
                <h1>jimma <br></h1>
                <span>Secondary</span>
                <p>hermata secondary school <br> kebele 01</p>
            </div>
        </div>

        <!-- ===== ===== Skills Container ===== ===== -->
        <div class="skills">
            <h1 class="heading">Skills</h1>
            <ul>
                <li style="--i:0">reading</li>
                <li style="--i:1">listining</li>
                <li style="--i:2">writing</li>
                <li style="--i:3">communicating</li>
            </ul>
        </div>
    </section>

    <!-- ===== ===== User Details Sections ===== ===== -->
    <section class="userDetails card">
        <div class="userName">
            <h1 class="name"><?php echo $row["student_name"]; ?></h1>
            <div class="map">
                <i class="ri-map-pin-fill ri"></i>
                <span>Hermata Secondary School</span>
            </div>
            <p>Grade <?php echo $row["grade_name"]; ?></p>
        </div>

        <div class="rank">
            <h1 class="heading">Roll Number</h1>
            <span><?php echo $row["student_roll_number"]; ?> </span>
        </div>

        <div class="btns">
            <ul>
                <li class="sendMsg">
                    <i class="ri-chat-4-fill ri"></i>
                    <a href="#attendance_table"class="section-link">View Attendance</a>
                </li>

                <li class="sendMsg active">
                    <i class="ri-check-fill ri"></i>
                    <a href="#accordion_" class="section-link2">View Result</a>
                </li>

                <li class="sendMsg">
                    <a href="#" class="section-link">Report User</a>
                </li>
            </ul>
        </div>
    </section>

    <!-- ===== ===== Timeline & About Sections ===== ===== -->
    <section class="timeline_about card">
    <div class="card-body section-container" >
<div class="modal" id="reportModal">
    <div class="modal-body">
        <div class="form-group">
          <div class="input-daterange">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
            <span id="error_from_date" class="text-danger"></span>
            <br />
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
            <span id="error_to_date" class="text-danger"></span>
          </div>
          <button type="submit" class="btn btn-primary">Filter</button>
  
        </div>
     </div>
      
    </div>
    <button type="button" id="report_button" class="btn btn-primary">Filter</button>
    <?php

$query = "
SELECT * FROM tbl_attendance INNER JOIN tbl_teacher 
ON tbl_teacher.teacher_id = tbl_attendance.teacher_id WHERE student_id = '".$row["student_id"]."'
";

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>

  		<div class="table-responsive section-container">
        <table class="table table-striped table-bordered "  id="attendance_table">
          <thead>
            <tr  style="font-siz:15px;">
            <th  style="font-siz:15px;">Attendance Date</th>
              <th>Attendance Status</th>             
              <th>Teacher</th>
            </tr>
          </thead>
          <tbody>
          <?php
        foreach ($result as $row) {
         
        ?>
          <tr>
            <td><?php echo $row["attendance_date"]; ?></td>
              <td><?php echo $row["attendance_status"]; ?></td>             
              <td><?php echo $row["teacher_name"]; ?></td>
            </tr>
            <?php
        }
        ?>
          </tbody>
        </table>
       
  		</div>
  	</div>
    <div class="accordion section-container1" id="accordion_<?php echo $row["student_id"]; ?>">
    <?php
                    foreach ($academicYears as $index => $academicYear) {
                        $tableId = $row["student_id"]."_".$academicYear["acedamic_year"];
                        $collapseId = "collapse_".$tableId;
                        $headingId = "heading_".$tableId;
                        $expanded = ($index === 0) ? 'true' : 'false';

                        // Fetch results for the student and academic year
                        $resultsQuery = "SELECT * FROM tbl_result WHERE student_id = '".$row["student_id"]."' AND acedamic_year = '".$academicYear["acedamic_year"]."'";
                        $resultsStatement = $connect->prepare($resultsQuery);
                        $resultsStatement->execute();
                        $results = $resultsStatement->fetchAll();
                    ?>
                    <div class="card">
                        <div class="card-header" id="<?php echo $headingId; ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $expanded; ?>" aria-controls="<?php echo $collapseId; ?>">
                                    <?php echo $academicYear["acedamic_year"]; ?>
                                </button>
                            </h2>
                        </div>

                        <div id="<?php echo $collapseId; ?>" class="collapse <?php echo ($index === 0) ? 'show' : ''; ?>" aria-labelledby="<?php echo $headingId; ?>" data-parent="#accordion_<?php echo $row["student_id"]; ?>">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                            
              <th>Semister</th>
              <th>Mathes</th>
              <th>Physics</th>
              <th>English</th>
              <th>Chemistry</th>
              <th>Biology</th>
              <th>Civic</th>
              <th>ICT</th>
              <th>Sport</th>
              <th>Ethics</th>
              <th>Total</th>
              <th>Average</th>
              <th>Rank</th>
              <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($results as $result) {
                                            ?>
                                            <tr>
                                                <td><?php echo $result["semister"]; ?></td>
                                                <td><?php echo $result["mathes"]; ?></td>
                                                <td><?php echo $result["physics"]; ?></td>
                                                <td><?php echo $result["english"]; ?></td>
                                                <td><?php echo $result["chemistry"]; ?></td>
                                                <td><?php echo $result["biology"]; ?></td>
                                                <td><?php echo $result["civic"]; ?></td>
                                                <td><?php echo $result["ict"]; ?></td>
                                                <td><?php echo $result["sport"]; ?></td>
                                                <td><?php echo $result["ethics"]; ?></td>
                                                <td><?php echo $result["total"]; ?></td>
                                                <td><?php echo $result["average"]; ?></td>
                                                <td><?php echo $result["rank"]; ?></td>
                                                <td><?php echo $result["status"]; ?></td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                
                </div>
    </section>
</div>
</div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

    </div>
    </div>
   



<script>
  function hideShow(studentId) {
        var div = document.getElementById("viewPage_" + studentId);
        var button = document.getElementById("viewButton_" + studentId);
        if (div.style.display === "none") {
            div.style.display = "block";
            button.innerHTML = "hide student";
        } else {
            div.style.display = "none";
            button.innerHTML = "view student";
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
  var sectionLinks = document.getElementsByClassName('section-link');
  var sectionLinks2 = document.getElementsByClassName('section-link2');
  for (var i = 0; i < sectionLinks.length; i++) {
    sectionLinks[i].addEventListener('click', function(e) {
      e.preventDefault();
      var target = this.getAttribute('href');
      var targetSections = document.getElementsByClassName('section-container');
      for (var j = 0; j < targetSections.length; j++) {
        if (targetSections[j].style.display === 'none') {
          targetSections[j].style.display = 'block';
        } else {
          targetSections[j].style.display = 'none';
        }
      }
    });
  }
  for (var i = 0; i < sectionLinks2.length; i++) {
    sectionLinks2[i].addEventListener('click', function(e) {
      e.preventDefault();
      var target = this.getAttribute('href');
      var targetSections = document.getElementsByClassName('section-container1');
      for (var j = 0; j < targetSections.length; j++) {
        if (targetSections[j].style.display === 'none') {
          targetSections[j].style.display = 'block';
        } else {
          targetSections[j].style.display = 'none';
        }
      }
    });
  }
});


</script>

    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>
  </body>
</html>
<script>
    $(document).ready(function() {
    $('.input-daterange').datepicker({
    todayBtn: "linked",
    format: "yyyy-mm-dd",
    autoclose: true,
    container: '#formModal modal-body'
  });
  $(document).on('click', '#report_button', function(){
    $('#reportModal').modal('show');
  });
    var attendanceTable = $('#attendance_table');
    var rows = attendanceTable.find('tbody tr');

    $('#filter_form').on('submit', function(e) {
      e.preventDefault();
      var startDate = $('#start_date').val();
      var endDate = $('#end_date').val();

      rows.show();

      rows.each(function() {
        var dateCell = $(this).find('td:first-child');
        var date = dateCell.text();
        var currentDate = new Date(date);
        var start = startDate ? new Date(startDate) : null;
        var end = endDate ? new Date(endDate) : null;

        if ((start && currentDate < start) || (end && currentDate > end)) {
          $(this).hide();
        }
      });
    });
  });
  </script>