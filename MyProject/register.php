<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="./src/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/36c814cb6e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./src/css/logincustom.css">
    <script src="./src/js/font-awesome.js"></script>
</head>

<body>
    <div class="toastbox" id="toastbox-reg">
    </div>
    <div class="grid-center">
        <div class="container-box">
            <div class="content-img-reg position-relative">
                <a class="position-absolute bottom-0 end-0 mb-2 new-user-reg la-spasing" href="login.php">Already
                    Register</a>
            </div>

            <div class="login">

                <div class="container">
                    <form action="register.php" method="post">

                        <div class="row">
                            <div class="col-lg-12 text-center pt-3">
                                <h2>Signup</h2>
                            </div>
                            <div class="col-lg-12 pt-5">

                                <div class="row gy-3">

                                    <div class="col-6">
                                        <div class="input-box form-floating rounded-3">
                                            <input class="form-control rounded-3" type="text" name="fname" id="fname" placeholder="" required>
                                            <label class="form-label" for="name">First Name</label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-box form-floating rounded-3">
                                            <input class="form-control rounded-3" type="text" name="lname" id="lname" placeholder="" required>
                                            <label class="form-label" for="lname">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-box form-floating rounded-3">
                                            <input class="form-control rounded-3" type="email" name="email" id="email" placeholder="" required>
                                            <label class="form-label" for="email">Email</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-box form-floating rounded-3">
                                            <input class="form-control rounded-3" type="password" name="password" id="password" placeholder="" required>
                                            <label class="form-label" for="password">Passowrd</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="input-box form-floating rounded-3">
                                            <input class="form-control rounded-3" type="text" name="cpassword" id="cpassword" placeholder="" required>
                                            <label class="form-label" for="cpassword">Confirm Passowrd</label>
                                        </div>
                                    </div>

                                    <div class="col-12 px-5">
                                        <button type="submit" class="btn btn-outline-info w-100" id="signupbtn">Sign Up</button>
                                    </div>

                                </div>


                            </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
    <script src="./src/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/register-form-valid.js"></script>

    <?php
    try {

        if (isset($_POST['fname']) || isset($_POST['lname']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['cpassword'])) {
            $name = $_POST['fname'] . " " . $_POST['lname'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpassword'];

            if ($pass === $cpass) {
                $conn = new mysqli("localhost", "root", "", "myproject");

                $sql = "SELECT * FROM EMPLOYEE WHERE EMP_EMAIL ='" . $email . "'";
                if ($res = $conn->query(($sql))) {
                    if ($res->num_rows > 0) {

    ?>
                        <script>
                            showToast(invalid, "Invalid, Email Already exist");
                        </script>
                        <?php
                    } else {
                        $sql = "INSERT INTO EMPLOYEE (EMP_NAME,EMP_EMAIL,EMP_PASSWORD) VALUES('" . $name . "','" . $email . "','" . $pass . "')";

                        if ($conn->query($sql)) {
                        ?>
                            <script>
                                showToast(success, "Successfully, Registration Complete ! Try to login");
                                setTimeout(() => {
                                    window.location.replace("login.php");
                                }, 3000);
                            </script>
                <?php
                        }
                    }
                }
            } else {
                ?>
                <script>
                    showToast(invalid, "Invalid,Password Not Match !! Retry Password");
                </script>
        <?php
            }
        }
    } catch (Exception $e) {
        ?>
        <script>
            showToast(error, "Error,Server Problem Try again later")
        </script>
    <?php
    }


    ?>

</body>

</html>