<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Uptm Voting System" content="">
    <meta name="Redzwan" content="">

    <title>Candidate - UPTM VOTING SYSTEM</title>

    <!-- Custom fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- _______________________________________________Sidebar_______________________________________________ -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-square-poll-vertical"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                OPTIONS
            </div>

            <!-- Nav Item - Admin Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Administration</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">MENU</h6>
                        <a class="collapse-item" href="adminProfiles.php">View Profile</a>
                        <a class="collapse-item" href="adminCreate.php">Create Admin</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Candidates Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-users"></i>
                    <span>Candidate</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">MENU</h6>
                        <a class="collapse-item" href="candidateCreate.php">Add Candidates</a>
                        <a class="collapse-item" href="candidateView.php">View Candidates</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Election Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-check-to-slot"></i>
                    <span>Election</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">MENU</h6>
                        <a class="collapse-item" href="electionView.php">Election View</a>
                        <a class="collapse-item" href="electionSet.php">Election Set Up</a>
                        <a class="collapse-item" href="annSet.php">Election Announcement</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Student Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStudent"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-person"></i>
                    <span>Student</span>
                </a>
                <div id="collapseStudent" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">MENU</h6>
                        <a class="collapse-item" href="studentView.php">View Student Profile</a>
                        <a class="collapse-item" href="studentCreate.php">Create Student</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Result -->
            <li class="nav-item">
                <a class="nav-link" href="result.php">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Election Result</span></a>
            </li>

            <!-- Nav Item - Student attendance -->
            <li class="nav-item">
                <a class="nav-link" href="attendance.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Student Attendance</span></a>
            </li>

            <!-- Nav Item - Result -->
            <li class="nav-item">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>About</span></a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- _______________________________________________End of Sidebar___________________________________________________________ -->
        

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!------------------------------------ Topbar ------------------------------------------------------->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- UPTM Logo -->
                        <div class="navbar-brand" href="#">
                            <img src="img/uptm.jpg" alt="" class="img-fluid logo-img" style="max-width: 100px; max-height: 100px;">
                        </div>            

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Ali bin Abu</span>
                                <img class="img-profile rounded-circle" title="profile images"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="adminProfiles.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- _______________________________________End of Topbar__________________________________________________________ -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Candidates</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Candidates Table -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Candidates List</h6>
                                </div>
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search by name" id="searchInput">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="searchButton">Search</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Picture</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Course</th>
                                                    <th>Faculty</th>
                                                    <th>Manifesto</th>
                                                    <th>Link</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Data will be inserted here dynamically -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; FCOM UPTM 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    

</body>

</html>