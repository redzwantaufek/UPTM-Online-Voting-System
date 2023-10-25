<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UPTM Voting System - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                <img src="img/uptm.jpg" alt="UPTM" class="img-fluid text-center mx-auto p-4" >
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">UPTM ONLINE VOTING SYSTEM</h1>
                                    </div>
                                    <form class="user" method="POST" action="login.php">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="InputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address" name="InputEmail">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="InputPassword" placeholder="Password" name="InputPassword">
                                        </div>
                                        <div id="loginError" class="form-group" style="display: none;">
                                            <div class="alert alert-danger" role="alert">
                                                Invalid email or password.
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
    session_start();
    if (isset($_SESSION['admin_id']) || isset($_SESSION['student_id'])) {
        session_destroy();
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['InputEmail'];
        $password = $_POST['InputPassword'];

        // Connect to the database
        $db = new PDO('mysql:host=localhost;dbname=ovs', 'root', '');

        // Prepare the SQL statement to check the admin's credentials
        $sql = "SELECT * FROM admin WHERE email = :email AND password = :password";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['admin_id'] = $stmt->fetch()['adminID'];
            $_SESSION['user_type'] = 'admin';
            header('Location: Admin/index.php');
            exit();
        } else {
            // If not found in admin, check in student table
            $sql = "SELECT * FROM student WHERE email = :email AND password = :password";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['student_id'] = $stmt->fetch()['studentID'];
                $_SESSION['user_type'] = 'student';
                header('Location: index.php');
                exit();
            } else {
                echo '<script type="text/javascript">document.getElementById("loginError").style.display = "block";</script>';
            }
        }

        $db = null;
    }
?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>