<!DOCTYPE html>
<php lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/SPARK FOUNDATION PROJECT/style.css">
        <title>our customers</title>
    </head>

    <body>
        <div class="nav-div">
            <nav>

                <p>Welcome To Spark Bank</p>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="our customer.php" id="active">our customers</a></li>
                    <li><a href="transfer.php">transfer money</a></li>
                    <li><a href="about us.php">about us</a></li>
                </ul>
            </nav>
        </div>

        <?php
        include 'config.php';
        $sql = "SELECT * FROM customers";
        $result = mysqli_query($conn, $sql);
        ?>
        <div class="heading">
            <h1>our customers</h1>
        </div>

        <table class="t" width="1000px" height="200px">

            <tr>
                <th>Name</th>
                <th>Account Number</th>
                <th>Email-d</th>
                <th>Balance</th>
            </tr>
            <?php
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <tr align="center" height="auto">
                    <td><?php echo $rows['name'] ?></td>
                    <td><?php echo $rows['id'] ?></td>
                    <td><?php echo $rows['email'] ?></td>
                    <td><?php echo $rows['balance'] ?></td>
                </tr>
            <?php
            }
            ?>


        </table>

    </body>

</php>