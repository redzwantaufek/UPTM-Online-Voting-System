<?php
    include '../Database/connect.php';
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['admin_id'])) {
        // If not, redirect to login page
        header('Location: ../login.php');
        exit();
    }

    // Query to select the admin details from the database using the admin ID from the session
    $sql = "SELECT * FROM admin WHERE adminID = '".$_SESSION['admin_id']."'";
    // Execute the query
    $result = $conn->query($sql);

    // If the query returns more than 0 rows, fetch the admin details
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        // Get the image path from the database
        $imagePath = $admin['pic'];
    } else {
        // If no admin details are found, display an error message and exit the script
        echo "No admin found";
        exit();
    }

    // Update admin information, profile picture and password if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $adminName = $_POST['adminName'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $position = $_POST['position'];
        $password = $_POST['password']; // Added password
        
    // Check if file was uploaded
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        // Define directory to store images
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["pic"]["name"]);

        // Move the uploaded file to your desired directory and check if the file was moved successfully
        if (!move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        // If no file was uploaded, use the default image
        $target_file = 'img/no_profile.webp';
    }

    $sql = "INSERT INTO admin (adminName, email, contact, position, password, pic) VALUES (?, ?, ?, ?, ?, ?)"; // Added password
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $adminName, $email, $contact, $position, $password, $target_file); // Added password
    $stmt->execute();

    $_SESSION['success_msg'] = "Admin created successfully!";
    }

    // Close the database connection
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
                        <a class="collapse-item" href="adminList.php">List Admin</a>
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
                         <h1 class="h3 mb-0 text-gray-800">Create Admin</h1>
                     </div>

                      <!-- Success Message -->
                        <?php if (isset($_SESSION['success_msg'])): ?>
                            <div class="alert alert-success" role="alert">
                                <?php 
                                    echo $_SESSION['success_msg']; 
                                    unset($_SESSION['success_msg']);
                                ?>
                            </div>

                        <?php endif; ?>

                     <!-- Content Row -->
                     <div class="row">

                         <!-- Admin Create Form -->
                         <div class="col-xl-12 col-md-12 mb-4">
                             <div class="card border-0 shadow h-100 py-2 rounded-lg">
                                 <div class="card-body">
                                     <form action="adminCreate.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                                        <div class="form-group text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <label for="profilePicture">Profile Picture</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="profilePicture" name="pic" onchange="updateFileName(this)" required>
                                                <label class="custom-file-label" for="profilePicture">Choose file</label>
                                            </div>
                                        </div>


                                         <div class="form-group">
                                             <label for="name">Name</label>
                                             <input type="text" class="form-control" id="name" name="adminName" placeholder="Enter name" required>
                                         </div>
                                         <div class="form-group">
                                             <label for="email">Email Address</label>
                                             <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                         </div>
                                         <div class="form-group">
                                             <label for="contact">Contact</label>
                                             <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact number" required>
                                         </div>
                                         <div class="form-group">
                                             <label for="position">Position</label>
                                             <input type="text" class="form-control" id="position" name="position" placeholder="Enter position" required>
                                         </div>
                                         <div class="form-group">
                                             <label for="password">Password</label>
                                             <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                         </div>
                                         <button type="submit" class="btn btn-primary">Create</button>
                                     </form>
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

    <!-- This script updates the file name when a new file is selected -->
    <script>
        function updateFileName(inputElement) {
            var fileName = inputElement.files[0].name; inputElement.nextElementSibling.textContent = fileName;
        }
    </script>
    
    <script>
    function validateForm() {
        var adminName = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var contact = document.getElementById('contact').value;
        var course = document.getElementById('position').value;
        var password = document.getElementById('password').value;

        if (adminName == "" || email == "" || contact == "" || position == "" || password == "") {
            alert("All fields must be filled out");
            return false;
        }
    }
    </script>

    <script>
    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
        })
    })()
    </script>

</body>

</html>