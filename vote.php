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

    <title>Vote - UPTM VOTING SYSTEM</title>

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
            <li class="nav-item">
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
            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">Vote</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Election Announcement Card -->                       <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <!-- FILEPATH: /c:/xampp/htdocs/Final Year Project/UPTM Online Voting System/vote.php -->
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Rules for Voting</h3>
                                                    <ul>
                                                        <li>You can vote for up to 12 candidates out of 20.</li>
                                                        <li>Once you have submitted your vote, you cannot change it.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3>Candidates</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form id="vote-form">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 1" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 1</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="1">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 2" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 2</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="2">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 3" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 3</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="3">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 4" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 4</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="4">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 5" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 5</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="5">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 6" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 6</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="6">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 7" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 7</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="7">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 8" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 8</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="8">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 9" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 9</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="9">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 10" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 10</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="10">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 11" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 11</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="11">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 12" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 12</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="12">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 13" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 13</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="13">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 14" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 14</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="14">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="card mt-3 mb-3 mr-3 ml-3 p-3">
                                                                    <img class="card-img-top mx-auto d-block" src="img/undraw_profile.svg" alt="Candidate 15" style="max-width: 200px;">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title">Candidate 15</h5>
                                                                        <p class="card-text">Name: John Doe<br>Faculty: Faculty 1<br>Course: Course 1</p>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" name="candidate[]" value="15">
                                                                            <label class="form-check-label">Vote</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Repeat the above code block for each candidate -->
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <form>
                                                                    <!-- Add your form elements here -->
                                                                    <button type="submit" class="btn btn-primary btn-md float-right">Vote</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <script>
        const form = document.getElementById('vote-form');
        const checkboxes = form.querySelectorAll('input[type="checkbox"]');
        const maxVotes = 12;

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            let selectedCandidates = 0;
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    selectedCandidates++;
                }
            });
            if (selectedCandidates < maxVotes) {
                alert(`Please select at least ${maxVotes} candidates.`);
            } else if (selectedCandidates > maxVotes) {
                alert(`You can only select up to ${maxVotes} candidates.`);
            } else {
                if (confirm('Are you sure you want to submit your vote?')) {
                    window.location.href = 'voteSuccess.php';
                }
            }
        });
    </script>


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