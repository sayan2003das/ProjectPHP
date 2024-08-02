<?php

session_start();

$conn = new mysqli("localhost", "root", "", "myproject");



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profolio</title>
    <script src="https://kit.fontawesome.com/36c814cb6e.js" crossorigin="anonymous"></script>
    <script src="./src/js/font-awesome.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./src/css/style.css">
</head>

<body>

    <div class="box">
        <!-- <i class="fa-solid fa-bars"></i> -->
        <i class="fa-solid fa-bars" id="menu-icon" onclick="icon_change()"></i>
    </div>
    <div class="nav" id="nav">

        <div class="menu">
            <div class="item">
                <a href="#home">home</a>
            </div>
            <div class="item">
                <a href="#about">about</a>
            </div>
            <div class="item">
                <a href="#project">project</a>
            </div>
            <div class="item">
                <a href="dashboard.php">dashboard</a>
            </div>
            <?php
            if (isset($_SESSION['user_mail'])) {
            ?>
                <div class="item">
                    <a href="logout.php">Logout</a>
                </div>
            <?php } else { ?>
                <div class="item">
                    <a href="login.php">Login</a>
                </div>
            <?php
            } ?>
        </div>
    </div>
    <!-- home -->
    <section id="home" class="full-height">

        <div class="container full-height">

            <div class="text-container">
                <span class="text hello">Hello,</span>
                <span class="text name">I am <span class="highlight">"Sayan Das"</span></span>
                <span class="text dev">Junior <span class="highlight">Web</span> & <span class="highlight">App</span>
                    Developer</span>
            </div>
            <div class="btn-container">
                <button class="btn hire-me">
                    <a href="dashboard.php">Hire Me</a>
                </button>
                <button class="btn get-cv">
                    <a href="resume.pdf" target="_blank" style="text-decoration: none; color:white;">Get CV</a>
                </button>
            </div>
        </div>
        <div class="img-container">
            <img src="./src/resources/dev.png" alt="">
        </div>

    </section>
    <!-- // Home -->

    <!-- About -->
    <section id="about" class="full-height">

        <div class="hero-about">
            <img src="./src/resources/about.png" alt="">
            <span class="about-text">Let's Time to Instroduce <span class="highlight">Myself</span></span>
        </div>
        <div class="education">
            <span class="edu-title">
                <i class="fa-solid fa-laptop-code"></i>
                Education & Course
            </span>

            <span class="text-center">Education</span>

            <?php
            $sql_education = "select * from education where EDU_COMMAND=''";

            $res_edu = $conn->query($sql_education);
            while ($row_edu = $res_edu->fetch_assoc()) {
            ?>

                <div class="card">
                    <div class="card-flex-auto">
                        <div class="card-title"><?php echo $row_edu['EDU_NAME'] ?></div>
                        <div class="card-sub-title"><?php echo $row_edu['EDU_UNIVERCITY'] . " (" . $row_edu['EDU_START_YEAR'] . " - " . $row_edu['EDU_END_YEAR'] . " )"; ?></div>
                    </div>
                </div>
            <?php

            }


            ?>





            <span class="text-center">Course & Training</span>

            <div class="card">

                <?php
                $sql_education_course = "select * from education where EDU_COMMAND='course'";

                $res_edu_course = $conn->query($sql_education_course);
                while ($row_edu_course = $res_edu_course->fetch_assoc()) {
                ?>

                    <div class="card-flex-auto">
                        <div class="card-title"><?php echo $row_edu_course['EDU_NAME']; ?></div>
                        <div class="card-sub-title"><?php echo $row_edu_course['EDU_UNIVERCITY'] . " (" . $row_edu_course['EDU_START_YEAR'] . " - " . $row_edu_course['EDU_END_YEAR'] . " )"; ?></div>
                    </div>
                <?php

                }

                ?>


            </div>

        </div>

        <div class="skill">

            <span class="edu-title">
                <i class="fa-solid fa-code"></i>
                Skill
            </span>

            <div class="card-skill">

                <?php

                $sql_skill = "select skill.* from skill inner join skill_emp on skill_emp.SKILL_ID=skill.SKILL_ID INNER join employee on skill_emp.EMP_ID=employee.EMP_ID";
                $res_skill = $conn->query($sql_skill);
                while ($row_skill = $res_skill->fetch_assoc()) {
                ?>

                    <div class="skill-container">
                        <div class="card-icon">
                            <?php echo $row_skill['SKILL_ICON']; ?>
                        </div>
                        <div class="card-text">
                            <?php echo $row_skill['SKILL_NAME']; ?>
                        </div>
                    </div>

                <?php
                }
                ?>


            </div>


        </div>


    </section>
    <!-- // About -->

    <!-- project -->

    <section id="project" class="full-height">

        <div class="project-header">
            <span class="project-text">My Project</span>
            <img src="./src/resources/project-img.png" alt="">
        </div>
        <span class="text-center">Website</span>
        <div class="project">
            <?php
            $sql_pro = "SELECT * FROM project where PRO_COMMAND=''";
            $res_pro = $conn->query($sql_pro);
            while ($row_pro = $res_pro->fetch_assoc()) {
            ?>
                <div class="project-card">
                    <img class="project-img" src="<?php echo $row_pro['PRO_IMG']; ?>" alt="">
                    <div class="container-details">
                        <div class="project-name">
                            <?php echo $row_pro['PRO_NAME']; ?>
                        </div>
                        <div class="project-details">
                            <?php echo $row_pro['PRO_CONTENT']; ?>
                        </div>
                    </div>
                    <div class="btn-explore">
                        <button>Explore Now</button>
                    </div>
                </div>
            <?php

            }
            ?>


        </div>

        <span class="text-center">Mobile App</span>

        <div class="flex-row">
            <?php
            $sql_pro = "SELECT * FROM project where PRO_COMMAND='1'";
            $res_pro = $conn->query($sql_pro);
            while ($row_pro = $res_pro->fetch_assoc()) {
            ?>

                <div class="mobile-app">
                    <img class="img-app" src="<?php echo $row_pro['PRO_IMG']; ?>" alt="">

                    <div class="app-details">
                        <span class="app-name">
                            <?php echo $row_pro['PRO_NAME']; ?>
                        </span>
                        <span class="app-ver">
                            <?php echo $row_pro['PRO_CONTENT']; ?>
                        </span>

                    </div>
                </div>

            <?php

            }
            ?>

        </div>

    </section>
    <!-- // project -->

    <!-- footer -->
    <footer class="footer">
        <div class="social-link">
            <i class="fa-brands fa-facebook"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-github"></i>
            <i class="fa-brands fa-google"></i>
            <i class="fa-brands fa-skype"></i>
            <i class="fa-brands fa-linkedin"></i>
        </div>
        <div class="contacts">
            <span class="mobile ">
                <i class="fa-solid fa-headset padding-right"></i>
                (+91) 00000 00000
            </span>
            <span class="email">
                <i class="fa-solid fa-envelopes-bulk padding-right"></i>
                example@mail.com
            </span>
            <span class="contact-frm-btn">
                <button class="btn-contact">Contact Me</button>
            </span>
        </div>
        <div class="copywrite">
            &copy; 2024 @SayanDas
        </div>
    </footer>

    <!-- // footer -->



    <script src="./src/js/script.js"></script>
</body>

</html>