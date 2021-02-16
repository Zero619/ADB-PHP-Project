<?php
include('include/config.php');



if(isset($_POST['submit']))
{
    $specialization = $_POST['specializations'];
    //echo "<script>alert('$specialization');</script>";
    $sql=mysqli_query($con,"CALL SelectDoctorBySpecifcation('$specialization')");
}

if(isset($_POST['submit2']))
{
    $did = $_POST['did'];
    $date = $_POST['date'];
    $pid = $_POST['pid'];
    $description = $_POST['description'];

    mysqli_next_result($con);
    $sql=mysqli_query($con,"insert into appointment(description,date,p_id,d_id) values ('$description','$date','$pid',$did)");


     $sql=mysqli_query($con,"CALL SelectDoctorBySpecifcation('dentist')");
    if($sql){
        echo "<script>alert('Appointment info added Successfully');</script>";
        echo "<script>window.location.href ='appointments.php'</script>";
    } else {
        echo "<script>alert('Appointment info added failed');</script>";
    }
    
}



?>

<!DOCTYPE html>
<html lang="en">


<!-- add-patient24:06-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <?php include('include/sidebar.php');?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Appointment</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                            <div class="row">


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Doctors Name <span class="text-danger">*</span></label>
                                        <select class="form-control" required name="did">
                                            <option value="">Select Doctor</option>

                                            <?php  while($row=mysqli_fetch_array($sql)){
                                            ?>
                                            <option value="<?=$row['id']?>"><?=$row['name']?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Patient Name <span class="text-danger">*</span></label>
                                        <select class="form-control" required name="pid">
                                            <option value="">Select Patient</option>

                                            <?php 
                                            mysqli_next_result($con);
                                            $s = mysqli_query($con,"SELECT id , name FROM patient");
                                            while($r=mysqli_fetch_array($s)){
                                            ?>
                                            <option value="<?=$r['id']?>"><?=$r['name']?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Date <span class="text-danger">*</span></label>
                                        <input class="form-control" type="date" required name="date">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> description <span class="text-danger">*</span></label>
                                        <textarea name="description" cols="40" row="60"></textarea>
                                    </div>

                                </div>



                            </div>

                            <div class="m-t-20 text-center">
                                <button type="submit" name="submit2" class="btn btn-primary submit-btn">Create Appointment </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- add-patient24:07-->

</html>