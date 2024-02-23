<?php

include('admin/database_connection.php');

session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="Template Mo" />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"
      rel="stylesheet"
    />

    <title>Art Factory HTML CSS Template</title>
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!-- ===== ===== Remix Font Icons Cdn ===== ===== -->
    <link rel="stylesheet" href="fonts/remixicon.css">
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/bootstrap.min.css"
    />
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css" />
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/templatemo-art-factory.css"
    />
    <link rel="stylesheet" type="text/css" href="assets/css/owl-carousel.css" />
    <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap4.min.js"></script>
  </head>
<style>
.wrapper-container{
  display:block;
}
.wrapper {
  width:1000px;
  display: flex;
  box-shadow: 0 1px 20px 0 rgba(69, 90, 100, .08);
}

.wrapper .left {
  width: 35%;
  background: linear-gradient(to right, #01a9ac, #01dbdf);
  padding: 30px 25px;
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
  text-align: center;
  color: #fff;
}

.wrapper .left img {
  border-radius: 5px;
  margin-bottom: 10px;
}

.wrapper .left h4 {
  margin-bottom: 10px;
}

.wrapper .left p {
  font-size: 12px;
}

.wrapper .right {
  width: 100%;
  background: #fff;
  padding: 30px 25px;
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}

.wrapper .right .info,
.wrapper .right .projects {
  margin-bottom: 25px;
}

.wrapper .right .info h3,
.wrapper .right .projects h3 {
  margin-bottom: 15px;
  padding-bottom: 5px;
  border-bottom: 1px solid #e0e0e0;
  color: #353c4e;
  text-transform: uppercase;
  letter-spacing: 5px;
}

.wrapper .right .info_data,
.wrapper .right .projects_data {
  display: flex;
  justify-content: space-between;
}

.wrapper .right .info_data .data,
.wrapper .right .projects_data .data {
  width: 45%;
}

.wrapper .right .info_data .data h4,
.wrapper .right .projects_data .data h4 {
  color: #353c4e;
  margin-bottom: 5px;
}

.wrapper .right .info_data .data p,
.wrapper .right .projects_data .data p {
  font-size: 13px;
  margin-bottom: 10px;
  color: #919aa3;
}

.wrapper .view-button{
  width: 150px;
  height: 45px;
  background: linear-gradient(to right, #01a9ac, #01dbdf);
  margin-right: 10px;
  border-radius: 5px;
  text-align: center;
  line-height: 45px;
}

.wrapper .view-button button {
    color:white;
  font-size: 20px;
  font-weight:600;
  border:none;
  width: 150px;
  height: 45px;
  background: linear-gradient(to right, #01a9ac, #01dbdf);
  margin-right: 10px;
  border-radius: 5px;
  text-align: center;
  line-height: 45px;
}
.wrapper .view-button button:hover {
    color:#01dbdf;
  font-size: 21px;
  font-weight:800;
  background:#fff;
    
}
.wrapper .view-button:hover{
    background:#fff;
    width: 180px;
    border:2px solid #01dbdf;
}

.accordion.section-container1{
  display: none;

}
@media (max-width: 750px) {
  .wrapper-container {
    margin-top: 30%;
  }
}
</style>
  <body >
    <!-- ***** Preloader Start ***** -->
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <div class="header-container">
    <header class="header-area mb-4" style="background-color: #01dbdf">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo" style="font-size: 16px">
                            <img src="assets\images\logo.png" class="rounded" alt="First Vector Graphic"
                                style="width: 80px" />
                                <span class="d-none d-sm-inline logo-text" style="color:white;">Hermata Secondary School</span>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section">
                                <a href="index.php" class="active">Home</a>
                            </li>
                            <li class="scroll-to-section">
                                <a href="#">Students</a>
                            </li>
                            <li class="scroll-to-section">
                                <a href="#contact-us">Contact Us</a>
                            </li>
                            <?php $query = "
                            SELECT * FROM tbl_parent 
                            WHERE parent_id = '".$_SESSION["parent_id"]."'
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
                              <a href="javascript:;" style="margin-bottom:10px;"><img src="admin/teacher_image/<?php echo $row['parent_image']; ?>" class="rounded-circle" alt="profile_pic" width="50" style="border:none;" />
                                  <span class="name"><?php
                echo '<label>'.$row["parent_name"].'</label>';
                ?></span></a>
                                  <?php
                }
                ?>
                                <ul>
                                    
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
            </div>