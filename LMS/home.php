<!DOCTYPE html>
<?php
    session_start();
?>
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
    <div class="books">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "lms";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM books";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <div class="booksdata">
                        <form action="issue.php" method="post">
                            <div class="child">
                                <img class="bookimg" src="BookImage.gif" alt="bookimage">
                            </div>
                            <div class="child">
                                <input class="book_name" type="text" name="book_name" value="<?php echo $row["book_name"] ?>" readonly>
                                <?php
                                    if ($row["book_status"] == "A") {
                                    ?>
                                        <h3 class="book_availability2">Available</h3>
                                        <input class="book_number" name="book_numbers" type="text" value="<?php echo $row["book_available"] ?>" readonly>
                                        <br><input class="button2" type="submit" value="ISSUE BOOK">
                                    <?php
                                    }
                                    elseif ($row["book_status"] == "N") {
                                        ?>
                                        <h3 class="book_availability1">Not Available</h3>
                                        <input class="book_number" name="book_numbers" type="text" value="<?php echo $row["book_available"] ?>" readonly>
                                        <br><input class="button3" type="submit" disabled value="ISSUE BOOK">
                                    <?php
                                    }
                                ?>
                            </div>
                        </form>
                    </div>

                  <?php
                }
              } else {
                echo '<script>alert("No Books Available...")</script>';
                header("Location: login.php");
              }
        ?>
    </div>
</body>
</html>