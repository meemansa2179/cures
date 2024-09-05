<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        <a href="edit-profile.php" title="Edit Profile" class="text-white"> <i class="fa fa-fw fa-user"></i>
                            <?php
                            $fullname = $_SESSION['admin_name'];
                            echo $fullname;
                            ?> (Admin) <i class="fa fa-fw fa-cog" title="Edit Profile"></i>
                        </a>
                    </li>
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php" aria-expanded="false"><i
                                class="fa fa-fw fa-home"></i>Dashboard</a>

                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="physician-view-all.php" aria-expanded="false"><i
                                class="fa fa-fw fa-users"></i>Physician Management</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="patient-view-all.php" aria-expanded="false"><i
                                class="fa fa-fw fa-users"></i>Patient Management</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="documents-view-all.php" aria-expanded="false"><i
                                class="fa fa-fw fa-list"></i>Documents Management</a>
                    </li>
                    
                    <li class="nav-item ">
                        <a class="nav-link" href="reset-password.php" aria-expanded="false"><i
                                class="fa fa-fw fa-unlock"></i>Reset Password</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="logout.php" aria-expanded="false"><i
                                class="fa fa-fw fa-power-off"></i>Logout</a>

                    </li>

                </ul>
            </div>
            </li>

            </ul>
    </div>

    </nav>
</div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->