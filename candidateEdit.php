<?php
    include 'Database/connect.php';
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['student_id'])) {
        // If not, redirect to login page
        header('Location: login.php');
        exit();
    }

    // Query to select the student details from the database using the student ID from the session
    $sql = "SELECT * FROM student WHERE studentId = '".$_SESSION['student_id']."'";
    // Execute the query
    $result = $conn->query($sql);

    // If the query returns more than 0 rows, fetch the student details
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        // Get the image path from the database
        $imagePath = $student['studentPic'];
    } else {
        // If no student details are found, display an error message and exit the script
        echo "No student found";
        exit();
    }

    // Get the id of the candidate to edit from the foreign key student id
    $sql = "SELECT candidateId FROM candidate WHERE studentId = '".$_SESSION['student_id']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $candidateIdToEdit = $result->fetch_assoc()['candidateId'];
    } else {
        echo "No candidate found for this student";
        exit();
    }

    // Query to select the candidate details from the database using the candidate ID from the foreign key student id
    $sql = "SELECT * FROM candidate WHERE candidateId = '".$candidateIdToEdit."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $candidate = $result->fetch_assoc();
        $editedCandidatePic = $candidate['candidatePic'];
    } else {
        echo "No candidate found";
        exit();
    }

    $conn->close();
?>

<!-- The HTML structure and JavaScript code should be similar to adminEdit.php, but replace "admin" with "candidate" -->

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- _______________________________________________Sidebar_______________________________________________ -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <i class="fa-solid fa-vote-yea"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Voting System</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Home -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Candidates Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-users"></i>
                    <span>Candidates</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">MENU</h6>
                        <a class="collapse-item" href="candidateView.php">View Candidates</a>
                        <a class="collapse-item" href="candidateApply.php">Apply Candidates</a>
                    </div>
                </div>
            </li>
            
            <!-- Nav Item - Vote -->
            <li class="nav-item">
                <a class="nav-link" href="vote.php">
                    <i class="fa-solid fa-check-to-slot"></i>
                    <span>Vote</span>
                </a>
            </li>

            <!-- Nav Item - Election Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>About</span>
                </a>
            </li>

            <!-- Nav Item - Student Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="studentProfile.php">
                    <i class="fa-solid fa-person"></i>
                    <span>Profile</span>
                </a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user_name']; ?></span>
                                <img src="<?php echo $imagePath; ?>" class="img-profile rounded-circle img-fluid" title="profile images" 
                                style="max-width: 200px;" onerror="this.onerror=null; this.src='../img/no_profile.webp'">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="studentProfile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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
                        <h1 class="h3 mb-0 text-gray-800">Candidate Profile</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Candidate Profile Card -->
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-0 shadow h-100 py-2 rounded-lg">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-6 text-center mb-4">
                                            <label for="profilePicture">Profile Picture</label><br>
                                            <img src="<?php echo $editedCandidatePic; ?>" class="img-profile rounded-circle border-secondary img-fluid border p-3 bg-light" title="profile images" style="max-width: 200px;" onerror="this.onerror=null; this.src='../img/no_profile.webp'">    
                                        </div>
                                        <div class="col-6 text-center mb-4">
                                            <label for="poster">Poster</label><br>
                                            <a href="<?php echo $candidate['poster']; ?>" data-lightbox="poster">
                                                <img src="<?php echo $candidate['poster']; ?>" class="img-fluid" alt="Poster" style="max-width: 200px;">
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <form action="candidateUpdate.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?php echo $candidateIdToEdit; ?>">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Name</div>
                                                <input type="text" class="form-control" id="candidateName" name="candidateName" value="<?php echo $candidate['candidateName']; ?>" readonly>
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Candidate No</div>
                                                <input type="text" class="form-control" id="candNo" name="candNo" value="<?php echo $candidate['candNo']; ?>" readonly>
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Email</div>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $candidate['email']; ?>" readonly>
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Contact</div>
                                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $candidate['contact']; ?>" readonly>
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Faculty</div>
                                                <input type="text" class="form-control" id="faculty" name="faculty" value="<?php echo $candidate['faculty']; ?>" readonly>
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Course Name</div>
                                                <input type="text" class="form-control" id="courseName" name="courseName" value="<?php echo $candidate['courseName']; ?>" readonly>
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Manifesto</div>
                                                <textarea class="form-control" id="manifesto" name="manifesto"><?php echo $candidate['manifesto']; ?></textarea>
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Links</div>
                                                <input type="text" class="form-control" id="links" name="links" value="<?php echo $candidate['links']; ?>">
                                                <hr class="sidebar-divider my-1">
                                                <div class="form-group text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <label for="posterImage">Poster Image</label>
                                                    <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="posterImage" name="poster" onchange="updateFileName(this)" accept=".png, .jpg, .jpeg">
                                                        <label class="custom-file-label" for="posterImage">Choose file</label>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-3 rounded-pill" title="save">Save</button>
                                                <button class="btn btn-danger mt-3 rounded-pill" onclick="window.location.href='candidateApply.php'" title="cancel" type="button">Cancel</button>
                                            </form>
                                        </div>
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
                    <a class="btn btn-danger" href="login.html">Logout</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>

    <!-- This script updates the file name when a new file is selected -->
    <script>
        function updateFileName(inputElement) {
            var fileName = inputElement.files[0].name; inputElement.nextElementSibling.textContent = fileName;
        }
    </script>
    
</body>

</html>