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
    $name = $_POST["book_name"];
    $id = $_POST["id"];
    $sql = "SELECT book_available FROM books where book_name = '$name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $s = $row['book_available'];
        $s = $s + 1;
        if ($s > 1) {
            $sql2 = "UPDATE books SET book_available = $s WHERE book_name = '$name'";
        }
        else {
            $sql2 = "UPDATE books SET book_available = $s, book_status = 'A' WHERE book_name = '$name'";
        }
        if ($conn->query($sql2) === TRUE) {
            $sql3 = "DELETE FROM orders WHERE order_id=$id";
            if ($conn->query($sql3) === TRUE) {
                echo '<script>alert("Data Updated...")</script>';
                header("Location: home.php");
            }
        } else {
            echo '<script>alert("Error occurs...")</script>';
        }
    } else {
        echo '<script>alert("No Book Ordered...")</script>';
        header("Location: login.php");
    }
?>