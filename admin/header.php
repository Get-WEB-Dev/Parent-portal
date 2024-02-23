<?php

//header.php

include('database_connection.php');

session_start();

if(!isset($_SESSION["admin_id"]))
{
  header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>hermata secondary school parent portal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>!-->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
  <script src="../js/jquery.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../js/dataTables.bootstrap4.min.js"></script>
  <style>
    nav{
      background:#0099cc;
      color: white;
    }
    .nav-link{
      color:white;
      font-size:20px;
      font-weight:500;
      margin-left:30px;
    }
    
    .navbar-brand,.navbar-toggler{
      color:white;
      font-size:20px;
      font-weight:500;
    }
    .jumbotron-small{
      display:flex;
      align-items:center;
      justify-content:center;
      gap:25px;
    }
    .jumbotron-small p{
      margin-top:10px;
      color:#0099cc;
      font-size:25px;
      font-weight:500;
    }
    .jumbotron-small p span{
      color:#ff6a00;
      margin-top:-10px;
      font-size:23px;
      font-weight:500;
    }
  </style>
</head>
<body>

<div class="jumbotron-small text-center" style="margin-bottom:0">
<p>Hermata Secondary School <br><span>
            Administrator page</span></p><img
                src="..\assets\images\logo.png"
                class="rounded"
                alt="First Vector Graphic"
                style=" width: 90px;"
              />   <p>Hermata Secondary School <br><span>
            Administrator page</span></p>
</div>

<nav class="navbar navbar-expand-sm">
  <a class="navbar-brand" href="../index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon "></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="grade.php">Grade</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="teacher.php">Teacher</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="student.php">Student</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="attendance.php">Attendance</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="subject.php">Subject</a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="parent.php">parent</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>  
    </ul>
  </div>  
</nav>
