<?php
include('include/config.php');


if(isset($_GET['prid']))
{
    $prid = $_GET['prid'];
    $appid = $_GET['appid'];
    $sql=mysqli_query($con,"SELECT * from medicine");
    
}

if(isset($_POST['submit']))
{
    $appid = $_POST['appid'];

    $prid = $_POST['prid'];
    $mid = $_POST['mid'];
    $count = $_POST['count'];
    $note = $_POST['note'];
  

    
    mysqli_next_result($con);
    $sql2=mysqli_query($con,"CALL AddPrescriptionMedicine($prid,$mid,$count,'$note')");
    if($sql2)
    {
    echo "<script>alert('Medicine Added Successfully');</script>";
    echo "<script>window.location.href ='manage-app-prescription.php?appid=$appid'</script>";
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
                        <h4 class="page-title">Add Medicine In Prescription</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST">
                            <div class="row">
                                <input type="hidden" name='prid' value="<?=$prid?>"/>
                                <input type="hidden" name='appid' value="<?=$appid?>"/>
                                <label> Medicine Name <span class="text-danger">*</span></label>
                                <select name="mid" required>
                                    <option value="">Select Medicine</option>

                                    <?php  while($row=mysqli_fetch_array($sql)){
                                    ?>
                                        <option value="<?=$row['id']?>"> <?=$row['name']?></option>

                                    <?php
                                    }
                                    ?>
                                </select>
                                <label> Count <span class="text-danger">*</span></label>
                                <input type="number" name='count'/>

                                <label> Note <span class="text-danger">*</span></label>
                                <input type="text" name='note'/>

                                <div class="m-t-20 text-center">
                                    <button type="submit" name="submit" class="btn btn-primary submit-btn">Add
                                        Medicine</button>
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