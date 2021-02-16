<?php

include('include/config.php');

$sql=mysqli_query($con,"select * from room");

$isAvilable;

if(isset($_GET['filter']))
{
  $rType = $_GET['type'];
  $min = $_GET['min'];
  $max = $_GET['max'];
  $sql=mysqli_query($con,"CALL GetRoomByTypeAndPrice('$rType',$min,$max)");
} else{
  $sql=mysqli_query($con,"select * from room");

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
                        <h4 class="page-title">Rooms</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-border table-striped custom-table datatable mb-0">
                                <thead>
                                    <tr>
                                        <th>Room Number</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>No_beds</th>
                                        <th>Avilable</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
										while($row=mysqli_fetch_array($sql))
										{
									?>
                                    <tr>
                                        <td><?=$row['room_no']?></td>
                                        <td><?=$row['room_type']?></td>
                                        <td><?=$row['price']?></td>
                                        <td><?=$row['beds_no']?></td>
                                        <td>
                                            <?php
                                        $roomno = $row['room_no'];
                                        
                                        mysqli_next_result($con);
                                        $queryrooms =  mysqli_query($con,"select CheckRoom($roomno)");
                                        $rowr=mysqli_fetch_row($queryrooms);
                                        if( $rowr[0] == 1){
                                            echo "<span class='custom-badge status-green'>Avilable</span>";
                                            $isAvilable = true;
                                        } else {
                                            echo "<span class='custom-badge status-red'>NOT Avilable</span>";
                                            $isAvilable = false;

                                        }
                                        /*
                                        while($rowr=mysqli_fetch_array($queryrooms))
                                        {
                                            
                                            if( $rowr['r'] == 1){
                                                echo "<span class='custom-badge status-green'>Avilable</span>";
                                                $isAvilable = true;
                                            } else {
                                                echo "<span class='custom-badge status-red'>NOT Avilable</span>";
                                                $isAvilable = false;

                                            }
                                        }
                                            */
                                        ?>

                                        </td>

                                        <td>



                                            <?php
                                                if($isAvilable){

                                            ?>
                                            <form class="dropdown-item" action='add-room-patient.php' method='post'>
                                                <input type="hidden" name='roomno' value=<?= $row['room_no']?> />
                                                <button name="submit2" type='submit'><i class="fa fa-plus"></i> Add Patient
                                            </form>

                                            <!--
                                            <a href="add-room-patient.php" class="dropdown-item">
                                                <i class="fa fa-plus"></i> Add Patient
                                                </a>
                                                -->


                                            <?php
                                                }
                                                ?>

                                            <a class="dropdown-item"
                                                href="manage-room-patient.php?roomno=<?= $row['room_no']?>"><i
                                                    class="fa fa-pencil m-r-5"></i> Manage Room</a>

                                        </td>
                                    </tr>
                                    <?php
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