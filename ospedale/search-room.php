<?php

include('include/config.php');

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
                        <h4 class="page-title">Fliter Room</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form action="rooms.php" method="get">
                            <div class="row fliter">
                                <div class="col-sm-12">
                                    <div class="form-group col-sm-12">
                                        <label> Type-Room <span class="text-danger">*</span></label><br>
                                        <select name="type" class="type-room">
                                            <option value="Normal">Normal</option>
                                            <option value="VIP">VIP</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Min Price <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" required name="min">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Max Price<span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" required name="max">
                                    </div>
                                </div>

                            </div>

                            <div class="m-t-20">
                                <button type="submit" name="filter" value="filter" class="btn btn-primary submit-btn ">Fliter Room</button>
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