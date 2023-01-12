<?php
session_start();
$filepath = dirname(__FILE__);
include $filepath . "/../admin/config/data_base.php";
include $filepath . "/healper/healper.php";


// session_start();
if (isset($_SESSION['is_logined']) && $_SESSION['is_logined'] == true) {
    header('location:dashboard.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = inputValidate($_POST['email']);
    $password = inputValidate($_POST['password']);

    // echo $email, $password;

    if (empty($email)) {
        $error['emailErro'] = "Email is required.";
    } else {
        $data['email'] = $email;
    }
    if (empty($password)) {
        $error['passwordErro'] = "Password is required.";
    } else {
        $password = @$password;
    }
    if (empty($error['email']) || empty($error['password'])) {
        // echo $email."<br>", $password;
        $sql = "SELECT * FROM admin WHERE email=:email";
        $stmp = $conn->prepare($sql);
        $stmp->bindparam(':email', $email, PDO::PARAM_STR);
        $stmp->execute();
        $result = $stmp->fetch(PDO::FETCH_OBJ);
        // print_r($result);
        if ($result->status == 0) {
            $error['passwordErro'] = "Your Account has been suspended";
        } else {
            if ($result) {
                //   echo $result->name;
                // echo $result->password;
                if (password_verify($password, $result->password)) {
                    // echo 'Password is valid!';
                    session_start();
                    $_SESSION['name']       = $result->name;
                    $_SESSION['id']         = $result->id;
                    $_SESSION['is_logined'] = true;
                    header('location:dashboard.php');
                } else {
                    $error['passwordErro'] = "Password is not found";
                }
            } else {
                $error['emailErro'] = "Email is not found";
            }
        }
    }
}
// include "healper/healper.php";
?>

<?php $title = "LogIn"; ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Penal - <?php echo ucfirst($title); ?></title>
    <!-- <title>MAIN PENAL | </title> -->

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-warnning">

    <div class="container">
        <?php
        if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?php echo $_SESSION['success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
            unset($_SESSION['success']);
        }
        ?>

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="user" autocomplete="off">
                                        <div class="form-group">
                                            <input type="email" name="email" value="<?php echo $data['email'] ?? ''; ?>" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            <span class="text-danger"><?php echo   $error['emailError'] ?? ''; ?></span>
                                        </div>
                                        <p class="text-danger">
                                            <?php
                                            echo ($error['emailErro']) ?? '';
                                            ?>
                                        </p>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            <span class="text-danger"><?php echo   $error['passwordError'] ?? ''; ?></span>
                                        </div>
                                        <p class="text-danger">
                                            <?php
                                            echo ($error['passwordErro']) ?? '';
                                            ?>
                                        </p>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>