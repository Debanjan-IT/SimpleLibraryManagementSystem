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
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT user_id, user_fullname FROM users where user_username = '$username' and user_password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['name'] = $row["user_fullname"];
        echo '<script>alert("login successfull...")</script>';
        header("Location: home.php");
    } else {
        echo '<script>alert("Invalid credentials...")</script>';
        header("Location: login.html");
    }


?>