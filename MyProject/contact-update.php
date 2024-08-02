<?php
session_start();


if (isset($_GET['msgid']) && isset($_GET['msg'])) {

    $conn = new mysqli("localhost", "root", "", "myproject");

    $msgid= $_GET['msgid'];
    $msg= $_GET['msg'];

    $sql_select = "SELECT * FROM contact_msg WHERE CON_MSG_ID='" . $msgid . "'";
    if($res=$conn->query($sql_select)){
        if($row=$res->fetch_assoc()){
            $sql_update = "UPDATE contact_msg SET CON_MSG_STATUS='" . $msg . "' WHERE CON_MSG_ID='" . $msgid . "'";
            $res_in = $conn->query($sql_update);
            header("Location:dashboard.php");
            exit();
        }
    }

    echo "done";





}
?>