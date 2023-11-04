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

   
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Uptm Voting System" content="">
    <meta name="Redzwan" content="">

    <title>Dashboard - UPTM VOTING SYSTEM</title>

    <!-- Custom fonts-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
            <li class="nav-item active">
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
                        <a class="collapse-item" href="candidatesApplication.php">Candidates Status</a>
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
                        <a class="collapse-item" href="annSet.php">Election Winner</a>
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
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>About</span></a>
            </li>

            <!-- Nav Item - Settings -->
            <li class="nav-item">
                <a class="nav-link" href="settings.php">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span></a>
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!--Voter Turnout Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Voting Percentage</div>
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
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.number_format($votingPercentage, 2).'%</div>';
                                            } else {
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">No information available</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-check-to-slot fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Election Date Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Election Date</div>
                                            <?php
                                            // Query to select the election date from the election table
                                            $sql = "SELECT date FROM election ORDER BY date DESC LIMIT 1";
                                            // Execute the query
                                            $result = $conn->query($sql);
                                            // Check if the table has any data
                                            if ($result->num_rows > 0) {
                                                // Fetch the data
                                                $row = $result->fetch_assoc();
                                                // Display the election date
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$row['date'].'</div>';
                                            } else {
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">No information available</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-calendar-day fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Election Time Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Election Time
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
                                                    echo '<div id="timeRemaining" class="h5 mb-0 font-weight-bold text-gray-800 mt-3">Time until Election Start: <br>'.$remaining->format('%a days %H:%I:%S').'</div>';
                                                } else {
                                                    echo '<div class="h5 mb-0 font-weight-bold text-gray-800 mt-3">Election has ended</div>';
                                                }
                                            } else {
                                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800 mt-3">No information available</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Candidates Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Candidates</div>
                                            <?php
                                            // Query to select the total number of candidates from the candidate table
                                            $sql = "SELECT COUNT(*) as total FROM candidate";
                                            // Execute the query
                                            $result = $conn->query($sql);
                                            // Fetch the data
                                            $row = $result->fetch_assoc();
                                            echo '<div class="h5 mb-0 font-weight-bold text-gray-800">'.$row['total'].'</div>';
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-user-group fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5 d-flex ">
                            <div class="card border-left-warning shadow mb-4 flex-fill">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-warning">Election Live Data</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <!-- Add Bootstrap classes for typography and spacing -->
                                    <div id="pieChartData" class="mt-4 text-center">
                                        <!-- Data will be inserted here by jQuery -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Progress Bars -->
                        <div class="col-xl-8 col-lg-7 d-flex">
                            <div class="card border-left-info shadow mb-4 flex-fill">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-info">Candidates Live Data</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <p class="text-left font-weight-bold text-secondary">Candidates Name</p>
                                    <div id="progressBars" class="pt-4 pb-2">
                                        <!-- Progress bars will be inserted here by jQuery -->
                                    </div>
                                    <p class="text-center font-weight-bold text-secondary">Votes Number</p>
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

    <script>
    var ctxPie = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            datasets: [{
                data: [], // Initially empty
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
            }],
            labels: ['Voted', 'Not Voted'],
        },
        options: {
        maintainAspectRatio: false,
        // other options
    }
    });

   
    </script>
    
    <script>
        function updateCharts() {
            $.ajax({
                url: 'getVotingData.php',
                success: function(data) {
                    myPieChart.data.datasets[0].data = [data.voted, data.notVoted];
                    myPieChart.update();

                    // Format the data with HTML tags and Bootstrap classes
                    var content = '<p class="font-weight-bold">Voting Statistics:</p>' +
                    '<p><span class="font-weight-bold text-primary">Voted:</span> ' + data.voted + '</p>' +
                    '<p><span class="font-weight-bold text-success">Not Voted:</span> ' + data.notVoted + '</p>';
                    var votedPercentage = Math.round((data.voted / data.totalStudents) * 100);

                    content += '<p><span class="font-weight-bold text-info">Voted Percentage:</span> ' + votedPercentage + '%</p>';

                    // Update the content of the div with the formatted data
                    $('#pieChartData').html(content);
                }
            });
        }

        // Update the charts every 5 seconds
        setInterval(updateCharts, 5000);
    </script>

    <script>
        function updateProgressBars() {
        $.ajax({
            url: 'getCandidatesData.php',
            success: function(data) {
                // If data is a string, parse it into a JavaScript object
                if (typeof data === 'string') {
                    data = JSON.parse(data);
                }

                // Clear the existing progress bars
                $('#progressBars').empty();

                // Get the total number of students
                var totalStudents = data.totalStudents;

                // Create a progress bar for each candidate
                for (var i = 0; i < data.candidates.length; i++) {
                    var candidate = data.candidates[i];
                    var votes = data.votes[i];

                    // Calculate the vote percentage
                    var votePercentage = (votes / totalStudents) * 100;

                    // Create the progress bar
                    var progressBar = '<div class="mb-3">' +
                        '<span class="font-weight-bold px-2">' + candidate + '</span>' +
                        '<div class="progress rounded">' +
                        '<div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: ' + votePercentage + '%; font-weight: bold;" aria-valuenow="' + votes + '" aria-valuemin="0" aria-valuemax="' + totalStudents + '">' +
                        votes +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    // Add the progress bar to the page
                    $('#progressBars').append(progressBar);
                }
            }
        });
    }

    // Update the progress bars every 5 seconds
    setInterval(updateProgressBars, 5000);

    </script>

    <?php
        // Close the database connection
        $conn->close();
    ?>

</body>

</html>