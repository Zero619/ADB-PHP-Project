<?php
include('include/config.php');


if(isset($_POST['submit2']))
{
    $roomno = $_POST['roomno'];
    $sql=mysqli_query($con," CALL GetPatientNoRoom();");
    
}

if(isset($_POST['submit']))
{
    $roomno = $_POST['rno'];
    $pid = $_POST['pid'];
    //echo "<script>alert('$test $pid');</script>";
    mysqli_next_result($con);
    $sql2=mysqli_query($con,"CALL AddPatientToRoom($pid,$roomno)");
    if($sql2)
    {
    echo "<script>alert('Patient info added Successfully');</script>";
    echo "<script>window.location.href ='manage-room-patient.php?roomno=$roomno'</script>";
    }
    else{
        print mysqli_errno($con);
    }
/*
    $roomno = $_POST['roomno'];
    $pid = $_POST['pid'];
    $sql2=mysqli_query($con," CALL AddPatientToRoom($pid,$roomno);");
    
    if($sql2)
    {
    echo "<script>alert('Patient info added Successfully');</script>";
    echo "<script>window.location.href ='manage-room-patient.php'</script>";
    }
*/
    
}

/*
if(isset($_POST['submit']))
{
  $patientname=$_POST['name'];

$sql=mysqli_query($con,"insert into patient(name,phone,age,gender,address)
                    values('$patientname','$patientphone','$patientage','$patientgender','$patientaddress')");

if($sql)
{
echo "<script>alert('Patient info added Successfully');</script>";
echo "<script>window.location.href ='manage-room-patient.php'</script>";
}
else{
  echo "<script>alert('Patient info added failed');</script>";
}
}
*/
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
                        <h4 class="page-title">Add Patient In Room</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                            <div class="row">
                                <input type="hidden" name='rno' value="<?=$roomno?>"/>
                                <label> Name <span class="text-danger">*</span></label>
                                <select name="pid" required>
                                    <option value="">Select Patient</option>

                                    <?php  while($row=mysqli_fetch_array($sql)){
                                    ?>
                                        <option value="<?=$row['id']?>"> <?=$row['name']?></option>

                                    <?php
                                    }
                                    ?>
                                </select>

                                <div class="m-t-20 text-center">
                                    <button type="submit" name="submit" class="btn btn-primary submit-btn">Add
                                        Patient</button>
                                </div>
                            </div>
                        </form>
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