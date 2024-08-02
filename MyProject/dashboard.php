<?php

session_start();

if (!isset($_SESSION['user_mail'])) {
    // echo $_SESSION['user_name'];
    header("Location: login.php");
}
$conn = new mysqli("localhost", "root", "", "myproject");


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./src/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/dashboard.css">
    <script src="https://kit.fontawesome.com/36c814cb6e.js" crossorigin="anonymous"></script>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- navbar -->

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container flex-lg-column">
            <a class="navbar-brand mx-auto flex-lg-column mb-5" href="#home">
                <span class="h3 fw-bold text-brand text-uppercase"> <?php echo $_SESSION['user_name'] ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto flex-lg-column gx-4">

                    <a class="nav-link" href="#home">Home</a>
                    <?php
                    if ($_SESSION['user_mail'] === 'sayan@gmail.com') {

                    ?>
                        <a class="nav-link" href="#edit">Profile</a>
                    <?php
                    } else {
                    ?>

                        <a class="nav-link" href="#profile">Profile</a>
                        <a class="nav-link" href="#hire">Hire</a>
                        <a class="nav-link" href="#chat">Contact</a>
                    <?php
                    }
                    ?>
                    <a class="nav-link" href="index.php">Portfolio</a>
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>


    <!--// navbar -->

    <div id="content-wrapper">

        <!-- home -->
        <section id="home" class="full-height px-lg-5">
            <div class="container">
                <div class="row pb-4">
                    <div class="col-lg-8">
                        <h6 class="text-brand">Home</h6>
                    </div>
                </div>

                <div class="row gy-4">


                    <?php
                    if ($_SESSION['user_mail'] === 'sayan@gmail.com') {
                        $sql = "SELECT * FROM contact_msg WHERE EMP_ID_TO=1 and CON_MSG_STATUS='sending'";
                        if ($res = $conn->query(($sql))) {
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {

                                    $sql_inner = "SELECT EMP_ID,EMP_NAME FROM employee WHERE EMP_ID='" . $row['EMP_ID_FROM'] . "'";
                                    if ($in_res = $conn->query(($sql_inner))) {
                                        if ($in_res->num_rows > 0) {
                                            while ($in_row = $in_res->fetch_assoc()) {
                    ?>

                                                <div class="col-md-6">
                                                    <div class="card-custom rounded-4 bg-base shadow-effect">
                                                        <div class="card-custom-image rounded-4">
                                                            <img class="rounded-4" src="./assect/image/blog.png" alt="">
                                                        </div>
                                                        <div class="card-custom-content p-4">
                                                            <p class="text-brand mb-2"> <?php echo $in_row['EMP_NAME'] ?> </p>
                                                            <h5 class="mb-4"><?php echo $row['CON_MSG_MSG'] ?></h5>
                                                            <span class="mb-4"><?php echo $row['CON_MSG_MSG_DESC'] ?></span>

                                                            <div class="row mt-4">
                                                                <div class="col">
                                                                    <a href="contact-update.php?msgid=<?php echo $row['CON_MSG_ID'];  ?>& msg=reject" class="btn btn-outline-danger">Reject</a>
                                                                </div>
                                                                <div class="col">
                                                                    <a href="contact-update.php?msgid=<?php echo $row['CON_MSG_ID'];  ?>& msg=accept" class="btn btn-outline-success">Accept</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                    <?php
                                            }
                                        }
                                    }
                                }
                            } else {
                                echo '<div class="col-12" style="display:flex;justify-content: center;align-items: center;flex-direction: column;font-size:1rem;color:#8d8c8c;"><i class="fa-regular fa-copy" style="font-size:3rem;"></i> <p>No Command</p></div>';
                            }
                        }
                    }
                    ?>



                </div>

                <div class="row my-5">
                    <div class="col-lg-8">
                        <h6 class="text-brand">History Contact</h6>
                    </div>
                </div>


                <?php

                if ($_SESSION['user_mail'] === 'sayan@gmail.com') {
                    $sql = "SELECT e.EMP_NAME, c.* FROM `contact_msg`as c join employee as e on e.EMP_ID=c.EMP_ID_FROM";
                    if ($res = $conn->query(($sql))) {
                ?>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Response</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $res->fetch_assoc()) {

                                    ?>

                                        <tr>
                                            <td><?php echo $row['EMP_NAME']; ?></th>
                                            <td><?php echo $row['CON_MSG_MSG']; ?></td>
                                            <td><?php echo $row['CON_MSG_STATUS']; ?></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                    <?php
                    }
                } else {
                    $sql = "SELECT e.EMP_NAME, c.* FROM contact_msg AS c JOIN employee AS e ON e.EMP_ID=c.EMP_ID_TO AND EMP_ID_FROM='" . $_SESSION['user_id'] . "'";
                    if ($res = $conn->query(($sql))) {

                    ?>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Response</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    while ($row = $res->fetch_assoc()) {
                                    ?>

                                        <tr>
                                            <td><?php echo $row['EMP_NAME']; ?></th>
                                            <td><?php echo $row['CON_MSG_MSG']; ?></td>
                                            <td><?php echo $row['CON_MSG_STATUS']; ?></td>
                                        </tr>


                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                <?php
                    }
                }
                ?>



            </div>
        </section>
        <!-- // home -->

        <?php
        if ($_SESSION['user_mail'] === 'sayan@gmail.com') {

        ?>

            <!-- edit -->

            <section id="edit" class="full-height px-lg-5">

                <div class="container">

                    <div class="row pb-4">
                        <div class="col-lg-8">
                            <h6 class="text-brand">Profile</h6>
                            <h2>My <span class="text-brand h1">Skill,</span></h2>
                        </div>
                    </div>

                    <?php

                    $sql_details = "select employee.EMP_ID,employee.EMP_NAME,employee.EMP_EMAIL,contact.CON_ADD,contact.CON_MOBILE from employee inner join contact on contact.EMP_ID=employee.EMP_ID";
                    if ($res_details = $conn->query($sql_details)) {
                        if ($row_details = $res_details->fetch_assoc()) {
                    ?>
                            <div class="row">
                                <div class="col-12 emp-card p-3 border border-2 rounded-5">
                                    <div class="emp-details">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="emp-img">
                                                    <img src="./src/resources/profile.png" alt="">
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="row flex justify-content-center align-items-center">
                                                    <div class="col-6 flex flex-column">
                                                        <p class="emp-name text-uppercase">
                                                            <?php echo $row_details['EMP_NAME']  ?>
                                                        </p>
                                                        <span class="emp-title">Junior web & app Developer</span>
                                                    </div>
                                                    <div class="col-6 flex flex-column">
                                                        <p class="emp-location text-uppercase">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            <?php echo $row_details['CON_ADD']  ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <span class="title-contact">Contact</span>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <p class="email">Email :
                                                    <span class="email-address">
                                                        <?php echo $row_details['EMP_EMAIL']  ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mobile">Mobile : <span class="mobile-number">(+91)
                                                        <?php echo $row_details['CON_MOBILE']  ?>
                                                    </span></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <span class="title">Skill</span>
                                            </div>

                                            <?php

                                            $sql_skill = "select skill.* from skill inner join skill_emp on skill_emp.SKILL_ID=skill.SKILL_ID INNER join employee on skill_emp.EMP_ID=employee.EMP_ID";
                                            $res_skill = $conn->query($sql_skill);
                                            while ($row_skill = $res_skill->fetch_assoc()) {
                                            ?>

                                                <div class="col">
                                                    <div class="skill-box">
                                                        <div class="skill-containt">
                                                            <div class="skill-icon">
                                                                <?php echo $row_skill['SKILL_ICON']; ?>
                                                            </div>
                                                            <p class="skill-name">
                                                                <?php echo $row_skill['SKILL_NAME']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                            }

                                            ?>



                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12 flex-btn-group">
                                                <a href="resume.pdf" target="_blank" class="btn btn-outline-warning">Edit</a>
                                                <a href="#chat" class="btn btn-outline-light">Update CV</a>
                                                <a href="" class="btn btn-outline-danger">Delete</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    }

                    ?>
                </div>

            </section>

            <!-- // edit -->
        <?php
        } else {
        ?>


            <!-- profile -->

            <section id="profile" class="full-height px-lg-5">
                <div class="container">

                    <div class="row pb-4">
                        <div class="col-lg-8">
                            <h6 class="text-brand">Profile</h6>
                            <!-- <h2>Edit Your <span class="text-brand h1">Profile,</span></h2> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-6 profile-card">
                                    <!-- <div class="container"> -->
                                    <div class="profile-img">
                                        <img src="./src/resources/profile.png" alt="">
                                    </div>
                                    <div class="profile-details">
                                        <div class="row">
                                            <div class="col ">
                                                <span class="profile-name"><?php echo $_SESSION['user_name']; ?></span>
                                            </div>
                                            <div class="col">
                                                <span class="profile-email"><?php echo $_SESSION['user_mail']; ?></span>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-12 center-btn">
                                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    Update
                                                </button>



                                                <!-- <a href="" class="btn btn-outline-info">Update</a> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>

                            </div>

                        </div>
                    </div>



                </div>
            </section>

            <!-- // profile -->

            <!-- hire -->

            <section id="hire" class="full-height px-lg-5">

                <div class="container">

                    <div class="row pb-4">
                        <div class="col-lg-8">
                            <h6 class="text-brand">Hire</h6>
                            <h2>Available <span class="text-brand h1">Employee,</span></h2>
                        </div>
                    </div>

                    <?php

                    $sql_details = "select employee.EMP_ID,employee.EMP_NAME,employee.EMP_EMAIL,contact.CON_ADD,contact.CON_MOBILE from employee inner join contact on contact.EMP_ID=employee.EMP_ID";
                    if ($res_details = $conn->query($sql_details)) {
                        if ($row_details = $res_details->fetch_assoc()) {
                    ?>
                            <div class="row">
                                <div class="col-12 emp-card p-3 border border-2 rounded-5">
                                    <div class="emp-details">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="emp-img">
                                                    <img src="./src/resources/profile.png" alt="">
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="row flex justify-content-center align-items-center">
                                                    <div class="col-6 flex flex-column">
                                                        <p class="emp-name text-uppercase">
                                                            <?php echo $row_details['EMP_NAME']  ?>
                                                        </p>
                                                        <span class="emp-title">Junior web & app Developer</span>
                                                    </div>
                                                    <div class="col-6 flex flex-column">
                                                        <p class="emp-location text-uppercase">
                                                            <i class="fa-solid fa-location-dot"></i>
                                                            <?php echo $row_details['CON_ADD']  ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <span class="title-contact">Contact</span>
                                            </div>
                                            <div class="col-6 mt-3">
                                                <p class="email">Email :
                                                    <span class="email-address">
                                                        <?php echo $row_details['EMP_EMAIL']  ?>
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="mobile">Mobile : <span class="mobile-number">(+91)
                                                        <?php echo $row_details['CON_MOBILE']  ?>
                                                    </span></p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <span class="title">Skill</span>
                                            </div>

                                            <?php

                                            $sql_skill = "select skill.* from skill inner join skill_emp on skill_emp.SKILL_ID=skill.SKILL_ID INNER join employee on skill_emp.EMP_ID=employee.EMP_ID";
                                            $res_skill = $conn->query($sql_skill);
                                            while ($row_skill = $res_skill->fetch_assoc()) {
                                            ?>

                                                <div class="col">
                                                    <div class="skill-box">
                                                        <div class="skill-containt">
                                                            <div class="skill-icon">
                                                                <?php echo $row_skill['SKILL_ICON']; ?>
                                                            </div>
                                                            <p class="skill-name">
                                                                <?php echo $row_skill['SKILL_NAME']; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                            }

                                            ?>



                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12 flex-btn-group">
                                                <a href="resume.pdf" target="_blank" class="btn btn-outline-warning">Get CV</a>
                                                <a href="#chat" class="btn btn-outline-light">Contact</a>
                                                <a href="" class="btn btn-outline-info">Hire Now</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    }

                    ?>

                </div>

            </section>

            <!-- // hire -->



            <!-- CONTACT SECTION -->

            <section id="chat" class="full-height px-lg-5">
                <div class="container">

                    <div class="row justify-content-center text-center pb-4">
                        <div class="col-lg-8">
                            <h6 class="text-brand">Contact</h6>
                            <h2>Contact <span class="text-brand h1">Me,</span>
                                <i class="las la-lock"></i>
                            </h2>
                        </div>

                        <?php

                        $sql = "SELECT * FROM contact_msg WHERE EMP_ID_FROM ='" . $_SESSION['user_id'] . "' and CON_MSG_STATUS ='sending'";
                        if ($res = $conn->query(($sql))) {
                            if (!$res->num_rows > 0) {

                        ?>

                                <div class="col-lg-8">
                                    <form class="row g-lg-3 gy-3" action="contact.php" method="post">
                                        <div class="form-group col-md-6 disabled">
                                            <input type="text" name="fullname" class="form-control-plaintext" <?php echo "value='" . $_SESSION['user_name'] . "'"; ?> placeholder="Full Name" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input type="email" name="email" class="form-control-plaintext " <?php echo "value='" . $_SESSION['user_mail'] . "'"; ?> placeholder="example@mail.com" readonly>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="text" name="msg_subject" class="form-control" placeholder="Subject">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea name="msg_description" rows="4" class="form-control" placeholder="Explain Subject"></textarea>
                                        </div>
                                        <!-- <p class="text-brand my-2">Submiting this form Chat will Be Unlock after Verify</p> -->
                                        <div class="form-group col-md-12 d-grid">
                                            <button type="submit" class="btn btn-brand">Submit</button>
                                        </div>
                                    </form>
                                </div>

                        <?php
                            } else {
                                echo "<h3> Request Submited !!";
                            }
                        }
                        ?>

                    </div>



                </div>
            </section>

            <!-- //CONTACT SECTION -->
        <?php
        }
        ?>

        <!-- model -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>features will be comming soon.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- // model -->







        <!-- FOOTER -->

        <footer class="py-5 px-lg-5">
            <div class="container">
                <div class="row gy-4 justify-content-between">
                    <div class="col-auto">
                        <p class="mb-0 text-white">Copyright Details</p>
                    </div>
                    <div class="col-auto">
                        <div class="social-icons">
                            <a href="#"><i class="lab la-facebook"></i></a>
                            <a href="#"><i class="lab la-instagram"></i></a>
                            <a href="#"><i class="lab la-dribbble"></i></a>
                            <a href="#"><i class="lab la-twitter"></i></a>
                            <a href="#"><i class="lab la-github"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </footer>

        <!-- //FOOTER -->
    </div>




    <script src="./src/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/dashboard.js"></script>


</body>

</html>