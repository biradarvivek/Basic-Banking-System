<?php
include 'config.php';
?>
<?php

if (isset($_POST['submit'])) {
    $from = $_POST['sender'];
    $to = $_POST['receiver'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where name='$from'";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "SELECT * from customers where name='$to'";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);




    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';
        echo '</script>';
    } else if ($amount > $sql1['balance']) {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';
        echo '</script>';
    } else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {


        $newbalance = $sql1['balance'] - $amount;
        $sql = "UPDATE customers set balance=$newbalance where name='$from'";
        mysqli_query($conn, $sql);



        $newbalance = $sql2['balance'] + $amount;
        $sql = "UPDATE customers set balance=$newbalance where name='$to'";
        mysqli_query($conn, $sql);

        echo "<script type='text/javascript'>";
        echo "alert('hurray, Transaction is successfull')";
        echo "</script>";



        $newbalance = 0;
        $amount = 0;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Money</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section>
        <div class="nav-div">
            <nav>
                <p>Welcome To Spark Bank</p>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="our customer.php">our customers</a></li>
                    <li><a href="transfer.php" id="active">transfer money</a></li>
                    <li><a href="about us.php">about us</a></li>
                </ul>
            </nav>
        </div>
    </section>


    <?php
    include 'config.php';
    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn, $sql);
    ?>

    <div class="transfer">

        <h1>Transfer Money</h1>
        <form method="POST">
            <div class="detail">

                <label for="sender">Choose The sender :</label>
                <select name="sender" id="sender">
                    <option value="" disabled selected hidden>Choose the Sender</option>
                    <option value=""> <?php
                                        mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $rows['name'] . '">' . $rows['name'] . ' (Balance: ' . $rows['balance'] . ')</option>';
                                        }
                                        ?></option>

                </select>
                <br>
                <label for="sender">Choose The Receiver :</label>
                <select name="receiver" id="receiver">
                    <option value="" disabled selected hidden>Choose the Receiver</option>
                    <?php
                    mysqli_data_seek($result, 0); // Reset the result pointer to the beginning
                    while ($rows = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $rows['name'] . '">' . $rows['name'] . ' (Balance: ' . $rows['balance'] . ')</option>';
                    }
                    ?>
                </select>
                <br>
                <label for="amount">Amount :</label>
                <input type="number" name="amount" value="amount" placeholder="Enter the Amount">
                <br>

                <div class="btn"><button type="submit" name="submit" value="submit">send money</button></div>


            </div>
        </form>
    </div>

</body>

</html>