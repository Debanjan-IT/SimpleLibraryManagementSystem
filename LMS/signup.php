<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lms";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $fname = $_POST["fullname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if ($password == $cpassword) {
        $sql = "INSERT INTO users (user_fullname, user_username, user_password) VALUES ('$fname', '$username', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Registration successfull...")</script>';
            header("Location: login.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo '<script>alert("Password And Confirm Password Must Be Same...")</script>';
        header("Location: register.html");
    }


?>