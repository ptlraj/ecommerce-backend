<?php
// if (isset($_POST["email"]) && $_POST["password"]) {
//     include "./connection.php";
//     $myemail = addslashes($_POST["email"]);
//     $mypassword = $_POST["password"];

//     $query = $conn->prepare("select * from login");
//     $query->execute();
//     $logindata = $query->fetchall();
//     $login = false;
//     foreach ($logindata as $logdata) {
//         if ($logdata['email'] == $myemail && $logdata["password"] == $mypassword) {
//             if ($logdata["role"] == "admin") {
//                 header("location: ./admin/index.php");
//             } else {
//                 header("location: ./user/index.php");
//             }
//         }
//     }
// }

// if(isset($_GET["message"])){
//     echo"";
// }
session_start(); // Start session

if (isset($_POST["email"]) && isset($_POST["password"])) {
    include "./connection.php";

    $myemail = addslashes($_POST["email"]);
    $mypassword = $_POST["password"];

    $query = $conn->prepare("SELECT * FROM login");
    $query->execute();
    $logindata = $query->fetchAll();

    foreach ($logindata as $logdata) {
        if ($logdata['email'] == $myemail && $logdata["password"] == $mypassword) {
            // Store user data in session
            $_SESSION["email"] = $logdata["email"];
            $_SESSION["role"] = $logdata["role"];
            $_SESSION["last_activity"] = time(); // Store login time

            // Redirect based on role
            if ($logdata["role"] == "admin") {
                header("location: ./admin/index.php");
            } else {
                header("location: ./user/index.php");
            }
            exit();
        }
    }
    echo "Invalid email or password!";
}
