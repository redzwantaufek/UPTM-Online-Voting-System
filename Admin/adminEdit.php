<?php
    include '../Database/connect.php';
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['admin_id'])) {
        header('Location: ../login.php');
        exit();
    }

    // Query to select the profile picture of the currently logged-in admin
    $sql = "SELECT pic FROM admin WHERE adminID = '".$_SESSION['admin_id']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $currentAdmin = $result->fetch_assoc();
        $currentAdminPic = $currentAdmin['pic'];
    } else {
        echo "No admin found";
        exit();
    }

    // Get the id of the admin to edit from the URL
    $adminIdToEdit = $_GET['id'];

    // Query to select the admin details from the database using the admin ID from the URL
    $sql = "SELECT * FROM admin WHERE adminID = '".$adminIdToEdit."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $editedAdminPic = $admin['pic'];
    } else {
        echo "No admin found";
        exit();
    }

    // Update admin information and profile picture if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $adminName = $_POST['adminName'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $position = $_POST['position'];

        // Check if a new profile picture has been uploaded
        if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["pic"]["name"]);

            if (!move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
            $pic = $target_file;
        } else {
            $pic = $editedAdminPic;
        }

        $sql = "UPDATE admin SET adminName = ?, email = ?, contact = ?, position = ?, pic = ? WHERE adminID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $adminName, $email, $contact, $position, $pic, $adminIdToEdit);
        $stmt->execute();

        header('Location: adminList.php');
        exit();
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Uptm Voting System" content="">
    <meta name="Redzwan" content="">

    <title>Admin - UPTM VOTING SYSTEM</title>

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
                    <i class="fa-solid fa-user-tie"></i>
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
            <li class="nav-item active">
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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fa-solid fa-users"></i>
                    <span>Candidate</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">MENU</h6>
                        <a class="collapse-item" href="candidateCreate.php">Verify Candidates</a>
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
                        <a class="collapse-item" href="adminList.php">List Admin</a>
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
                                <img src="<?php echo $currentAdminPic; ?>" class="img-profile rounded-circle img-fluid" title="profile images" 
                                style="max-width: 200px;" onerror="this.onerror=null; this.src='../img/no_profile.webp'">
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="adminProfiles.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">
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
                        <h1 class="h3 mb-0 text-gray-800">Admin Profile</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Admin Profile Card -->
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-0 shadow h-100 py-2 rounded-lg">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-12 text-center mb-4">
                                            <img src="<?php echo $editedAdminPic; ?>" class="img-profile rounded-circle border-secondary img-fluid border p-3 bg-light" title="profile images" style="max-width: 200px;" onerror="this.onerror=null; this.src='../img/no_profile.webp'">    
                                        </div>
                                        <div class="col-12">
                                        <form action="adminUpdate.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?php echo $adminIdToEdit; ?>">
                                                <input type="hidden" name="editedAdminPic" value="<?php echo $editedAdminPic; ?>">
                                                <div class="form-group text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <label for="profilePicture">Profile Picture</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="profilePicture" name="pic" onchange="updateFileName(this)">
                                                        <label class="custom-file-label" for="profilePicture">Choose file</label>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Name</div>
                                                <input type="text" class="form-control" id="adminName" name="adminName" value="<?php echo $admin['adminName']; ?>">
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Email</div>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $admin['email']; ?>">
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Contact</div>
                                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $admin['contact']; ?>">
                                                <hr class="sidebar-divider my-1">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Position</div>
                                                <input type="text" class="form-control" id="position" name="position" value="<?php echo $admin['position']; ?>">
                                                <button type="submit" class="btn btn-primary mt-3 rounded-pill" title="save">Save</button>
                                                <button class="btn btn-danger mt-3 rounded-pill" onclick="window.location.href='adminList.php'" title="cancel" type="button">Cancel</button>
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

    
    <!-- This script updates the file name when a new file is selected -->
    <script>
        function updateFileName(inputElement) {
            var fileName = inputElement.files[0].name; inputElement.nextElementSibling.textContent = fileName;
        }
    </script>
    

</body>

</html>