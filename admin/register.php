<?php
session_start();
$filepath = dirname(__FILE__);
include $filepath . "/../admin/config/data_base.php";
include $filepath . "/healper/healper.php";

// if (isset($_SESSION['is_registration']) && $_SESSION['is_registration'] == true) {
//     header('Location:register.php');
// }


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name        = inputValidate($_POST['name']);
    $email       = inputValidate($_POST['email']);
    $password    = inputValidate($_POST['password']);
    // echo $name, $email, $password;

    if (empty($name)) {
        $error['nameErro'] = "Empty Field";
    } else {
        $data['name'] = $name;
    }
    if (empty($email)) {
        $error['emailErro'] = "Empty Field";
    } else {
        $data['email'] = $email;
    }
    if (empty($password)) {
        $error['passwordErro'] = "Empty Field";
    } else {
        $data['password'] = $password;
    }
    if (empty($error['nameErro']) || empty($error['emailErro']) || empty($error['passwordErro'])) {
        $sql = "INSERT INTO admin(name, email, password)VALUES(:name, :email, :password)";
        if ($stmp = $conn->prepare($sql)) {
            # code...
            $stmp->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmp->bindValue(':email', $data['email'], PDO::PARAM_STR);
            $stmp->bindValue(':password', $data['password'], PDO::PARAM_STR);
            // $stmp->execute();
            // $result = $stmp->fetch(PDO::FETCH_OBJ);
            if ($stmp->execute()) {
                // $options = [ 'cost' => $i, 'salt' => $password ];
                // echo "go good";
                if(password_hash($password, PASSWORD_ARGON2I)){
                    // session_start();
                    // $_SESSION['is_registration'] = true;
                    $_SESSION['success'] = 'Account created successfully'. '<br>' . 'login Again';
                    header('location:index.php');

                }else {
                    $error['passwordErro'] = "Password is not hasd";
                }
            }
            // else {
            //     $error['emailErro'] = "Email is not inserted";
            // }
        }
        }
}
?>

<?php $title = "Register"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- <title>SB Admin 2 - Register</title> -->
    <title>Admin Penal - <?php echo ucfirst($title); ?></title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>
<!-- bg-gradient-primary -->

<body class="">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-ragistration-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" autocomplete="off">
                                <div class="form-group row">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" 
                                        id="exampleFirstName" name="fristName" 
                                            placeholder="First Name">
                                    </div> -->
                                    <div class="col-12">
                                        <input type="text" class="form-control form-control-user" id="exampleInputEmail" name="name" placeholder="Full Name">
                                        <small id="emailHelp" class="form-text text-danger">
                                            <?php
                                            echo ($error['nameErro']) ?? '';
                                            ?>
                                        </small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email Address">
                                    <small id="emailHelp" class="form-text text-danger">
                                        <?php
                                        echo ($error['emailErro']) ?? '';
                                        ?>
                                    </small>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                                        <!-- <span class="text-danger"><?php echo   $error['passwordError'] ?? ''; ?></span> -->
                                        <small class="from-text text-danger">
                                            <?php
                                            echo ($error['passwordErro']) ?? '';
                                            ?>
                                        </small>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" name="password" placeholder="Repeat Password">
                                        <!-- <span class="text-danger"><?php echo   $error['passwordError'] ?? ''; ?></span> -->
                                        <small class="from-text text-danger">
                                            <?php
                                            echo ($error['passwordErro']) ?? '';
                                            ?>
                                        </small>
                                    </div>

                                </div>
                                <button type="sumit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <!-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Already have an account? Login!</a>
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