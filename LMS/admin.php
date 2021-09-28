<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lms";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql1 = "select * from users";
    $sql2 = "select * from books";
    $sql3 = "select * from orders";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {
        ?>
        <h1>User Data</h1>
        <?php    while($row = $result1->fetch_assoc()) {
        ?>
        <div class="child1">
            <h2><?php echo "User Fullname: ".$row["user_fullname"] ?></h2>
            <h4><?php echo "User Username: ".$row["user_username"] ?></h4>
        </div>
        <?php
    }
    } else {
        echo "0 Users found";
    }
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        ?>
        <h1>Books Data</h1>
        <?php    while($row = $result2->fetch_assoc()) {
        ?>
        <div class="child1">
            <h2><?php echo "Book Name: ".$row["book_name"] ?></h2>
            <h4><?php echo "Book Available: ".$row["book_available"] ?></h4>
        </div>
        <?php
    }
    } else {
        echo "0 books found";
    }
    $result3 = $conn->query($sql3);
    if ($result3->num_rows > 0) {
        ?>
        <h1>Orders Data</h1>
        <?php    while($row = $result3->fetch_assoc()) {
        ?>
        <div class="child1">
            <h2><?php echo "User Fullname: ".$row["user_fullname"] ?></h2>
            <h4><?php echo "Book Name: ".$row["book_name"] ?></h4>
        </div>
        <?php
    }
    } else {
        echo "0 orders found";
    }
    ?>
    
</body>
</html>