        <div class="header">
            <div class="header-left">
                <a href="index-2.html" class="logo">
                    <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Ospedale</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">

                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40"
                                alt="Admin">
                            <span class="status online"></span></span>
                        <span>Admin</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="#">Edit Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>



        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>


                        <li class="submenu">
                            <a href="#"><i class="fa fa-user-md"></i> <span> Doctors </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="add-doctor.php">Add Doctor</a></li>
                                <li><a href="doctors.php">Manage Doctor</a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"><i class="fa fa-wheelchair"></i> <span> Patients </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="add-patient.php">Add Patient</a></li>
                                <li><a href="patients.php">Manage Patient</a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"><i class="fa fa-calendar"></i> <span> Appointments </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="choose-specializations.php">Add Appointment</a></li>
                                <li><a href="appointments.php">Manage Appointment</a></li>
                            </ul>
                        </li>

                        <li class="submenu">
                            <a href="#"><i class="fa fa-bed"></i> <span> Rooms </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                              
                                <li><a href="rooms.php">Manage Rooms</a></li>
                                <li><a href="search-room.php">Search Room</a></li>
                            </ul>
                        </li>
                        
                        <li class="submenu">
                            <a href="#"><i class="fa fa-list"></i> <span> Logs </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="patients-log.php">Patients Log</a></li>
                                <li><a href="doctor-log.php">Doctor Log</a></li>
                                <li><a href="room-log.php">Room Log</a></li>
                                <li><a href="prescription-log.php">Prescription Log</a></li>
                            </ul>
                </div>
            </div>
        </div>