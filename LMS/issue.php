<?php
    session_start();
    $bookname = $_POST["book_name"];
    $booknumber = $_POST["book_numbers"];
    $val = $booknumber - 1;
    $nm = $_SESSION['name'];
    $id = $_SESSION['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lms";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO orders (user_id, user_fullname, book_name) VALUES ('$id', '$nm', '$bookname')";
    $sql2 = "UPDATE books SET book_available = $val WHERE book_name = '$bookname'";
    if ($val == 0){
        $sql2 = "UPDATE books SET book_available = $val, book_status = 'N' WHERE book_name = '$bookname'";
    }
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Booking Done...")</script>';
    } else {
        echo '<script>alert("Error occurs...")</script>';
    }
    if ($conn->query($sql2) === TRUE) {
        echo '<script>alert("Data Updated...")</script>';
        header("Location: home.php");
    } else {
        echo '<script>alert("Error occurs...")</script>';
    }
?>