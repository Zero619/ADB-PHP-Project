<?php

include('include/config.php');

if(isset($_GET['del']))
		  {
                    $pid=$_GET['id'];
                    $sql =  mysqli_query($con,"CALL DeletePatient($pid)");
                    if($sql)
                    {
                    //echo "<script>alert('filtered');</script>";
                    }
                    else{
                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                    }
		  }
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
                        <h4 class="page-title">Manage Patients</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-patient.php" class="btn btn btn-primary btn-rounded float-right"><i
                                class="fa fa-plus"></i> Add Patient</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
										$sql=mysqli_query($con,"select * from patient");
										$cnt=1;
										while($row=mysqli_fetch_array($sql))
										{
									?>
                                    <tr>
                                        <td><?=$cnt;?></td>
                                        <td><img width="28" height="28" src="assets/img/user.jpg"
                                                class="rounded-circle m-r-5" alt=""><?=$row['name']?></td>
                                        <td><?=$row['phone']?></td>
                                        <td><?=$row['age']?></td>
                                        <td><?=$row['gender']?></td>
                                        <td><?=$row['address']?></td>
                                        <td>



                                        <a class="dropdown-item" href="edit-patient.php?id=<?= $row['id']?>"><i
                                                    class="fa fa-pencil m-r-5"></i> Edit</a>

                                            <a class="dropdown-item"
                                                href="patients.php?id=<?php echo $row['id']?>&del=delete"
                                                onClick="return confirm('Are you sure you want to delete?')"
                                                tooltip-placement="top" tooltip="Remove">

                                                <i class="fa fa-trash-o m-r-5"></i> Delete</a>


                                        </td>
                                    </tr>
                                    <?php 
                       				 $cnt=$cnt+1;
                  					}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="delete_patient" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3>Are you sure want to delete this Patient?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-danger"><a href="test.html">Delete</a></button>
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