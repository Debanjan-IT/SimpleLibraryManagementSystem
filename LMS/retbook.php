<?php
session_start();
$id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>LMS</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="topnav">
            <a class="active" href="login.html">Home</a>
            <a href="contact.html">Contact</a>
            <a href="retbook.php">Return A Book</a>
        </div>
        <div class="details">
            <h1><?php echo "Welcome ". $_SESSION['name'] ?></h1>
        </div>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lms";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM orders where user_id = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <form action="return.php" method="post">
                        <div class="child">
                            <img class="bookimg" src="BookImage.gif" alt="bookimage">
                        </div>
                        <div class="child">
                            <input type="hidden" name="id" id="id" value="<?php echo $row["order_id"] ?>">
                            <input class="book_name" type="text" name="book_name" value="<?php echo $row["book_name"] ?>" readonly>
                            <input type="submit" class='button' value="RETURN">                           
                        </div>
                    </form>
                <?php
            }
        } else {
            echo '<script>alert("No Results Found...")</script>';
            header("Location: home.php");
        }
    ?>

</body>
</html>