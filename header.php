<?php

//header.php

include('admin/database_connection.php');
session_start();

if(!isset($_SESSION["teacher_id"]))
{
  header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>hermata secondary school teacher page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- ===== ===== Remix Font Icons Cdn ===== ===== -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/templatemo-art-factory.css"
    />
    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap4.min.js"></script>
  <style>
   
   .card-header{
    background:#01dbdf; 
    font-size:21px;
    text-align:center;
    font-weight:700;
    color:white
   }
   nav{
      background:#01dbdf;
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
    .main-nav{
    margin-left:500px;
    }  
    
    
.main-nav li.submenu {
  position: relative;
  padding-right: 35px;
}

.main-nav li.submenu:after {
  font-family: FontAwesome;
  content: "\f107";
  font-size: 12px;
  color: #fff;
  position: absolute;
  right: 18px;
  top: 12px;
}

.header-area.background-header .main-nav li.submenu:after {
  color: #000;
}

.main-nav li.submenu ul {
  position: absolute;
  width: 200px;
  box-shadow: 0 2px 28px 0 rgba(0, 0, 0, 0.06);
  overflow: hidden;
  top: 40px;
  opacity: 0;
  transform: translateY(-2em);
  visibility: hidden;
  z-index: -1;
  transition: all 0.3s ease-in-out 0s, visibility 0s linear 0.3s,
    z-index 0s linear 0.01s;
}

.main-nav li.submenu ul li {
  margin-left: 0px;
  padding-left: 0px;
  padding-right: 0px;
}
.main-nav li.submenu ul li a .name{
  font-size:15px;
  font-weight:700;
  color:white;
}

.main-nav li.submenu ul li a {
  display: block;
  background: #fff;
  color: #3b566e;
  padding-left: 20px;
  height: 40px;
  line-height: 40px;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  position: relative;
  font-size: 13px;
  border-bottom: 1px solid #f5f5f5;
}

.main-nav li.submenu ul li a:before {
  content: "";
  position: absolute;
  width: 0px;
  height: 40px;
  left: 0px;
  top: 0px;
  bottom: 0px;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  background: #f55858;
}

.main-nav li.submenu ul li a:hover {
  background: #fff;
  color: #f55858;
  padding-left: 25px;
}

.main-nav li.submenu ul li a:hover:before {
  width: 3px;
}

.main-nav li.submenu:hover ul {
  visibility: visible;
  opacity: 1;
  z-index: 1;
  transform: translateY(0%);
  transition-delay: 0s, 0s, 0.3s;
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
            Teacher page</span></p><img
                src=".\assets\images\logo.png"
                class="rounded"
                alt="First Vector Graphic"
                style=" width: 90px;"
              />   <p>Hermata Secondary School <br><span>
            Teacher page</span></p>
</div>

<nav class="navbar navbar-expand-sm">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="student.php">student</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="attendance.php">Attendance</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="result.php">Result</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>  
      <div class="main-nav">
 
    <?php $query = "
                            SELECT * FROM tbl_teacher 
                            WHERE teacher_id = '".$_SESSION["teacher_id"]."'
                            ";
                            
                            $statement = $connect->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            
                            ?>
                            <li class="submenu">
                            <?php
          foreach($result as $row)
          {
          ?>
                              <a href="javascript:;"><img src="admin/teacher_image/<?php echo $row['teacher_image']; ?>" class="rounded-circle" alt="profile_pic" width="50" style="border: none;" />
                                  <span class="name" style="  font-size:15px;
  font-weight:700;
  color:white;"><?php
                echo '<label>'.$row["teacher_name"].'</label>';
                ?></span></a>
                                  <?php
                }
                ?>
                                <ul>
                                    
                                    <li><a href="profile.php">Profile</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
              </div>
    </ul>
  </div>  
</nav>