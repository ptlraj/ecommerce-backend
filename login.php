<?php
if (isset($_POST["email"]) && $_POST["password"]) {
    include "./connection.php";
    $myemail = addslashes($_POST["email"]);
    $mypassword = $_POST["password"];

    $query = $conn->prepare("select * from login");
    $query->execute();
    $logindata = $query->fetchall();
    $login = false;
    foreach ($logindata as $logdata) {
        if ($logdata['email'] == $myemail && $logdata["password"] == $mypassword) {
            if ($logdata["role"] == "admin") {
                header("location: ./admin/index.php");
            } else {
                header("location: ./user/index.php");
            }
        }
    }
}
