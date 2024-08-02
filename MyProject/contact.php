    <?php
    session_start();
    $conn = new mysqli("localhost", "root", "", "myproject");
    if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['msg_subject']) && isset($_POST['msg_description'])) {

        $from = $_SESSION['user_id'];
        $email = $_POST['email'];
        $subject = $_POST['msg_subject'];
        $desc = $_POST['msg_description'];

        // echo "enter";

        $sql = "INSERT INTO contact_msg (EMP_ID_FROM,CON_MSG_MSG,CON_MSG_MSG_DESC,CON_MSG_STATUS) VALUES('" . $from . "','" . $subject . "','" . $desc . "','sending')";

        if ($conn->query($sql)) {
            $from = "";
            $email = "";
            $subject = "";
            $desc = "";
            header("Location:dashboard.php/#chat");
            echo "done";
        }
    }
    ?>