<?php

include('include/config.php');

$sql=mysqli_query($con,"CALL GetAppointments()");

$havePrescription;

?>


<!DOCTYPE html>
<html lang="en">


<!-- patients23:17-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Preclinic - Medical & Hospital - Bootstrap 4 Admin Template</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Appointments</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>Patient Age</th>
                                        <th>Doctor Name</th>
                                        <th>Specialization</th>
                                        <th>Appointment Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $cnt=1;
										while($row=mysqli_fetch_array($sql))
										{
									?>
                                    <tr>
                                        <td><?=$cnt?></td>
                                        <td><?=$row['patientName']?></td>
                                        <td><?=$row['age']?></td>
                                        <td><?=$row['doctorName']?></td>
                                        <td><?=$row['specialization']?></td>
                                        <td><?=$row['date']?></td>
                                        <td>
                                        <?php
                                        $appid = $row['id'];
                                        
                                        mysqli_next_result($con);
                                        $sql2 =  mysqli_query($con,"select CheckAppPres($appid)");
                                        $row2=mysqli_fetch_row($sql2);
                                        if( $row2[0] == 1){
                                            echo "<span class='custom-badge status-green'>Active</span>";
                                            $havePrescription = true;
                                        } else {
                                            echo "<span class='custom-badge status-red'>Inactive</span>";
                                            $havePrescription = false;

                                        }
                                   
                                        ?>

                                        </td>

                                        <td>



                                            <?php
                                                if($havePrescription){

                                            ?>
                                            <form class="dropdown-item" action='add-prescription.php' method='post'>
                                                <input type="hidden" name='appid' value=<?= $row['id']?> />
                                                <button name="submit" type='submit'><i class="fa fa-plus"></i> Add Prescription
                                            </form>

                                            <?php
                                                }
                                                else {

                                            ?>

                                            <a class="dropdown-item"
                                                href="manage-app-prescription.php?appid=<?= $row['id']?>"><i
                                                    class="fa fa-pencil m-r-5"></i> Manage Prescription</a>

                                            <?php
                                                }
                                            ?>

                                        </td>
                                    </tr>
                                    <?php
                                        $cnt++;
                                    }?>
                                </tbody>
                            </table>
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- patients23:19-->

</html>