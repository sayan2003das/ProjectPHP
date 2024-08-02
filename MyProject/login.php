<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./src/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/logincustom.css">
    <script src="https://kit.fontawesome.com/36c814cb6e.js" crossorigin="anonymous"></script>
    <script src="./src/js/font-awesome.js"></script>
</head>

<body>
    <div class="toastbox" id="toastbox">
    </div>
    <div class="grid-center">
        <div class="container-box">

            <div class="login">

                <form action="login.php" method="post">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center pt-3">
                                <h2>Login</h2>
                            </div>
                            <div class="col-lg-12 pt-5 px-5">

                                <div class="row">
                                    <div class="col">
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 pt-5">

                                <div class="row gy-3">

                                    <div class="col-12">
                                        <div class="input-box form-floating rounded-3">
                                            <input class="form-control rounded-3" type="text" name="username" id="name" placeholder="" required>
                                            <label class="form-label" for="name">Username</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-box form-floating rounded-3">
                                            <input class="form-control rounded-3" type="password" name="password" id="password" placeholder="" required>
                                            <label class="form-label" for="password">Passowrd</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <a href="" class="forgot-password">Forgot Password</a>
                                    </div>

                                    <div class="col-12 px-5">
                                        <button type="submit" class="btn btn-outline-info w-100" id="loginbtn">Login</button>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="content-img">
                <a class="position-fixed bottom-0 mb-4 new-user" href="register.php">New User</a>
            </div>
        </div>

    </div>

    <script src="./src/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/login-custom-script.js"></script>

    <?php

    session_start();
    // session_unset();
    // session_destroy();

    // $bool = session_status();
    // echo $bool;

    if(isset($_SESSION['user_mail'])){
        echo $_SESSION['user_pass'];
        header("Location: dashboard.php");
    }



    if (isset($_POST['username']) || isset($_POST['password'])) {
        $name = $_POST['username'];
        $pass = $_POST['password'];
        try {
            $conn = new mysqli("localhost", "root", "", "myproject");
            $sql = "SELECT * FROM EMPLOYEE WHERE EMP_EMAIL ='" . $name . "' and EMP_PASSWORD ='" . $pass . "'";
            if ($res = $conn->query(($sql))) {
                if ($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    $_SESSION['user_mail'] = $row['EMP_EMAIL'];
                    $_SESSION['user_id'] = $row['EMP_ID'];
                    $_SESSION['user_name'] = $row['EMP_NAME'];
                    $_SESSION['user_pass'] = $row['EMP_PASSWORD'];
                    header("Location: dashboard.php");


    ?>
                    <script>
                        showToast(success, "Successfully, Login Complete");
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        showToast(invalid, "Invalid User, User Not Found");
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    showToast(error, "Error, Backend Ploblem try later");
                </script>
            <?php
            }
        } catch (Exception $e) {
            ?>
            <script>
                showToast(error, "Error, ");
            </script>
    <?php
        }
    }
    ?>

</body>

</html>