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

    $sql = "SELECT * FROM candidate";
    $result = $conn->query($sql);
    $candidates = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
    }

    // Query to select the latest announcement from the database
    $sql = "SELECT * FROM announcement ORDER BY annId DESC LIMIT 1";
    // Execute the query
    $result = $conn->query($sql);

    // If the query returns more than 0 rows, fetch the announcement
    if ($result->num_rows > 0) {
        $announcement = $result->fetch_assoc();
        // Get the election title and candidate names from the database
        $electionTitle = $announcement['elecTitle'];
        $candidateNames = explode(",", $announcement['candName']);
    } 

    // Query to select all candidate names from the announcement table
    $sql = "SELECT candName FROM announcement";
    // Execute the query
    $result = $conn->query($sql);

    // If the query returns more than 0 rows, fetch the candidate names
    if ($result->num_rows > 0) {
        $allCandidateNames = [];
        while($row = $result->fetch_assoc()) {
            array_push($allCandidateNames, $row['candName']);
        }
    } 

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Uptm Voting System" content="">
    <meta name="Redzwan" content="">

    <title>Home - UPTM VOTING SYSTEM</title>

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
            <li class="nav-item active">
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
                        <h1 class="h3 mb-0 text-gray-800">UPTM Online Voting System</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Election Details Card -->
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                                Election Details</div>
                                            <?php
                                            // Query to select the election details from the database
                                            $sql = "SELECT * FROM election ORDER BY electionId DESC LIMIT 1";
                                            // Execute the query
                                            $result = $conn->query($sql);
                                            // Check if the table has any data
                                            if ($result->num_rows > 0) {
                                                // Fetch the data
                                                $row = $result->fetch_assoc();
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Election Title: '.$row['electionTitle'].'</div>';
                                                echo '<div style="margin-top: 20px;"></div>';
                                                echo '<p class="card-text"><strong>Start Time: </strong> '.date("g:i a", strtotime($row['start'])).'</p>';
                                                echo '<p class="card-text"><strong>End Time: </strong> '.date("g:i a", strtotime($row['end'])).'</p>';
                                                echo '<p class="card-text"><strong>Date: </strong> '.date("F j, Y", strtotime($row['date'])).'</p>';
                                                echo '<p class="card-text"><strong>Rules: </strong> '.$row['rules'].'</p>';
                                            } else {
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">No information available</div>';
                                            }
                                            ?>
                                            <a href="vote.php" class="btn btn-primary">Vote Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Live Voting Update Card -->
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-warning text-uppercase mb-1">
                                                Live Voting Update</div>
                                            <?php
                                            // Query to select the voting history from the student table
                                            $sql = "SELECT COUNT(*) as totalStudents, SUM(votingHistory) as totalVotes FROM student";
                                            // Execute the query
                                            $result = $conn->query($sql);
                                            // Check if the table has any data
                                            if ($result->num_rows > 0) {
                                                // Fetch the data
                                                $row = $result->fetch_assoc();
                                                // Calculate the voting percentage
                                                $votingPercentage = ($row['totalVotes'] / $row['totalStudents']) * 100;
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">Voting Progress: '.number_format($votingPercentage, 2).'%</div>';
                                            } else {
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">No information available</div>';
                                            }
                                            ?>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo intval($votingPercentage); ?>%;" aria-valuenow="<?php echo intval($votingPercentage); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo intval($votingPercentage); ?>%</div>
                                            </div>

                                            
                                            <?php
                                            date_default_timezone_set('Asia/Kuala_Lumpur');
                                            // Query to select the start, end time and date from the election table
                                            $sql = "SELECT start, end, date FROM election ORDER BY electionId DESC LIMIT 1";
                                            // Execute the query
                                            $result = $conn->query($sql);
                                            // Check if the table has any data
                                            if ($result->num_rows > 0) {
                                                // Fetch the data
                                                $row = $result->fetch_assoc();
                                                $start = new DateTime($row['start']);
                                                $end = new DateTime($row['end']);
                                                $now = new DateTime();
                                                // Check if the current time is between the start and end time
                                                if ($now > $start && $now < $end) {
                                                    $remaining = $now->diff($end);
                                                    echo '<div id="timeRemaining" class="h5 mb-0 font-weight-bold text-gray-800 mt-3">Time Remaining: '.$remaining->format('%H:%I:%S').'</div>';
                                                } else if ($now < $start) {
                                                    $remaining = $now->diff($start);
                                                    echo '<div id="timeRemaining" class="h5 mb-0 font-weight-bold text-gray-800 mt-3">Time until Election Start: '.$remaining->format('%a days %H:%I:%S').'</div>';
                                                } else {
                                                    echo '<div class="h5 mb-0 font-weight-bold text-gray-800 mt-3">Election has ended</div>';
                                                }
                                            } else {
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800 mt-3">No information available</div>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Election Result Card -->
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-success text-uppercase mb-1">
                                                Election Result</div>
                                                <div class="card-body">
                                                    <?php if (isset($announcement)): ?>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Election Title: <?php echo $electionTitle; ?></div>
                                                        <p><b>Winner:</b></p>
                                                        <ul>
                                                        <?php foreach($allCandidateNames as $candidateName): ?>
                                                            <li><?php echo $candidateName; ?></li>
                                                        <?php endforeach; ?>
                                                        </ul>
                                                        <p><b>Info:</b>  <?php echo $announcement['info']; ?></p>
                                                    <?php else: ?>
                                                        <p>No winner announcement data available.</p>
                                                    <?php endif; ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- View Candidates Card -->
                        <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md font-weight-bold text-info text-uppercase mb-1">View Candidates
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Picture</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Course</th>
                                                            <th>Faculty</th>
                                                            <th>Manifesto</th>
                                                            <th>Link</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Query to select the candidates details from the database
                                                        $sql = "SELECT * FROM candidate LIMIT 2";
                                                        // Execute the query
                                                        $result = $conn->query($sql);
                                                        // Fetch the data and display it in the table
                                                        while($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td><img src='".$row['candidatePic']."' width='50' height='50'></td>";
                                                            echo "<td>".$row['candidateName']."</td>";
                                                            echo "<td>".$row['email']."</td>";
                                                            echo "<td>".$row['courseName']."</td>";
                                                            echo "<td>".$row['faculty']."</td>";
                                                            echo "<td>".$row['manifesto']."</td>";
                                                            echo "<td><a href='".$row['links']."' target='_blank'>View</a></td>";
                                                            echo "</tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <a href="candidateView.php" class="btn btn-info mt-3">View More Candidates</a>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function updateTimeRemaining() {
            $.ajax({
                url: 'getTime.php',
                success: function(data) {
                    $('#timeRemaining').text(data);
                }
            });
        }

        // Update the time remaining every second
        setInterval(updateTimeRemaining, 1000);
    </script>
    
    <?php
    // Close the database connection
    $conn->close();
    ?>

</body>

</html>