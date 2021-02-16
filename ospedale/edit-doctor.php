<?php
include('include/config.php');

$did=intval($_GET['id']);// get doctor id

$sql=mysqli_query($con,"select * from doctor where id='$did'");
$data=mysqli_fetch_array($sql);

if(isset($_POST['submit']))
{
  $doctorname=$_POST['name'];
  $doctorgender=$_POST['gender'];
  $doctorphone=$_POST['phone'];
  $doctoradress=$_POST['address'];
  $doctorspecialization=$_POST['specialization'];

$sql=mysqli_query($con,"update doctor set name='$doctorname',gender='$doctorgender',phone='$doctorphone',address='$doctoradress',specialization='$doctorspecialization' where id='$did'");

if($sql)
{
echo "<script>alert('Doctor Info Updated Successfully');</script>";
echo "<script>window.location.href ='doctors.php'</script>";
}
else{
  echo "<script>alert('Doctor Info Update Failed!');</script>";
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
                        <h4 class="page-title">Update Doctor</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="post">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label> Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required name="name" value="<?php echo htmlentities($data['name']);?>"><br>
                                    </div>
                                    <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender: <span class="text-danger">*</span></label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="male" class="form-check-input" required>Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" value="female" class="form-check-input" required>Female
											</label>
										</div>
									</div>
                                </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required name="phone" value="<?php echo htmlentities($data['phone']);?>">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"required name="address" value="<?php echo htmlentities($data['address']);?>">
                                    </div>
                                </div>
                                </div>
                            
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Specialization <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required name="specialization" value="<?php echo htmlentities($data['specialization']);?>">
                                    </div>
                                </div>
								
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn" name="submit">Update Doctor</button>
                            </div>
                        </form>
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
