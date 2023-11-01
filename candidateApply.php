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
        // Check if the student has already applied
        $hasApplied = $student['apply'];
    } else {
        // If no student details are found, display an error message and exit the script
        echo "No student found";
        exit();
    }

    // If the student has applied, fetch the application details
    if ($hasApplied) {
        $sql = "SELECT * FROM apply WHERE studentId = '".$_SESSION['student_id']."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $application = $result->fetch_assoc();
        }
    }

    // Create application if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $course = $_POST['course'];
        $faculty = $_POST['faculty'];
        $semester = $_POST['semester'];
        $manifesto = $_POST['manifesto'];

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

        $sql = "INSERT INTO apply (studentId, applyPic, name, email, contact, course, faculty, semester, manifesto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssss", $_SESSION['student_id'], $target_file, $name, $email, $contact, $course, $faculty, $semester, $manifesto);
        $stmt->execute();

        $_SESSION['success_msg'] = "Application submitted successfully!";

        // Prepare an UPDATE statement to set the 'apply' field to 1 for the current student
        $sql = "UPDATE student SET apply = 1 WHERE studentId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $_SESSION['student_id']);

        // Execute the UPDATE statement
        $stmt->execute();

        $_SESSION['success_msg'] = "Application submitted successfully!";

        // Redirect to index.php
        header('Location: index.php');
        }

        $studentId = $_SESSION['student_id'];
        $sql = "SELECT * FROM candidate WHERE studentId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentId);
        $stmt->execute();
        $result = $stmt->get_result();
        $candidate = $result->fetch_assoc();

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
                        <h1 class="h3 mb-0 text-gray-800">Candidate Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Candidate Profile Card -->
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-0 shadow h-100 py-2 rounded-lg">
                                <div class="card-body">
                                <?php if ($hasApplied): ?>
                                    <h5 class="font-weight-bold">You have already applied. Here are your application details:</h5>
                                    <div class="card">
                                        <div class="card-body">                                            
                                            <h5 class="card-title">Application Info</h5>
                                            <img src="<?php echo $application['applyPic']; ?>" class="img-profile img-fluid" title="profile images" 
                                            style="max-width: 200px; margin-bottom:10px; border-radius: 5px; " onerror="this.onerror=null; this.src='../img/no_profile.webp'">
                                            <p class="card-text"><strong>Name: </strong><?php echo $application['name']; ?></p>
                                            <p class="card-text"><strong>Email: </strong><?php echo $application['email']; ?></p>
                                            <p class="card-text"><strong>Contact: </strong><?php echo $application['contact']; ?></p>
                                            <p class="card-text"><strong>Course: </strong><?php echo $application['course']; ?></p>
                                            <p class="card-text"><strong>Faculty: </strong><?php echo $application['faculty']; ?></p>
                                            <p class="card-text"><strong>Semester: </strong><?php echo $application['semester']; ?></p>
                                            <p class="card-text"><strong>Manifesto: </strong><?php echo $application['manifesto']; ?></p>
                                            <p class="card-text"><strong>Status: </strong><?php echo $application['status']; ?></p>
                                        </div>
                                    </div>
                                    <?php if ($application['status'] == 'Accept'): ?>
                                    <div style="margin-top: 20px;"></div>
                                        <h5 class="font-weight-bold">You have already accepted. Here are your candidate details:</h5>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Candidate Info</h5>
                                                <img src="<?php echo $candidate['candidatePic']; ?>" class="img-profile img-fluid" title="profile images" 
                                                style="max-width: 200px; margin-bottom:10px; border-radius: 5px; " onerror="this.onerror=null; this.src='../img/no_profile.webp'">
                                                <p class="card-text"><strong>Name: </strong><?php echo $candidate['candidateName']; ?></p>
                                                <p class="card-text"><strong>Candidate No: </strong><?php echo $candidate['candNo']; ?></p>
                                                <p class="card-text"><strong>Email: </strong><?php echo $candidate['email']; ?></p>
                                                <p class="card-text"><strong>Contact: </strong><?php echo $candidate['contact']; ?></p>
                                                <p class="card-text"><strong>Course: </strong><?php echo $candidate['courseName']; ?></p>
                                                <p class="card-text"><strong>Faculty: </strong><?php echo $candidate['faculty']; ?></p>
                                                <p class="card-text"><strong>Manifesto: </strong><?php echo $candidate['manifesto']; ?></p>
                                                <p class="card-text"><strong>Manifesto Link: </strong><a href="<?php echo $candidate['links']; ?>"><?php echo $candidate['links']; ?></a></p>
                                            </div>
                                        </div>
                                        <a href="candidateEdit.php?studentId=<?php echo $_SESSION['student_id']; ?>" class="btn btn-primary mt-3 float-right">Edit Manifesto</a>
                                    <?php endif; ?>
                                    <?php if ($application['status'] == 'Reject'): ?>
                                    <div style="margin-top: 20px;"></div>
                                        <h5 class="font-weight-bold">Your application has been rejected. Here are your application details:</h5>
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Application Info</h5>
                                                <img src="<?php echo $application['applyPic']; ?>" class="img-profile img-fluid" title="profile images" 
                                                style="max-width: 200px; margin-bottom:10px; border-radius: 5px; " onerror="this.onerror=null; this.src='../img/no_profile.webp'">
                                                <p class="card-text"><strong>Name: </strong><?php echo $application['name']; ?></p>
                                                <p class="card-text"><strong>Email: </strong><?php echo $application['email']; ?></p>
                                                <p class="card-text"><strong>Contact: </strong><?php echo $application['contact']; ?></p>
                                                <p class="card-text"><strong>Course: </strong><?php echo $application['course']; ?></p>
                                                <p class="card-text"><strong>Faculty: </strong><?php echo $application['faculty']; ?></p>
                                                <p class="card-text"><strong>Semester: </strong><?php echo $application['semester']; ?></p>
                                                <p class="card-text"><strong>Manifesto: </strong><?php echo $application['manifesto']; ?></p>
                                                <p class="card-text"><strong>Status: </strong><?php echo $application['status']; ?></p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                        <div class="col-12 text-center mb-4">
                                            <img src="<?php echo $imagePath; ?>" class="img-profile rounded-circle border-secondary img-fluid border p-3 bg-light" title="profile images" style="max-width: 200px;" onerror="this.onerror=null; this.src='../img/no_profile.webp'">    
                                        </div>
                                        <form action="candidateApply.php" method="post" enctype="multipart/form-data">
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="profilePicture" name="pic" onchange="updateFileName(this)" required>
                                                    <label class="custom-file-label" for="profilePicture">Choose Candidate Profile Picture</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['studentName']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $student['email']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact">Contact</label>
                                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $student['contact']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="course">Course</label>
                                                <input type="text" class="form-control" id="course" name="course" value="<?php echo $student['course']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="faculty">Faculty</label>
                                                <input type="text" class="form-control" id="faculty" name="faculty" value="<?php echo $student['faculty']; ?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="semester">Semester</label>
                                                <select class="form-control" id="semester" name="semester" required>
                                                    <option value="">Select Semester</option>
                                                    <option value="Semester 1">Semester 1</option>
                                                    <option value="Semester 2">Semester 2</option>
                                                    <option value="Semester 3">Semester 3</option>
                                                    <option value="Semester 4">Semester 4</option>
                                                    <option value="Semester 5">Semester 5</option>
                                                    <option value="Semester 6">Semester 6</option>
                                                    <option value="Semester 7">Semester 7</option>
                                                    <option value="Semester 8">Semester 8</option>
                                                    <option value="Semester 9">Semester 9</option>
                                                    <option value="Semester 10">Semester 10</option>
                                                    <option value="Semester 11">Semester 11</option>
                                                    <option value="Semester 12">Semester 12</option>
                                                    <option value="Semester 13">Semester 13</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="manifesto">Manifesto</label>
                                                <textarea class="form-control" id="manifesto" name="manifesto"  placeholder="Enter your manifesto" required></textarea>
                                            </div>
                                            <button class="btn btn-danger" onclick="window.location.href='index.php'" title="cancel" type="button">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit Application</button>
                                        </form>
                                    <?php endif; ?>
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
                    <a class="btn btn-danger" href="login.php">Logout</a>
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
</body>

</html>